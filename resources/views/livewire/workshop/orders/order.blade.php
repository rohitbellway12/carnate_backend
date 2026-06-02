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
                                        @if ($imageitem->SpareParts->spare_part_type == 1)
                                            <img src="{{ asset('img/accessory.png') }}" alt="Maintenance Service Parts"
                                                style="width: 100%; height: auto;">
                                        @elseif($imageitem->SpareParts->spare_part_type == 2)
                                            <img src="{{ asset('img/spareparts.jpg') }}" alt="Maintenance Service Parts"
                                                style="width: 100%; height: auto;">
                                        @elseif($imageitem->SpareParts->spare_part_type == 3)
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
                                    $visible = false;
                                    $totalTax = 0;
                                    $taxableAmount = 0;
                                @endphp
                                @foreach ($orders->orderItem as $index => $order_item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="javascript:void(0);" wire:click="shoImage({{ $order_item->id }})">
                                                @if (!empty($order_item->SpareParts->Image->file))
                                                    <img src="{{ asset($order_item->SpareParts->Image->file) }}"
                                                        alt="Maintenance Service Parts" height="50" width="50px">
                                                @else
                                                    @if ($order_item->SpareParts->spare_part_type == 1)
                                                        <img src="{{ asset('img/accessory.png') }}"
                                                            alt="Maintenance Service Parts" height="50"
                                                            width="50px">
                                                    @elseif($order_item->SpareParts->spare_part_type == 2)
                                                        <img src="{{ asset('img/spareparts.jpg') }}"
                                                            alt="Maintenance Service Parts" height="50"
                                                            width="50px">
                                                    @elseif($order_item->SpareParts->spare_part_type == 3)
                                                        <img src="{{ asset('img/tools.jpg') }}"
                                                            alt="Maintenance Service Parts" height="50"
                                                            width="50px">
                                                    @else
                                                        <img src="{{ asset('img/lubricant.jpg') }}"
                                                            alt="Maintenance Service Parts" height="50"
                                                            width="50px">
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
                                                @if ($order_item->payment_status == 0)
                                                    <p class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Item accepted by Spare Part Vendor; awaiting your payment">Awaiting Payment</p>
                                                @else
                                                    <p class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Item accepted by Spare Part Vendor; awaiting Handover">Accepted</p>
                                                @endif
                                            @elseif($order_item->status == 2)
                                                <p class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Order declined by Spare Part Vendor. Reason: {{ $order_item->reason }}">Declined</p>
                                                <a class="badge bg-danger  badge-sm text-white"
                                                    href="javascript:void(0);"
                                                    wire:click="showdeclineorder({{ $order_item->id }},2)"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Order declined by Spare Part Vendor. Reason: {{ $order_item->reason }}">Delayed Reason</a>
                                            @elseif($order_item->status == 3)
                                                <p class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Items handed over by Spare Part Vendor; awaiting receipt by Workshop"> Handover </p>
                                            @elseif($order_item->status == 4)
                                                <p class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Items successfully received by Workshop"> Received </p>
                                            @elseif($order_item->status == 5)
                                                <p class="badge bg-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Delivery delayed by Spare Part Vendor. Reason: {{ $order_item->reason }}">Delayed</p>
                                                <a class="badge bg-info  badge-sm text-white"
                                                    href="javascript:void(0);"
                                                    wire:click="showdeclineorder({{ $order_item->id }},5)"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delivery delayed by Spare Part Vendor. Reason: {{ $order_item->reason }}">Delayed Reason</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order_item->status == 5)
                                                <button type="button"
                                                    wire:click="changeItemStatus({{ $order_item->id }},1)"
                                                    class="btn btn-success btn-sm rounded mx-2">Accept</button>
                                                <button type="button"
                                                    wire:click="showdeclineorder({{ $order_item->id }},2)"
                                                    class="btn btn-danger btn-sm rounded mx-2">Decline</button>
                                            @endif
                                            @if ($order_item->status == 1 && $order_item->payment_status == 0)
                                                <input class="form-check-input" type="checkbox"
                                                    @if ($checked) checked @endif
                                                    wire:click="toggleCheckbox({{ $order_item->id }}, {{ $order_item->total_amount }}, $event.target.checked)">
                                                @php
                                                    $visible = true;
                                                @endphp
                                            @endif
                                            @if ($orders->is_confim == 0)
                                                <a wire:click="confirmDelete({{ $order_item->id }})"
                                                    class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i>
                                                    <span class="small"></span></a>
                                            @endif

                                            @if ($order_item->status == 3 && $order_item->payment_status == 1)
                                                <button type="button" wire:click="received({{ $order_item->id }},4)"
                                                    class="btn btn-success btn-sm rounded mx-2">Received</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @if ($totalPayabaleAmount > 0 || $visible)
                                <tfoot>
                                    <tr>
                                        <th colspan="9" class="text-right">
                                            @if ($totalPayabaleAmount > 0)
                                                <button href="javascript:void(0);" class="btn btn-primary "
                                                    @if (!$visible) disabled @endif
                                                    wire:click="createOrder('{{ $orderId }}','{{ $totalPayabaleAmount }}')">
                                                    Pay Now (₹{{ $totalPayabaleAmount }})
                                                </button>
                                            @endif
                                        </th>
                                        <th>
                                            @if ($visible)
                                                Checked All <br>
                                                <input class="form-check-input" type="checkbox"
                                                    wire:click="toggleCheckboxAll($event.target.checked,'{{ $orderId }}')">
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
            @else
                <div class="my-2">
                    <div class="alert alert-info">No Order found!</div>
                </div>
            @endif
        </div>
    @else
        <div class="modal @if ($showReasonModel) show @endif" tabindex="-1"
            style="opacity:1; background-color:#0606068c; display:@if ($showReasonModel) block @endif">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form wire:submit.prevent="declinereasonStore">
                        <div class="modal-header">
                            <h4 class="modal-title">Decline Reason</h4>
                            <button type="button" class="btn-close" wire:click="$set('showReasonModel', false)"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-3">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Decline Reason <sup class="text-danger">*</sup>
                                        </label>
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
                                <button type="button" class="btn btn-secondary"
                                    wire:click="$set('showReasonModel', false)"
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
                <div class="breadcrumb-title pe-2" style="border: none;">Order List</div>

            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Search Order..."
                            wire:model.live="searchfilter" fdprocessedid="blgf5">
                    </div>
                    <div class="col-3">
                        <input class="form-control form-control-solid" placeholder="Pick Dates"
                            id="kt_daterangepicker_1" />
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end"
                            wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="card mt-4">
            @if (!empty($items) && $items->count())
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Order No.</th>
                                    <th>Item Name</th>
                                    <th>Order Date</th>
                                    <th>Amount</th>
                                    <th>Total Items</th>
                                    <th>Dealer Pending</th>
                                    <th>Ready to Receive</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $order)
                                    <tr>
                                        <td> {{ $order->id }} </td>
                                        <td style="max-width: 200px;">
                                            @php
                                                $orderItem = implode(
                                                    ', ',
                                                    $order->orderItem->pluck('SpareParts.name')->filter()->toArray(),
                                                );
                                            @endphp
                                            <span class="d-inline-block text-truncate" style="max-width: 100%;"
                                                title="{{ $orderItem }}" data-bs-toggle="tooltip">
                                                {{ $orderItem }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y h:i A') ?? '-' }}
                                        </td>
                                        <td>{{ number_format($order->total_amount, 2) }}</td>
                                        <td>{{ $order->total_item }} Items</td>
                                        <td> 
                                            <span class="badge bg-warning text-dark">{{ $order->orderItem->where('status',1)->count() }}</span> 
                                        </td>
                                        <td> 
                                            <span class="badge bg-primary">{{ $order->orderItem->where('status',3)->count() }}</span> 
                                        </td>
                                        <td>

                                            @switch($order->payment_status)
                                                @case(0)
                                                    <span class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Awaiting payment from Workshop">Pending</span>
                                                @break

                                                @case(1)
                                                    <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Payment received successfully from Workshop">Success</span>
                                                @break

                                                @case(2)
                                                    <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Partially paid by Workshop">Partially<br>Paid</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            @switch($order->order_status)
                                                @case(1)
                                                    @if ($order->payment_status == 0)
                                                        <span class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Order accepted by Spare Part Vendor; awaiting your payment">Awaiting Payment</span>
                                                    @else
                                                        <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Order accepted by Spare Part Vendor; awaiting Handover">Accepted</span>
                                                    @endif
                                                @break

                                                @case(0)
                                                    <span class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Awaiting acceptance/rejection from Spare Part Vendor">Pending</span>
                                                @break

                                                @case(3)
                                                    @if ($order->payment_status == 0)
                                                        <span class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Order partially accepted by Spare Part Vendor; awaiting your payment">Awaiting Payment</span>
                                                    @else
                                                        <span class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Some items accepted/rejected by Spare Part Vendor">Partially<br>Accepted</span>
                                                    @endif
                                                @break

                                                @case(2)
                                                    <span class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Order declined by Spare Part Vendor. Reason: {{ $order->decline_reason }}">Decline</span>
                                                    <a class="badge bg-info  badge-sm text-white" href="javascript:void(0);"
                                                        wire:click="declineorder({{ $order->id }},2)"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Order declined by Spare Part Vendor. Reason: {{ $order->decline_reason }}">Declined Reason</a>
                                                @endswitch

                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm mb-1"
                                                    wire:click="viewItem({{ $order->id }})">View Item</a>

                                                @if ($order->payment_status == 0 && $order->order_status == 0)
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm mb-1"
                                                        wire:click="confirmDelete({{ $order->id }})">Cancel</a>
                                                @endif

                                              {{--  <a href="{{ route('getWorkshopinvoPdf', [encrypt($order->id), encrypt(0)]) }}"
                                                    class="btn btn-outline-secondary mx-1">
                                                    <i class="fa fa-file-pdf"></i></a>
                                                <a href="{{ route('getWorkshopinvoPdf', [encrypt($order->id), encrypt(1)]) }}"
                                                    class="btn btn-outline-secondary mx-1">
                                                    <i class="fa fa-print" style="font-size: small;"></i>
                                                </a>--}}

                                            </td>
                                        </tr>
                                        @php
                                            $orderIds[] = $order->id;
                                            $totalAmounts[] = $order->total_amount;
                                            $orderStatus[] = $order->order_status;

                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                {{ $items->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="my-2">
                        <div class="alert alert-info">No Order Cart Found!</div>
                    </div>
                @endif
            </div>
        @endif
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

            document.addEventListener('livewire:init', function() {

                tooltipLivewire();
                daterangepicker();

                Livewire.hook('morphed', (message, component) => {
                    tooltipLivewire();
                    daterangepicker();
                });

            });

            document.addEventListener('livewire:navigated', function() {
                tooltipLivewire();
                daterangepicker();
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

            function daterangepicker() {
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
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')],
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
            }
        </script>
    @endsection
