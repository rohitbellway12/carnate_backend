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

    <div>
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
                                    wire:click="$set('showReasonModel', false)" data-bs-dismiss="modal">Cancel</button>
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

    <div class="modal @if ($showInvoiceModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showInvoiceModal) block @endif">
        <div class="modal-dialog modal-s">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Invoice</h4>
                    <button type="button" class="btn-close" wire:click="closeInvoiceModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    <div class="mb-3 d-flex justify-content-center align-items-center gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model.live="invoiceType" id="workshop"
                                value="0">
                            <label class="form-check-label" for="workshop">Workshop Invoice</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model.live="invoiceType" id="sparePart"
                                value="1">
                            <label class="form-check-label" for="sparePart">Spare Part Invoice</label>
                        </div>
                    </div>
                    <div>
                        @if ($spareInvoice)
                            <table class="table">
                                <tbody>
                                    @foreach ($sparePartVendor as $spId => $spName)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $spName }}</td>
                                            <td style="width: 10px">
                                                <a class="btn btn-outline-secondary mx-1"
                                                    wire:click="sparePartInvoice({{ $spId }},0)"
                                                    href="javascript:void(0)" data-toggle="tooltip" data-placement="top"
                                                    title="Download PDF">
                                                    <i class="fa fa-file-pdf"></i>
                                                </a>
                                            </td>
                                            <td style="width: 10px">
                                                <a class="btn btn-outline-secondary mx-1"
                                                    wire:click="sparePartInvoice({{ $spId }},1)"
                                                    href="javascript:void(0)" data-toggle="tooltip"
                                                    data-placement="top" title="Download PDF">
                                                    <i class="fa fa-print" style="font-size: small;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center">
                                <a class="btn btn-outline-secondary mx-1"
                                    href="{{ route('getWorkshopinvoPdf', [encrypt($invoiceId), encrypt(0)]) }}"
                                    target="_blank"
                                    data-toggle="tooltip" data-placement="top" title="Download PDF">
                                    <i class="fa fa-file-pdf"></i>
                                </a>

                                <a class="btn btn-outline-secondary mx-1"
                                    href="{{ route('getWorkshopinvoPdf', [encrypt($invoiceId), encrypt(1)]) }}"
                                    target="_blank"
                                    data-toggle="tooltip" data-placement="top" title="Download PDF">
                                    <i class="fa fa-print" style="font-size: small;"></i>
                                </a>
                            </div>
                        @endif
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeInvoiceModal"
                        data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    @if ($showOrderItem)
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="breadcrumb-title pe-2" style="border: none;">Order Item # Id {{ $this->orderId }} </div>
                <div class="pe-3">
                    <a href="javascript:void(0);" wire:click="back" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                            class="bx bx-back"></i>Back</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Workshop Vendor Detail</h5>
                    </div>
                    <div class="card-body">
                        {{-- <h3>{{ ucfirst($orders->workShopVendor->first_name) }} {{ ucfirst($orders->workShopVendor->lastname) }}
                        </h3>
                        <p class="m-0"> <b> Mobile Number </b> :- {{ $orders->workShopVendor->mobile_no }} </p>
                        <p class="m-0"> <b> Address </b> :- {{ $orders->workShopVendor->address }} </p>
                        <p class="m-0"> <b> GST Number </b> :- {{ $orders->workShopVendor->gst_number }} </p> --}}

                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width: 150px; white-space: nowrap;">Name</th>
                                    <td style="width: 10px;">:</td>
                                    <td>{{ ucfirst(($orders->workShopVendor->name ?? '').' '.($orders->workShopVendor->lastname ?? '')) }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 150px; white-space: nowrap;">Company Name</th>
                                    <td style="width: 10px;">:</td>
                                    <td>{{ $orders->workShopVendor->company_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 150px; white-space: nowrap;">Mobile Number</th>
                                    <td style="width: 10px;">:</td>
                                    <td>{{ $orders->workShopVendor->mobile_no ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 150px; white-space: nowrap;">GST Number</th>
                                    <td style="width: 10px;">:</td>
                                    <td>{{ $orders->workShopVendor->gst ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 150px; white-space: nowrap;">Address</th>
                                    <td style="width: 10px;">:</td>
                                    <td>{{ $orders->workShopVendor->address ?? '-' }}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Spare Part Vendor Detail</h5>
                    </div>
                    @php
                        $spVendor = optional($orders->orderItem->first())->sparePartVendor;
                    @endphp
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width: 150px; white-space: nowrap;">Name</th>
                                    <td style="width: 10px;">:</td>
                                    <td>{{ ucfirst((($spVendor->name ?? '')).' '.(($spVendor->lastname ?? ''))) }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 150px; white-space: nowrap;">Company Name</th>
                                    <td style="width: 10px;">:</td>
                                    <td>{{ $spVendor->company_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 150px; white-space: nowrap;">Mobile Number</th>
                                    <td style="width: 10px;">:</td>
                                    <td>{{ $spVendor->mobile_no ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 150px; white-space: nowrap;">GST Number</th>
                                    <td style="width: 10px;">:</td>
                                    <td>{{ $spVendor->gst_number ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 150px; white-space: nowrap;">Address</th>
                                    <td style="width: 10px;">:</td>
                                    <td>{{ $spVendor->address ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
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
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                wire:click="shoImage({{ $order_item->id }})">
                                                @if (!empty($order_item->SpareParts->Image->file))
                                                    <img src="{{ asset($order_item->SpareParts->Image->file) }}"
                                                        alt="Maintenance Service Parts" height="50"
                                                        width="50px">
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
                                        <td>{{ $order_item->SpareParts->tax_percentage ?? 0 }} %</td>
                                        <td>
                                            @php
                                                $totalTax =
                                                    $order_item->price *
                                                    ($order_item->SpareParts->tax_percentage / 100);
                                                $taxableAmount = $totalTax * $order_item->quantity;
                                            @endphp
                                            {{ $taxableAmount }}
                                        </td>
                                        <td>{{ $order_item->price }}</td>
                                        <td>{{ $order_item->total_amount }}</td>
                                        <td>
                                            @if ($order_item->status == 0)
                                                <p class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Awaiting acceptance/rejection from Spare Part Vendor">Pending</p>
                                            @elseif($order_item->status == 1)
                                                @if ($order_item->payment_status == 0)
                                                    <p class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Item accepted by Spare Part Vendor; awaiting payment from Workshop">Awaiting Payment</p>
                                                @else
                                                    <p class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Order accepted by Spare Part Vendor; awaiting Handover">Accepted</p>
                                                @endif
                                            @elseif($order_item->status == 2)
                                                <p class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Order declined by Spare Part Vendor. Reason: {{ $order_item->reason }}">Declined</p>
                                                <a class="badge bg-danger  badge-sm text-white"
                                                    href="javascript:void(0);"
                                                    wire:click="showdeclineorder({{ $order_item->id }},2)"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Order declined by Spare Part Vendor. Reason: {{ $order_item->reason }}">Declined Reason</a>
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
                <div class="my-2 card-body">
                    <div class="alert alert-info">No Order found!</div>
                </div>
            @endif
        </div>
    @else
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="breadcrumb-title pe-2" style="border: none;">Order</div>
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
                        <input type="text" class="form-control" placeholder="Search Order No. "
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
            @if (!empty($orders) && $orders->count())
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    {{-- <th>S.No.</th> --}}
                                    <th>Order No.</th>
                                    <th>Items</th>
                                    <th>Order Date</th>
                                    <th>Amount</th>
                                    <th>Qty</th>
                                    <th>Item</th>
                                    <th>Handover</th>
                                    <th>Received</th>
                                    <th><small>Pending for<br>Payment</small></th>
                                    <th><small>Payment<br>Status</small></th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $index => $order)
                                    <tr>
                                        {{-- <td>{{ $orders->total() - ($orders->firstItem() + $index) + 1 }}</td> --}}
                                        <td>{{ $order->id }}</td>
                                        <td style="max-width: 200px;">
                                            @php
                                                $orderItem = implode(', ', $order->orderItem->pluck('SpareParts.name')->filter()->toArray());
                                            @endphp
                                            <span class="d-inline-block text-truncate" style="max-width: 100%;" title="{{ $orderItem }}" data-bs-toggle="tooltip">
                                                {{ $orderItem }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($order->order_date)
                                                {{ carbon\carbon::parse($order->order_date)->format('d-M-Y') }} <br>
                                                {{ carbon\carbon::parse($order->order_date)->format('h:i A') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-end">{{ number_format($order->total_amount, 2) }}</td>
                                        <td>{{ $order->total_quantity }}</td>
                                        <td>{{ $order->total_item }}</td>
                                        <td>{{ $order->orderItem->where('status', 3)->count() }}</td>
                                        <td>{{ $order->orderItem->where('status', 4)->count() }}</td>
                                        <td>{{ $order->orderItem->where('status', 1)->where('payment_status', 0)->count() }}
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
                                                        <span class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Order accepted by Spare Part Vendor; awaiting payment from Workshop">Awaiting Payment</span>
                                                    @else
                                                        <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Order accepted by Spare Part Vendor; awaiting Handover">Accepted</span>
                                                    @endif
                                                @break

                                                @case(0)
                                                    <span class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Awaiting acceptance/rejection from Spare Part Vendor">Pending</span>
                                                @break

                                                @case(3)
                                                    @if ($order->payment_status == 0)
                                                        <span class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Order partially accepted by Spare Part Vendor; awaiting payment from Workshop">Awaiting Payment</span>
                                                    @elseif ($order->orderItem->contains('status', 3) || $order->orderItem->contains('status', 4))
                                                        <span class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Items handed over by Spare Part Vendor; awaiting receipt by Workshop">Handover</span>
                                                    @else
                                                        <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Some items accepted/rejected by Spare Part Vendor">Partially<br>Accepted</span>
                                                    @endif
                                                @break

                                                @case(4)
                                                    <span class="badge bg-info text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Items successfully received by Workshop">Received</span>
                                                @break

                                                @case(2)
                                                    <span class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Order declined by Spare Part Vendor. Reason: {{ $order->decline_reason }}">Decline</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm p-0 px-1"
                                                wire:click="view({{ $order->id }})">
                                                View Item
                                            </a>
                                            @if ($order->payment_status == 1)
                                                <a class="btn btn-primary btn-sm p-0 px-1"
                                                    wire:click="invoice({{ $order->id }})">
                                                    Invoice
                                                </a>
                                            @endif
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
        document.addEventListener('livewire:init', function() {
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
