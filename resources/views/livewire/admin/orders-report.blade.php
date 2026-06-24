<div class="container-fluid mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-shopping-cart text-primary me-2"></i> Orders Report</h5>

            <div class="d-flex flex-wrap align-items-end justify-content-end gap-3">
                <!-- 🔍 Search -->
                <div>
                    <label class="form-label mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Search ID, workshop, part..." wire:model.live="search" style="min-width:180px;">
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="form-label mb-1">Order Status</label>
                    <select class="form-select form-select-sm" wire:model.live="statusFilter" style="min-width:130px;">
                        <option value="">All Statuses</option>
                        <option value="0">Pending</option>
                        <option value="1">Accepted</option>
                        <option value="2">Declined</option>
                        <option value="3">Handover</option>
                        <option value="4">Received</option>
                    </select>
                </div>

                <!-- Payment Status Filter -->
                <div>
                    <label class="form-label mb-1">Payment Status</label>
                    <select class="form-select form-select-sm" wire:model.live="paymentStatusFilter" style="min-width:130px;">
                        <option value="">All Payments</option>
                        <option value="0">Pending</option>
                        <option value="1">Success</option>
                        <option value="2">Partially Paid</option>
                    </select>
                </div>

                <!-- 🗓️ Filter Type -->
                <div>
                    <label class="form-label mb-1">Date Range</label>
                    <select class="form-select form-select-sm" wire:model.live="filterType" style="min-width:130px;">
                        <option value="">All Time</option>
                        <option value="daily">Today</option>
                        <option value="weekly">This Week</option>
                        <option value="monthly">This Month</option>
                    </select>
                </div>

                <!-- 📅 From Date -->
                <div>
                    <label class="form-label mb-1">From</label>
                    <input type="date" class="form-control form-control-sm" wire:model.live="fromDate">
                </div>

                <!-- 📅 To Date -->
                <div>
                    <label class="form-label mb-1">To</label>
                    <input type="date" class="form-control form-control-sm" wire:model.live="toDate">
                </div>

                <!-- 🧾 Export PDF & Excel -->
                <div class="d-flex gap-2">
                    <div>
                        <label class="form-label mb-1 text-white">.</label>
                        <button class="btn btn-sm btn-secondary d-flex align-items-center gap-1" wire:click="downloadPDF">
                            <i class="bx bxs-file-pdf"></i> Export PDF
                        </button>
                    </div>
                    <div>
                        <label class="form-label mb-1 text-white">.</label>
                        <button class="btn btn-sm btn-success text-white d-flex align-items-center gap-1" wire:click="downloadExcel">
                            <i class="bx bxs-spreadsheet"></i> Export Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-3 pt-3 w-100">
            <div class="row g-3">
                <!-- Total Orders - Light Blue -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#dbeafe;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#1d4ed8;">Total Orders</p>
                                <span class="fw-bold fs-4" style="color:#1e3a8a;">{{ $totals['total'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#bfdbfe;">
                                <i class="fas fa-shopping-bag" style="color:#1d4ed8;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pending & Declined - Light Red -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#fee2e2;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#dc2626;">Pending & Declined</p>
                                <span class="fw-bold fs-5" style="color:#7f1d1d;">Pending: {{ $totals['pending'] ?? 0 }}</span>
                                <span class="d-block small" style="color:#b91c1c;">Declined: {{ $totals['declined'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#fecaca;">
                                <i class="fas fa-exclamation-triangle" style="color:#dc2626;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Processing & Completed - Light Green -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#dcfce7;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#15803d;">Processing & Completed</p>
                                <span class="fw-bold fs-5" style="color:#14532d;">Received: {{ $totals['received'] ?? 0 }}</span>
                                <span class="d-block small" style="color:#166534;">In-Flight: {{ ($totals['accepted'] ?? 0) + ($totals['handover'] ?? 0) }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#bbf7d0;">
                                <i class="fas fa-truck-loading" style="color:#15803d;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Order Value - Light Purple -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#ede9fe;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#7c3aed;">Order Value / Paid</p>
                                <span class="fw-bold fs-5" style="color:#4c1d95;">₹{{ number_format($totals['total_amount'] ?? 0, 2) }}</span>
                                <span class="d-block small" style="color:#6d28d9;">Paid: ₹{{ number_format($totals['paid_amount'] ?? 0, 2) }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#ddd6fe;">
                                <i class="fas fa-money-bill-wave" style="color:#7c3aed;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0 mt-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Invoice Number</th>
                            <th>Items</th>
                            <th>Workshop</th>
                            <th>Order Date</th>
                            <th class="text-end">Amount</th>
                            <th class="text-center">Qty / Item</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $o)
                            <tr>
                                <td>{{ $loop->iteration + ($orders->currentPage()-1)*$orders->perPage() }}</td>
                                <td class="fw-bold">{{ getWorkshopInvoiceNumber($o) }}</td>
                                <td style="max-width:250px;">
                                    @php
                                        $orderItemsString = implode(', ', $o->orderItem->pluck('SpareParts.name')->filter()->toArray());
                                    @endphp
                                    <div class="text-truncate" title="{{ $orderItemsString }}">{{ $orderItemsString ?: 'N/A' }}</div>
                                </td>
                                <td>{{ $o->workShopVendor->company_name ?? ($o->workShopVendor ? $o->workShopVendor->name.' '.$o->workShopVendor->lastname : 'N/A') }}</td>
                                <td>{{ $o->order_date ? \Carbon\Carbon::parse($o->order_date)->format('d M Y, h:i A') : 'N/A' }}</td>
                                <td class="text-end fw-semibold">₹{{ number_format($o->total_amount, 2) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary text-white">{{ $o->total_quantity }} ({{ $o->total_item }})</span>
                                </td>
                                <td>
                                    @switch($o->payment_status)
                                        @case(0)
                                            <span class="badge bg-danger text-white px-2 py-1">Pending</span>
                                            @break
                                        @case(1)
                                            <span class="badge bg-success text-white px-2 py-1">Paid</span>
                                            @break
                                        @case(2)
                                            <span class="badge bg-warning text-dark px-2 py-1">Partially Paid</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary text-white px-2 py-1">Unknown</span>
                                    @endswitch
                                </td>
                                <td>
                                    @switch($o->order_status)
                                        @case(0)
                                            <span class="badge bg-danger text-white px-2 py-1">Pending</span>
                                            @break
                                        @case(1)
                                            @if ($o->payment_status == 0)
                                                <span class="badge bg-warning text-dark px-2 py-1">Awaiting Payment</span>
                                            @else
                                                <span class="badge bg-success text-white px-2 py-1">Accepted</span>
                                            @endif
                                            @break
                                        @case(2)
                                            <span class="badge bg-danger text-white px-2 py-1" title="Reason: {{ $o->decline_reason }}">Declined</span>
                                            @break
                                        @case(3)
                                            <span class="badge bg-primary text-white px-2 py-1">Handover</span>
                                            @break
                                        @case(4)
                                            <span class="badge bg-success text-white px-2 py-1">Received</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary text-white px-2 py-1">Pending</span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-link p-0 text-primary" wire:click="viewOrder({{ $o->id }})" title="View Details">
                                        <i class="bx bx-show fs-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-4 text-muted">No orders found matching filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $orders->firstItem() ?? 0 }}–{{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }}</small>
                {!! $orders->links() !!}
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade @if($detail) show d-block @endif" tabindex="-1" style="@if($detail) display:block; background:rgba(0,0,0,.45); @endif">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold"><i class="fas fa-shopping-bag me-2 text-primary"></i> Order Details: #{{ $detail->id ?? '' }}</h5>
                    <button type="button" class="btn-close" wire:click="$set('viewOrderId', null)"></button>
                </div>
                <div class="modal-body p-4">
                    @if($detail)
                        <div class="row g-4">
                            <!-- Column 1: General Info -->
                            <div class="col-12 col-md-6">
                                <div class="border rounded p-3 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-info-circle text-primary me-2"></i> Order Summary</h6>
                                    <div class="mb-2"><strong>Order No:</strong> #{{ $detail->id }}</div>
                                    <div class="mb-2"><strong>Invoice Number:</strong> {{ $detail->invoice_number ?? 'N/A' }}</div>
                                    <div class="mb-2"><strong>Order Date:</strong> {{ $detail->order_date ? \Carbon\Carbon::parse($detail->order_date)->format('d M Y, h:i A') : 'N/A' }}</div>
                                    <div class="mb-2"><strong>Total Ordered Items:</strong> {{ $detail->total_item }} items (Qty: {{ $detail->total_quantity }})</div>
                                    <div class="mb-2"><strong>Total Amount:</strong> <strong class="text-primary fs-5">₹{{ number_format($detail->total_amount, 2) }}</strong></div>
                                    <div class="mb-2">
                                        <strong>Payment Status:</strong>
                                        @switch($detail->payment_status)
                                            @case(0) <span class="badge bg-danger">Pending Payment</span> @break
                                            @case(1) <span class="badge bg-success">Success / Paid</span> @break
                                            @case(2) <span class="badge bg-warning text-dark">Partially Paid</span> @break
                                        @endswitch
                                    </div>
                                    <div class="mb-0">
                                        <strong>Order Status:</strong>
                                        @switch($detail->order_status)
                                            @case(0) <span class="badge bg-danger">Pending Acceptance</span> @break
                                            @case(1) <span class="badge bg-success">Accepted / Confirmed</span> @break
                                            @case(2) <span class="badge bg-danger">Declined</span> @break
                                            @case(3) <span class="badge bg-primary">Handover</span> @break
                                            @case(4) <span class="badge bg-success">Received</span> @break
                                        @endswitch
                                        @if($detail->order_status == 2 && $detail->decline_reason)
                                            <div class="mt-2 text-danger small"><strong>Decline Reason:</strong> {{ $detail->decline_reason }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Column 2: Workshop Vendor Info -->
                            <div class="col-12 col-md-6">
                                <div class="border rounded p-3 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-warehouse text-success me-2"></i> Workshop Vendor Details</h6>
                                    <div class="mb-2"><strong>Vendor Name:</strong> {{ $detail->workShopVendor->name ?? 'N/A' }} {{ $detail->workShopVendor->lastname ?? '' }}</div>
                                    <div class="mb-2"><strong>Company Name:</strong> {{ $detail->workShopVendor->company_name ?? 'N/A' }}</div>
                                    <div class="mb-2"><strong>Email Address:</strong> {{ $detail->workShopVendor->email ?? 'N/A' }}</div>
                                    <div class="mb-2"><strong>Mobile Number:</strong> {{ $detail->workShopVendor->mobile_no ?? 'N/A' }}</div>
                                    <div class="mb-0"><strong>Address:</strong> {{ $detail->workShopVendor->address ?? 'N/A' }}, {{ $detail->workShopVendor->cityName ? $detail->workShopVendor->cityName->name : '' }}</div>
                                </div>
                            </div>

                            <!-- Row 2: Order Items Breakdown -->
                            <div class="col-12">
                                <div class="border rounded p-3 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-list text-secondary me-2"></i> Order Items & Spare Part Vendors</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Part / Item Name</th>
                                                    <th>Category</th>
                                                    <th>Vendor</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-end">Price</th>
                                                    <th class="text-end">Tax %</th>
                                                    <th class="text-end">Total Amount</th>
                                                    <th class="text-center">Item Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($detail->orderItem as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="fw-semibold">{{ $item->SpareParts->name ?? 'Spare Part Item' }}</div>
                                                            <small class="text-muted">SKU: {{ $item->SpareParts->sku ?? 'N/A' }}</small>
                                                        </td>
                                                        <td>
                                                            @switch($item->category)
                                                                @case(1) <span class="badge bg-secondary text-white">Accessory</span> @break
                                                                @case(2) <span class="badge bg-primary text-white">Parts</span> @break
                                                                @case(3) <span class="badge bg-dark text-white">Tools</span> @break
                                                                @case(4) <span class="badge bg-warning text-dark">Lubricants</span> @break
                                                                @default <span class="badge bg-secondary text-white">N/A</span>
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            <div class="small fw-semibold">{{ $item->sparePartVendor->company_name ?? ($item->sparePartVendor ? $item->sparePartVendor->name.' '.$item->sparePartVendor->lastname : 'N/A') }}</div>
                                                            <div class="small text-muted">{{ $item->sparePartVendor->mobile_no ?? '' }}</div>
                                                        </td>
                                                        <td class="text-center fw-semibold">{{ $item->quantity }}</td>
                                                        <td class="text-end">₹{{ number_format($item->price, 2) }}</td>
                                                        <td class="text-end">{{ $item->SpareParts->tax_percentage ?? 0 }}%</td>
                                                        <td class="text-end fw-semibold">₹{{ number_format($item->total_amount, 2) }}</td>
                                                        <td class="text-center">
                                                            @switch($item->status)
                                                                @case(0) <span class="badge bg-danger text-white px-2 py-1">Pending</span> @break
                                                                @case(1)
                                                                    @if ($item->payment_status == 0)
                                                                        <span class="badge bg-warning text-dark px-2 py-1">Awaiting Payment</span>
                                                                    @else
                                                                        <span class="badge bg-success text-white px-2 py-1">Accepted</span>
                                                                    @endif
                                                                    @break
                                                                @case(2) <span class="badge bg-danger text-white px-2 py-1" title="Reason: {{ $item->reason }}">Declined</span> @break
                                                                @case(3) <span class="badge bg-primary text-white px-2 py-1">Handover</span> @break
                                                                @case(4) <span class="badge bg-success text-white px-2 py-1">Received</span> @break
                                                                @case(5) <span class="badge bg-info text-dark px-2 py-1" title="Reason: {{ $item->reason }}">Delayed</span> @break
                                                                @default <span class="badge bg-secondary text-white px-2 py-1">Pending</span>
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center py-3 text-muted">No items in this order.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary" wire:click="$set('viewOrderId', null)">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
