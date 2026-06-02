<div>
    <!-- 📄 Breadcrumb & Header -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Reports</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('sparepart.dashboard') }}"><i class="bx bx-home-alt text-primary"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Counter Sales Report</li>
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
                               placeholder="Search Invoice No or Customer Name..." wire:model.live.debounce.300ms="search" style="min-width: 300px;">
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

                    <!-- 🏷️ Status Filter -->
                    <div>
                        <select class="form-select form-select-sm border-secondary" wire:model.live="statusFilter">
                            <option value="">All Payment Statuses</option>
                            <option value="0">Un-paid</option>
                            <option value="1">Partial Payment</option>
                            <option value="2">Full Paid</option>
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
        <!-- Total Bills - Light Blue -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #dbeafe;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #1e3a8a !important;">Total Bills</p>
                        <h4 class="mb-0 text-dark fw-bold" style="color: #1e3a8a !important;">{{ $totals['total'] }}</h4>
                        <span class="text-secondary small" style="color: #1e3a8a !important; opacity: 0.8;">Value: ₹{{ number_format((float)$totals['total_amount'], 2) }}</span>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-primary text-white"><i class="bx bx-receipt"></i></div>
                </div>
            </div>
        </div>

        <!-- Fully Paid - Light Green -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #dcfce7;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #166534 !important;">Fully Paid</p>
                        <h4 class="mb-0 text-dark fw-bold" style="color: #166534 !important;">{{ $totals['paid'] }}</h4>
                        <span class="text-secondary small" style="color: #166534 !important; opacity: 0.8;">Collected: ₹{{ number_format((float)$totals['paid_amount'], 2) }}</span>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-success text-white"><i class="bx bx-check-circle"></i></div>
                </div>
            </div>
        </div>

        <!-- Partially Paid - Light Yellow -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #fef9c3;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #854d0e !important;">Partially Paid</p>
                        <h4 class="mb-0 text-dark fw-bold" style="color: #854d0e !important;">{{ $totals['partial'] }}</h4>
                        <span class="text-secondary small" style="color: #854d0e !important; opacity: 0.8;">Pending: ₹{{ number_format((float)$totals['balance_amount'], 2) }}</span>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-warning text-dark"><i class="bx bx-loader-circle"></i></div>
                </div>
            </div>
        </div>

        <!-- Unpaid - Light Red -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #ffe4e6;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #9f1239 !important;">Unpaid Bills</p>
                        <h4 class="mb-0 text-dark fw-bold" style="color: #9f1239 !important;">{{ $totals['unpaid'] }}</h4>
                        <span class="text-secondary small" style="color: #9f1239 !important; opacity: 0.8;">Uncollected: ₹{{ number_format((float)($totals['total_amount'] - $totals['paid_amount']), 2) }}</span>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-danger text-white"><i class="bx bx-x-circle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 📊 Main Data Table Card -->
    <div class="card rounded-4 shadow-sm border-0">
        <div class="card-body p-4">
            <h5 class="mb-3 text-dark">Counter Sales List</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice No</th>
                            <th>Customer Name</th>
                            <th>Mobile</th>
                            <th>Date</th>
                            <th class="text-end">Subtotal (₹)</th>
                            <th class="text-end">Net Total (₹)</th>
                            <th class="text-end">Paid (₹)</th>
                            <th class="text-end">Balance (₹)</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        @forelse($sales as $s)
                            @php
                                $discount = (float)$s->total - (float)$s->subtotal;
                            @endphp
                            <tr>
                                <td><strong>#{{ $s->countersale_number }}</strong></td>
                                <td>{{ $s->Customer->name ?? 'N/A' }}</td>
                                <td>{{ $s->Customer->mobile_no ?? 'N/A' }}</td>
                                <td>{{ $s->date ? \Carbon\Carbon::parse($s->date)->format('d M Y') : 'N/A' }}</td>
                                <td class="text-end">₹{{ number_format((float)$s->total, 2) }}</td>
                                <td class="text-end fw-semibold">₹{{ number_format((float)$s->subtotal, 2) }}</td>
                                <td class="text-end text-success">₹{{ number_format((float)$s->partial_amount, 2) }}</td>
                                <td class="text-end text-danger fw-semibold">₹{{ number_format((float)$s->balance_amount, 2) }}</td>
                                <td class="text-center">
                                    @switch((int)$s->status)
                                        @case(0) <span class="badge bg-danger text-white">Un-paid</span> @break
                                        @case(1) <span class="badge bg-warning text-dark">Partial</span> @break
                                        @case(2) <span class="badge bg-success text-white">Full Paid</span> @break
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary" wire:click="viewSale({{ $s->id }})" data-bs-toggle="modal" data-bs-target="#saleDetailsModal">
                                        <i class="bx bx-show-alt"></i> View Items
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-secondary py-4">No matching counter sales found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 📄 Pagination -->
            <div class="mt-3 d-flex justify-content-end">
                {{ $sales->links() }}
            </div>
        </div>
    </div>

    <!-- 🧾 Sale Details Modal -->
    <div wire:ignore.self class="modal fade" id="saleDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-white text-dark">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Counter Sale Details #{{ $selectedSale->countersale_number ?? '' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-dark">
                    @if($selectedSale)
                        <!-- Customer Details -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-primary mb-2"><i class="bx bx-user"></i> Customer Details</h6>
                                <p class="mb-1 text-dark"><strong>Name:</strong> {{ $selectedSale->Customer->name ?? 'N/A' }}</p>
                                <p class="mb-1 text-dark"><strong>Mobile:</strong> {{ $selectedSale->Customer->mobile_no ?? 'N/A' }}</p>
                                <p class="mb-1 text-dark"><strong>Email:</strong> {{ $selectedSale->Customer->email ?? '-' }}</p>
                                <p class="mb-0 text-dark"><strong>Address:</strong> {{ $selectedSale->Customer->address ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-primary mb-2"><i class="bx bx-receipt"></i> Invoice Details</h6>
                                <p class="mb-1 text-dark"><strong>Date:</strong> {{ $selectedSale->date ? \Carbon\Carbon::parse($selectedSale->date)->format('d M Y') : 'N/A' }}</p>
                                <p class="mb-1 text-dark"><strong>Payment Mode:</strong> {{ ucfirst($selectedSale->payment_type ?? 'N/A') }}</p>
                                <p class="mb-1 text-dark"><strong>GST Applied:</strong> {{ $selectedSale->is_gst ? 'Yes' : 'No' }}</p>
                                <p class="mb-0 text-dark"><strong>Status:</strong>
                                    @switch((int)$selectedSale->status)
                                        @case(0) <span class="badge bg-danger">Un-paid</span> @break
                                        @case(1) <span class="badge bg-warning text-dark">Partial</span> @break
                                        @case(2) <span class="badge bg-success">Full Paid</span> @break
                                    @endswitch
                                </p>
                            </div>
                        </div>

                        <!-- Sale Items Table -->
                        <h6 class="text-primary mb-2"><i class="bx bx-package"></i> Sold Parts / Items</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle text-dark">
                                <thead class="table-light">
                                    <tr>
                                        <th>Part Name</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Price (₹)</th>
                                        <th class="text-end">Total (₹)</th>
                                        <th class="text-end">Discount (₹)</th>
                                        <th class="text-end">Final Amount (₹)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($selectedSale->counterSalesSpareParts as $part)
                                        <tr>
                                            <td><strong class="text-dark">{{ $part->stock_label_name }}</strong></td>
                                            <td class="text-center">{{ $part->quantity }}</td>
                                            <td class="text-end">₹{{ number_format((float)$part->price, 2) }}</td>
                                            <td class="text-end">₹{{ number_format((float)$part->total_amount, 2) }}</td>
                                            <td class="text-end">₹{{ number_format((float)$part->discount, 2) }}</td>
                                            <td class="text-end fw-semibold">₹{{ number_format((float)$part->final_amount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Invoice Summary -->
                        <div class="row justify-content-end mt-3">
                            <div class="col-md-5">
                                <table class="table table-sm text-dark border-0">
                                    <tr>
                                        <td class="border-0">Subtotal Gross:</td>
                                        <td class="text-end border-0">₹{{ number_format((float)$selectedSale->total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-0">Discount Deductions:</td>
                                        <td class="text-end border-0 text-warning">- ₹{{ number_format((float)($selectedSale->total - $selectedSale->subtotal), 2) }}</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td class="border-top">Net Payable:</td>
                                        <td class="text-end border-top text-primary">₹{{ number_format((float)$selectedSale->subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-0 text-success">Total Paid:</td>
                                        <td class="text-end border-0 text-success">₹{{ number_format((float)$selectedSale->partial_amount, 2) }}</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td class="border-top text-danger">Outstanding Balance:</td>
                                        <td class="text-end border-top text-danger">₹{{ number_format((float)$selectedSale->balance_amount, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
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
