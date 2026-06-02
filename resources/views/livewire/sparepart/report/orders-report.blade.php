<div>
    <!-- 📄 Breadcrumb & Header -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Reports</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('sparepart.dashboard') }}"><i class="bx bx-home-alt text-primary"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Orders Report</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- 📊 Filters Panel -->
    <div class="card rounded-4 shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <!-- 🔍 Search Bar -->
                    <div class="position-relative">
                        <input type="text" class="form-control form-control-sm ps-5 border-secondary" 
                               placeholder="Search Invoice No, Order No..." wire:model.live.debounce.300ms="search" style="min-width: 250px;">
                        <span class="position-absolute top-50 translate-middle-y start-0 ps-3 text-secondary"><i class="bx bx-search fs-5"></i></span>
                    </div>

                    <!-- 🗓️ Date Quick Filter -->
                    <div>
                        <select class="form-select form-select-sm border-secondary" wire:model.live="filterType">
                            <option value="">All Time</option>
                            <option value="daily">Today</option>
                            <option value="weekly">This Week</option>
                            <option value="monthly">This Month</option>
                        </select>
                    </div>

                    <!-- 📅 From Date -->
                    <div>
                        <input type="date" class="form-control form-control-sm border-secondary" wire:model.live="fromDate">
                    </div>

                    <!-- 📅 To Date -->
                    <div>
                        <input type="date" class="form-control form-control-sm border-secondary" wire:model.live="toDate">
                    </div>

                    <!-- 🏷️ Item Status Filter -->
                    <div>
                        <select class="form-select form-select-sm border-secondary" wire:model.live="statusFilter">
                            <option value="">All Item Statuses</option>
                            <option value="0">Pending</option>
                            <option value="1">Accepted</option>
                            <option value="2">Declined</option>
                            <option value="3">Handover</option>
                            <option value="4">Received</option>
                            <option value="5">Delayed</option>
                        </select>
                    </div>

                    <!-- 🧾 Payment Status Filter -->
                    <div>
                        <select class="form-select form-select-sm border-secondary" wire:model.live="paymentStatusFilter">
                            <option value="">All Payments</option>
                            <option value="0">Pending</option>
                            <option value="1">Paid</option>
                            <option value="2">Partially Paid</option>
                        </select>
                    </div>
                </div>

                <!-- 🧾 Exports -->
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1" wire:click="downloadPDF">
                        <i class="bx bxs-file-pdf"></i> Export PDF
                    </button>
                    <button class="btn btn-sm btn-success text-white d-flex align-items-center gap-1" wire:click="downloadExcel">
                        <i class="bx bxs-spreadsheet"></i> Export Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 📈 Summary Cards Grid -->
    <div class="row g-3 mb-4">
        <!-- Total Orders - Light Blue -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #dbeafe;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #1e3a8a !important;">Total Orders</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #1e3a8a !important;">{{ $totals['total'] }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-primary text-white"><i class="bx bx-shopping-bag"></i></div>
                </div>
            </div>
        </div>

        <!-- Pending Items - Light Red -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #ffe4e6;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #9f1239 !important;">Pending Items</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #9f1239 !important;">{{ $totals['pending'] }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-danger text-white"><i class="bx bx-time-five"></i></div>
                </div>
            </div>
        </div>

        <!-- In-Flight Items - Light Purple -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #f3e8ff;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #581c87 !important;">Handover / In-Flight</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #581c87 !important;">{{ $totals['handover'] + $totals['accepted'] }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-warning text-dark"><i class="bx bx-sync"></i></div>
                </div>
            </div>
        </div>

        <!-- Sales Revenue / Earnings - Light Green -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #dcfce7;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #166534 !important;">My Items Total Value</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #166534 !important;">₹{{ number_format((float)$totals['total_amount'], 2) }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-success text-white"><i class="bx bx-wallet"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 📊 Main Data Table Card -->
    <div class="card rounded-4 shadow-sm border-0">
        <div class="card-body p-4">
            <h5 class="mb-3 text-dark">Orders List</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order No.</th>
                            <th>Invoice No.</th>
                            <th>Order Date</th>
                            <th>Total Items</th>
                            <th class="text-end">My Items Value (₹)</th>
                            <th class="text-center">Payment Status</th>
                            <th class="text-center">Order Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        @forelse($orders as $o)
                            @php
                                $myItems = $o->orderItem->where('user_id', $vendorId);
                            @endphp
                            <tr>
                                <td><strong>#{{ $o->id }}</strong></td>
                                <td><strong>{{ sparepartOrderReference($o) }}</strong></td>
                                <td>{{ $o->order_date ? \Carbon\Carbon::parse($o->order_date)->format('d M Y, h:i A') : 'N/A' }}</td>
                                <td><span class="badge bg-secondary">{{ $myItems->count() }} items</span></td>
                                <td class="text-end fw-semibold">₹{{ number_format((float)$myItems->sum('total_amount'), 2) }}</td>
                                <td class="text-center">
                                    @switch($o->payment_status)
                                        @case(0) <span class="badge bg-danger text-white">Pending</span> @break
                                        @case(1) <span class="badge bg-success text-white">Paid</span> @break
                                        @case(2) <span class="badge bg-warning text-dark">Partial</span> @break
                                        @default <span class="badge bg-secondary">Unknown</span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    @switch($o->order_status)
                                        @case(0) <span class="badge bg-danger text-white">Pending</span> @break
                                        @case(1) <span class="badge bg-primary text-white">Accepted</span> @break
                                        @case(2) <span class="badge bg-danger text-white">Declined</span> @break
                                        @case(3) <span class="badge bg-info text-white">Handover</span> @break
                                        @case(4) <span class="badge bg-success text-white">Received</span> @break
                                        @default <span class="badge bg-secondary">Pending</span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary" wire:click="viewOrder({{ $o->id }})" data-bs-toggle="modal" data-bs-target="#orderDetailsModal">
                                        <i class="bx bx-show-alt"></i> View Details
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-secondary py-4">No matching orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 📄 Pagination -->
            <div class="mt-3 d-flex justify-content-end">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    <!-- 🧾 Order Details Modal -->
    <div wire:ignore.self class="modal fade" id="orderDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-white text-dark">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Order Details #{{ $viewOrderId }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-dark">
                    @if($selectedOrder)
                        @php
                            $myItems = $selectedOrder->orderItem->where('user_id', $vendorId);
                        @endphp
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6 class="text-primary mb-2"><i class="bx bx-receipt"></i> Order Summary</h6>
                                <p class="mb-1 text-dark"><strong>Order No.:</strong> #{{ $selectedOrder->id }}</p>
                                <p class="mb-1 text-dark"><strong>Invoice No.:</strong> {{ sparepartOrderReference($selectedOrder) }}</p>
                                <p class="mb-1 text-dark"><strong>Order Date:</strong> {{ $selectedOrder->order_date ? \Carbon\Carbon::parse($selectedOrder->order_date)->format('d M Y, h:i A') : 'N/A' }}</p>
                                <p class="mb-1 text-dark"><strong>Payment Status:</strong> 
                                    @switch($selectedOrder->payment_status)
                                        @case(0) <span class="badge bg-danger">Pending</span> @break
                                        @case(1) <span class="badge bg-success">Paid</span> @break
                                        @case(2) <span class="badge bg-warning text-dark">Partial</span> @break
                                    @endswitch
                                </p>
                                <p class="mb-0 text-dark"><strong>Order Status:</strong>
                                    @switch($selectedOrder->order_status)
                                        @case(0) <span class="badge bg-danger">Pending</span> @break
                                        @case(1) <span class="badge bg-primary">Accepted</span> @break
                                        @case(2) <span class="badge bg-danger">Declined</span> @break
                                        @case(3) <span class="badge bg-info">Handover</span> @break
                                        @case(4) <span class="badge bg-success">Received</span> @break
                                    @endswitch
                                </p>
                            </div>
                        </div>

                        <!-- Order Items Table -->
                        <h6 class="text-primary mb-2"><i class="bx bx-package"></i> My Supplied Parts</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle text-dark">
                                <thead class="table-light">
                                    <tr>
                                        <th>Part Name</th>
                                        <th>Brand</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Unit Price (₹)</th>
                                        <th class="text-end">Total (₹)</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->SpareParts && $item->SpareParts->Image)
                                                        <img src="{{ asset('storage/' . $item->SpareParts->Image->path) }}" class="rounded me-2" width="36" height="36" alt="">
                                                    @endif
                                                    <strong class="text-dark">{{ $item->SpareParts->name ?? 'N/A' }}</strong>
                                                </div>
                                            </td>
                                            <td>{{ $item->SpareParts->brand ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">₹{{ number_format((float)$item->price, 2) }}</td>
                                            <td class="text-end fw-semibold">₹{{ number_format((float)$item->total_amount, 2) }}</td>
                                            <td class="text-center">
                                                @switch($item->status)
                                                    @case(0) <span class="badge bg-danger">Pending</span> @break
                                                    @case(1) <span class="badge bg-primary">Accepted</span> @break
                                                    @case(2) <span class="badge bg-danger">Declined</span> @break
                                                    @case(3) <span class="badge bg-info">Handover</span> @break
                                                    @case(4) <span class="badge bg-success">Received</span> @break
                                                    @case(5) <span class="badge bg-warning text-dark">Delayed</span> @break
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
