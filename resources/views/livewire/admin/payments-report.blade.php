<div class="container-fluid mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-coins text-primary me-2"></i> Payments Report</h5>

            <div class="d-flex flex-wrap align-items-end justify-content-end gap-3">
                <!-- 🔍 Search -->
                <div>
                    <label class="form-label mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Search payment, order, vendor..." wire:model.live="search" style="min-width:180px;">
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="form-label mb-1">Status</label>
                    <select class="form-select form-select-sm" wire:model.live="statusFilter" style="min-width:130px;">
                        <option value="">All Statuses</option>
                        <option value="success">Success</option>
                        <option value="failed">Failed</option>
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
                <!-- Total Transactions - Light Blue -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#dbeafe;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#1d4ed8;">Total Transactions</p>
                                <span class="fw-bold fs-4" style="color:#1e3a8a;">{{ $totals['total'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#bfdbfe;">
                                <i class="fas fa-history" style="color:#1d4ed8;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Successful Payments - Light Green -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#dcfce7;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#15803d;">Successful Payments</p>
                                <span class="fw-bold fs-4" style="color:#14532d;">{{ $totals['success'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#bbf7d0;">
                                <i class="fas fa-check-circle" style="color:#15803d;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Failed Payments - Light Red -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#fee2e2;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#dc2626;">Failed Payments</p>
                                <span class="fw-bold fs-4" style="color:#7f1d1d;">{{ $totals['failed'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#fecaca;">
                                <i class="fas fa-times-circle" style="color:#dc2626;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Revenue - Light Yellow -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#fef9c3;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#a16207;">Total Revenue (Settled)</p>
                                <span class="fw-bold fs-4" style="color:#713f12;">₹{{ number_format($totals['total_amount'] ?? 0, 2) }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#fde68a;">
                                <i class="fas fa-wallet" style="color:#a16207;"></i>
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
                            <th>Payment ID (Txn)</th>
                            <th>Order ID</th>
                            <th>Workshop Vendor</th>
                            <th>Payment Date</th>
                            <th class="text-end">Amount</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $p)
                            <tr>
                                <td>{{ $loop->iteration + ($payments->currentPage()-1)*$payments->perPage() }}</td>
                                <td class="fw-semibold">{{ $p->payment_id }}</td>
                                <td><span class="badge bg-secondary text-white">#{{ $p->order_id }}</span></td>
                                <td class="fw-semibold">{{ $p->user ? $p->user->name.' '.$p->user->lastname : 'N/A' }} <br><small class="text-muted">{{ $p->user->company_name ?? '' }}</small></td>
                                <td>{{ $p->created_at ? \Carbon\Carbon::parse($p->created_at)->format('d M Y, h:i A') : 'N/A' }}</td>
                                <td class="text-end fw-bold">₹{{ number_format($p->amount, 2) }}</td>
                                <td>
                                    @if(strtolower($p->status) === 'success')
                                        <span class="badge bg-success text-white px-2 py-1">Success</span>
                                    @else
                                        <span class="badge bg-danger text-white px-2 py-1">Failed</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-link p-0 text-primary" wire:click="viewPayment({{ $p->id }})" title="View Details">
                                        <i class="bx bx-show fs-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No payments found matching filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $payments->firstItem() ?? 0 }}–{{ $payments->lastItem() ?? 0 }} of {{ $payments->total() }}</small>
                {!! $payments->links() !!}
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade @if($detail) show d-block @endif" tabindex="-1" style="@if($detail) display:block; background:rgba(0,0,0,.45); @endif">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold"><i class="fas fa-coins me-2 text-primary"></i> Payment Details</h5>
                    <button type="button" class="btn-close" wire:click="$set('viewPaymentId', null)"></button>
                </div>
                <div class="modal-body p-4">
                    @if($detail)
                        <div class="row g-4">
                            <!-- Column 1: Payment General Info -->
                            <div class="col-12 col-md-6">
                                <div class="border rounded p-3 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-receipt text-primary me-2"></i> Payment Receipt</h6>
                                    <div class="mb-2"><strong>Transaction ID:</strong> <span class="text-muted">{{ $detail->payment_id }}</span></div>
                                    <div class="mb-2"><strong>Order ID:</strong> <span class="badge bg-dark">#{{ $detail->order_id }}</span></div>
                                    <div class="mb-2"><strong>Date / Time:</strong> {{ \Carbon\Carbon::parse($detail->created_at)->format('d M Y, h:i A') }}</div>
                                    <div class="mb-2"><strong>Payment Amount:</strong> <strong class="text-success fs-5">₹{{ number_format($detail->amount, 2) }}</strong></div>
                                    <div class="mb-0">
                                        <strong>Status:</strong>
                                        @if(strtolower($detail->status) === 'success')
                                            <span class="badge bg-success text-white">Success</span>
                                        @else
                                            <span class="badge bg-danger text-white">Failed</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Column 2: Workshop Vendor Info -->
                            <div class="col-12 col-md-6">
                                <div class="border rounded p-3 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-warehouse text-success me-2"></i> Workshop Vendor Info</h6>
                                    <div class="mb-2"><strong>Vendor Name:</strong> {{ $detail->user->name ?? 'N/A' }} {{ $detail->user->lastname ?? '' }}</div>
                                    <div class="mb-2"><strong>Company Name:</strong> {{ $detail->user->company_name ?? 'N/A' }}</div>
                                    <div class="mb-2"><strong>Email Address:</strong> {{ $detail->user->email ?? 'N/A' }}</div>
                                    <div class="mb-2"><strong>Mobile Number:</strong> {{ $detail->user->mobile_no ?? 'N/A' }}</div>
                                    <div class="mb-0"><strong>Address:</strong> {{ $detail->user->address ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- Row 2: Associated Order Item Details -->
                            @if($detail->order)
                                <div class="col-12">
                                    <div class="border rounded p-3 bg-light bg-opacity-50">
                                        <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-shopping-bag text-warning me-2"></i> Associated Order Summary (Order #{{ $detail->order->id }})</h6>
                                        <div class="row mb-3 small">
                                            <div class="col-4"><strong>Order Date:</strong> {{ \Carbon\Carbon::parse($detail->order->order_date)->format('d M Y, h:i A') }}</div>
                                            <div class="col-4"><strong>Total Order Amount:</strong> ₹{{ number_format($detail->order->total_amount, 2) }}</div>
                                            <div class="col-4"><strong>Items / Quantity:</strong> {{ $detail->order->total_item }} items (Qty: {{ $detail->order->total_quantity }})</div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Spare Part Name</th>
                                                        <th>Category</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th class="text-end">Price</th>
                                                        <th class="text-end">Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($detail->order->orderItem as $item)
                                                        <tr>
                                                            <td>
                                                                <div class="fw-semibold small">{{ $item->SpareParts->name ?? 'Spare Part Item' }}</div>
                                                                <small class="text-muted text-xs">SKU: {{ $item->SpareParts->sku ?? 'N/A' }}</small>
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
                                                            <td class="text-center">{{ $item->quantity }}</td>
                                                            <td class="text-end">₹{{ number_format($item->price, 2) }}</td>
                                                            <td class="text-end fw-semibold">₹{{ number_format($item->total_amount, 2) }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center py-2 text-muted">No items found.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary" wire:click="$set('viewPaymentId', null)">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
