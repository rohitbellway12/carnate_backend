<div>

    <div class="modal @if ($shoImageModel) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($shoImageModel) block @endif">
        <div class="modal-dialog modal-s">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Image</h4>
                    <button type="button" class="btn-close" wire:click="clodeImageModel" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                @if (!empty($imageitem))
                                    @if (!empty($imageitem->SpareParts->Image->file))
                                        <img src="{{ asset($imageitem->SpareParts->Image->file) }}"
                                            alt="Maintenance Service Parts" style="width: 100%; height: auto;">
                                    @else
                                        @if ($imageitem->SpareParts?->spare_part_type == 1)
                                            <img src="{{ asset('img/accessory.png') }}" alt="Maintenance Service Parts"
                                                style="width: 100%; height: auto;">
                                        @elseif($imageitem->SpareParts?->spare_part_type == 2)
                                            <img src="{{ asset('img/spareparts.jpg') }}" alt="Maintenance Service Parts"
                                                style="width: 100%; height: auto;">
                                        @elseif($imageitem->SpareParts?->spare_part_type == 3)
                                            <img src="{{ asset('img/tools.jpg') }}" alt="Maintenance Service Parts"
                                                style="width: 100%; height: auto;">
                                        @else
                                            <img src="{{ asset('img/lubricant.jpg') }}" alt="Maintenance Service Parts"
                                                style="width: 100%; height: auto;">
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

    <div class="modal @if ($showReasonModel) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showReasonModel) block @endif">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form wire:submit.prevent="declinereasonStore">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $statusReason }} Reason</h4>
                        <button type="button" class="btn-close" wire:click="clodeReasonModel" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">{{ $statusReason }} Reason <sup
                                            class="text-danger">*</sup> </label>
                                    <textarea wire:model="decline_reason" class="form-control" rows="4" placeholder="Enter Reason"></textarea>
                                </div>
                                @error('decline_reason')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if (empty($decline_reason))
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

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Order Item</div>
            <div class="pe-3">
                <a href="{{route('workshop.vehicle_search')}}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                        class="bx bx-back"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        @if (!empty($order_items) && count($order_items))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Rack No.</th>
                                <th>Part Number</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>GST Rate</th>
                                <th>GST Amount</th>
                                <th>Total Amount</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $visible = false;
                                $totalTax = 0;
                                $taxableAmount = 0;
                            @endphp
                            @foreach ($order_items as $index => $order_item)
                                @php
                                    $orderId = $order_item->order_id;
                                    $is_confim = $order_item->order?->is_confim;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}
                                    </td>
                                    <td>

                                        <a href="javascript:void(0);" wire:click="shoImage({{ $order_item->id }})">
                                            @if (!empty($order_item->SpareParts->Image->file))
                                                <img src="{{ asset($order_item->SpareParts->Image->file) }}"
                                                    alt="Maintenance Service Parts" height="50" width="50px">
                                            @else
                                                @if ($order_item->SpareParts?->spare_part_type == 1)
                                                    <img src="{{ asset('img/accessory.png') }}"
                                                        alt="Maintenance Service Parts" height="50" width="50px">
                                                @elseif($order_item->SpareParts?->spare_part_type == 2)
                                                    <img src="{{ asset('img/spareparts.jpg') }}"
                                                        alt="Maintenance Service Parts" height="50" width="50px">
                                                @elseif($order_item->SpareParts?->spare_part_type == 3)
                                                    <img src="{{ asset('img/tools.jpg') }}"
                                                        alt="Maintenance Service Parts" height="50" width="50px">
                                                @else
                                                    <img src="{{ asset('img/lubricant.jpg') }}"
                                                        alt="Maintenance Service Parts" height="50" width="50px">
                                                @endif
                                            @endif


                                        </a>
                                        {{ $order_item?->SpareParts?->name ?? '-' }}
                                    </td>
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
                                    <td>{{ $order_item->SpareParts?->rack_no ?? 'Null' }}</td>
                                    <td>{{ $order_item->SpareParts?->part_number ?? 'Null' }}</td>
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
                                        @if ($order_item->payment_status == 0)
                                            <p class="badge bg-warning"> Pending</p>
                                        @elseif($order_item->payment_status == 1)
                                            <p class="badge bg-success">Paid</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order_item->status == 0)
                                            <p class="badge bg-warning">Pending</p>
                                        @elseif($order_item->status == 1)
                                            <p class="badge bg-success">Accepted</p>
                                        @elseif($order_item->status == 2)
                                            <p class="badge bg-danger">Declined</p>
                                            <a class="badge bg-danger  badge-sm text-white" href="javascript:void(0);"
                                                wire:click="showdeclineorder({{ $order_item->id }},2)">Declined
                                                Reason</a>
                                        @elseif($order_item->status == 3)
                                            <p class="badge bg-success">Handover</p>
                                        @elseif($order_item->status == 4)
                                            <p class="badge bg-primary">Received-Handover</p>
                                        @elseif($order_item->status == 5)
                                            <p class="badge bg-info">Delayed</p>
                                            <a class="badge bg-info  badge-sm text-white" href="javascript:void(0);"
                                                wire:click="showdeclineorder({{ $order_item->id }},5)">Delayed
                                                Reason</a>
                                        @endif

                                        {{-- @if ($orders->payment_status == 0)
                                            <p class="text-warning">Payment Pending</p>
                                        @endif --}}
                                    </td>
                                    <td>

                                        @if ($order_item->status == 5)
                                            <button type="button"
                                                wire:click="changeItemStatus({{ $order_item->id }},1)"
                                                class="btn btn-success btn-sm rounded mx-2">Accept</button>
                                            <button type="button" wire:click="declineorder({{ $order_item->id }},2)"
                                                class="btn btn-danger btn-sm rounded mx-2">Decline</button>
                                        @endif


                                        @if ($order_item->status == 3 && $order_item->payment_status == 1)
                                            <button type="button" wire:click="received({{ $order_item->id }},4)"
                                                class="btn btn-success btn-sm rounded mx-2">Received</button>
                                        @endif

                                        @if ($order_item->status == 1 && $order_item->payment_status == 0)
                                            <input class="form-check-input" type="checkbox"
                                                @if ($checked) checked @endif
                                                wire:click="toggleCheckbox({{ $order_item->id }}, {{ $order_item->total_amount }}, $event.target.checked)">
                                            @php
                                                $visible = true;
                                            @endphp
                                        @endif
                                        @if ($order->is_confim == 0)
                                            <a wire:click="confirmDelete({{$order_item->id}})" class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span class="small"></span></a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @if ($totalPayabaleAmount > 0 || $visible)
                            <tfoot>
                                <tr>
                                    <th colspan="12" class="text-right">
                                        @if ($totalPayabaleAmount > 0)
                                            <button href="javascript:void(0);" class="btn btn-primary "
                                                @if (!$visible) disabled @endif
                                                wire:click="createOrder('{{ $order->id ?? $orderItemId }}','{{ $totalPayabaleAmount }}')">
                                                Pay Now (₹{{ $totalPayabaleAmount }})
                                            </button>
                                        @endif
                                    </th>
                                    <th>
                                        @if ($visible)
                                            Checked All <br>
                                            <input class="form-check-input" type="checkbox"
                                                wire:click="toggleCheckboxAll($event.target.checked,'{{ $order->id ?? $orderItemId }}')">
                                        @endif
                                    </th>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                    <div class="pagination-wrapper">
                        {{-- {{ $orders->links() }} --}}
                    </div>
                </div>
            </div>
            @if (($order->is_confim ?? 0) == 0)
                <div class="card-footer">
                    <a href="javascript:void(0);" wire:click="confirmOrder({{ $order->id ?? $orderItemId }})"
                        class="btn btn-primary "> Confirm </a>
                </div>
            @endif
        @else
            <div class="my-2">
                <div class="alert alert-info">No Item found!</div>
            </div>
        @endif
    </div>
</div>
@section('footerscript')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function validateMaxQuantity(input) {
            // Get the max quantity value
            var maxQuantity = parseInt(input.getAttribute('max'));

            // If the current value exceeds max quantity, reset it to max
            if (parseInt(input.value) > maxQuantity) {
                input.value = maxQuantity;
            }
        }


        document.addEventListener('razorpay-show', (event) => {
            // Access event data using event.detail
            amount = event.__livewire.params[0].amount;
            orderId = event.__livewire.params[0].orderId;
            order_id = event.__livewire.params[0].order_id;

            var options = {
                // "key": "{{ env('RAZORPAY_KEY') }}",
                "key": "{{ config('services.razorpay.key') }}",
                "amount": amount * 100, // Convert to paise
                "currency": "INR",
                "order_id": orderId,
                "name": "Test Payment",
                "description": "Payment for product/service",
                "image": "https://example.com/your-logo.png",
                "handler": function(response) {
                    console.log(response)
                    // Example data to send
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
                    "color": "#009dec"
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
            event.preventDefault();
        });
    </script>
@endsection
