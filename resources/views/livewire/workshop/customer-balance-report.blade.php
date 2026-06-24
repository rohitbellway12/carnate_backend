<div class="container-fluid mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="mb-0 fw-bold text-dark">Customer Balance Report</h5>

            <div class="d-flex flex-wrap align-items-end justify-content-end gap-3">
                <!-- 🔍 Search -->
                <div>
                    <label class="form-label mb-1 fw-semibold text-secondary small">Search</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Search customer..." wire:model.live="search" style="min-width:180px;">
                </div>

                <!-- 🗓️ Filter Type -->
                <div>
                    <label class="form-label mb-1 fw-semibold text-secondary small">Filter Type</label>
                    <select class="form-select form-select-sm" wire:model.live="filterType" style="min-width:130px;">
                        <option value="">All</option>
                        <option value="daily">Today</option>
                        <option value="weekly">This Week</option>
                        <option value="monthly">This Month</option>
                    </select>
                </div>

                <!-- 📅 From Date -->
                <div>
                    <label class="form-label mb-1 fw-semibold text-secondary small">From</label>
                    <input type="date" class="form-control form-control-sm" wire:model.lazy="fromDate">
                </div>

                <!-- 📅 To Date -->
                <div>
                    <label class="form-label mb-1 fw-semibold text-secondary small">To</label>
                    <input type="date" class="form-control form-control-sm" wire:model.lazy="toDate">
                </div>

                <!-- ⚖️ Balance Filter -->
                <div>
                    <label class="form-label mb-1 fw-semibold text-secondary small">Balance Status</label>
                    <select class="form-select form-select-sm" wire:model.live="balanceFilter" style="min-width:150px;">
                        <option value="has_balance">Has Balance (Pending)</option>
                        <option value="all">All Customers</option>
                    </select>
                </div>

                <!-- 🧾 Export PDF -->
                <div>
                    <label class="form-label mb-1 text-white">.</label>
                    <button class="btn btn-sm btn-secondary d-flex align-items-center gap-1" wire:click="downloadPDF">
                        <i class="bx bxs-file-pdf"></i> Export PDF
                    </button>
                </div>
            </div>
        </div>

        <!-- 📊 Stats Section -->
        <div class="px-3 pt-3 w-100">
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="card text-white bg-info bg-gradient rounded-4 shadow h-100 border-0">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 text-white-50" style="font-size:.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Customers</p>
                                <span class="fw-bold fs-4">{{ $totals['total_customers'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px;">
                                <i class="bx bx-user fs-4 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card text-white bg-primary bg-gradient rounded-4 shadow h-100 border-0">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 text-white-50" style="font-size:.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Total Bill Amount</p>
                                <span class="fw-bold fs-4">₹{{ number_format($totals['total_bill'] ?? 0, 2) }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px;">
                                <i class="bx bx-receipt fs-4 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card text-white bg-success bg-gradient rounded-4 shadow h-100 border-0">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 text-white-50" style="font-size:.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Total Paid</p>
                                <span class="fw-bold fs-4">₹{{ number_format($totals['total_paid'] ?? 0, 2) }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px;">
                                <i class="bx bx-check-circle fs-4 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card text-white bg-danger bg-gradient rounded-4 shadow h-100 border-0">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 text-white-50" style="font-size:.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Outstanding Balance</p>
                                <span class="fw-bold fs-4">₹{{ number_format($totals['total_balance'] ?? 0, 2) }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px;">
                                <i class="bx bx-money fs-4 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 📋 Data Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">#</th>
                            <th class="py-3">Customer Name</th>
                            <th class="py-3">Mobile No.</th>
                            <th class="py-3 text-center">Job Cards Count</th>
                            <th class="py-3 text-end">Bill Amount</th>
                            <th class="py-3 text-end">Paid Amount</th>
                            <th class="py-3 text-end text-danger">Pending Balance</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $c)
                            <tr>
                                <td>{{ $loop->iteration + ($customers->currentPage()-1)*$customers->perPage() }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold text-dark">{{ $c->name }} {{ $c->lastname }}</span>
                                        @if($c->email)
                                            <small class="text-muted" style="font-size: 0.75rem;">{{ $c->email }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $c->mobile_no ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary rounded-pill px-2.5 py-1.5">{{ $c->jobcards_count }}</span>
                                </td>
                                <td class="text-end">₹{{ number_format($c->total_bill, 2) }}</td>
                                <td class="text-end text-success">₹{{ number_format($c->total_paid, 2) }}</td>
                                <td class="text-end fw-bold text-danger">₹{{ number_format($c->total_balance, 2) }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary px-3 py-1" wire:click="viewCustomerBalances({{ $c->id }})" title="View Details">
                                        <i class="bx bx-show align-middle"></i> View Details
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="text-muted fs-6">No records found matching the criteria.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 📄 Pagination -->
            <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $customers->firstItem() ?? 0 }}–{{ $customers->lastItem() ?? 0 }} of {{ $customers->total() ?? 0 }} entries</small>
                <div>
                    {!! $customers->links() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- 🔍 View Details Modal -->
    <div class="modal fade @if($detail) show d-block @endif" tabindex="-1" style="@if($detail) display:block; background:rgba(0,0,0,.45); backdrop-filter: blur(4px); @endif" @if(!$detail) aria-hidden="true" @endif>
        <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light py-3">
                    <h5 class="modal-title fw-bold text-dark">
                        <i class="bx bx-user-circle me-1 align-middle text-primary"></i> Customer Balance Breakdown
                    </h5>
                    <button type="button" class="btn-close shadow-none" wire:click="$set('viewCustomerId', null)"></button>
                </div>
                <div class="modal-body p-4">
                    @if($detail)
                        <!-- Customer Info Card -->
                        <div class="card bg-light border-0 rounded-3 mb-4 shadow-none">
                            <div class="card-body p-3">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="text-muted small uppercase fw-semibold">Customer Name</div>
                                        <div class="fw-bold text-dark fs-6">{{ $detail->name }} {{ $detail->lastname }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-muted small uppercase fw-semibold">Email Address</div>
                                        <div class="text-dark">{{ $detail->email ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-muted small uppercase fw-semibold">Mobile Number</div>
                                        <div class="text-dark fw-semibold">{{ $detail->mobile_no ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Job Cards List -->
                        <h6 class="fw-bold text-dark mb-3">Job Cards Breakdown</h6>
                        <div class="table-responsive rounded-3 border">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-2.5">Job Card No.</th>
                                        <th class="py-2.5">Invoice Number</th>
                                        <th class="py-2.5">Vehicle</th>
                                        <th class="py-2.5">Created Date</th>
                                        <th class="py-2.5 text-end">Bill Amount</th>
                                        <th class="py-2.5 text-end text-success">Paid</th>
                                        <th class="py-2.5 text-end text-danger">Pending Balance</th>
                                        <th class="py-2.5 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($customerJobCards as $jc)
                                        <tr>
                                            <td class="fw-semibold text-primary">
                                                <a href="{{ route('workshop.jobcardedit', $jc->id) }}" class="text-decoration-none">
                                                    {{ $jc->jobcard_number }}
                                                </a>
                                            </td>
                                            <td class="fw-semibold text-primary">
                                                <a href="{{ route('workshop.jobcardedit', $jc->id) }}" class="text-decoration-none">
                                                    {{ $jc->shared_serial }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span>{{ $jc->vehical }}</span>
                                                    @if($jc->vehical_number)
                                                        <small class="text-muted" style="font-size: 0.72rem;">{{ $jc->vehical_number }}</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ optional($jc->created_at)->format('d-M-Y H:i A') }}</td>
                                            <td class="text-end">₹{{ number_format($jc->final_amount ?? $jc->amount ?? 0, 2) }}</td>
                                            <td class="text-end text-success">₹{{ number_format($jc->final_paid ?? 0, 2) }}</td>
                                            <td class="text-end fw-bold text-danger">₹{{ number_format($jc->balance_amount ?? 0, 2) }}</td>
                                            <td class="text-center">
                                                @php($s = $jc->status ?? 0)
                                                @php($label = ['Open','Confirmed','Completed','Closed'][$s] ?? '-')
                                                @php($cls = [
                                                    0 => 'bg-warning text-dark',
                                                    1 => 'bg-secondary text-white',
                                                    2 => 'bg-primary text-white',
                                                    3 => 'bg-danger text-white',
                                                ][$s] ?? 'bg-secondary text-white')
                                                <span class="badge {{ $cls }} rounded-pill px-2.5 py-1">{{ $label }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4 text-muted">No Job Cards found for this customer.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary px-4" wire:click="$set('viewCustomerId', null)">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
