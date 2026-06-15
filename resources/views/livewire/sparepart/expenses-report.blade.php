<div class="container-fluid mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <h5 class="mb-0">Expenses Report</h5>

            <div class="d-flex flex-wrap align-items-end justify-content-end gap-3">
                <!-- Search -->
                <div>
                    <label class="form-label mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Search bill, supplier, category..." wire:model.live="search">
                </div>

                <!-- Filter Type -->
                <div>
                    <label class="form-label mb-1">Filter Type</label>
                    <select class="form-select form-select-sm" wire:model.live="filterType">
                        <option value="">All</option>
                        <option value="daily">Today</option>
                        <option value="weekly">This Week</option>
                        <option value="monthly">This Month</option>
                    </select>
                </div>

                <!-- From Date -->
                <div>
                    <label class="form-label mb-1">From</label>
                    <input type="date" class="form-control form-control-sm" wire:model.lazy="fromDate">
                </div>

                <!-- To Date -->
                <div>
                    <label class="form-label mb-1">To</label>
                    <input type="date" class="form-control form-control-sm" wire:model.lazy="toDate">
                </div>

                <!-- Export PDF -->
                <div>
                    <label class="form-label mb-1 text-white">.</label>
                    <button class="btn btn-sm btn-secondary d-flex align-items-center gap-1" wire:click="downloadPDF">
                        <i class="bx bxs-file-pdf"></i> Export PDF
                    </button>
                </div>
            </div>
        </div>

        <div class="px-3 pt-3 w-100">
            <div class="row g-2">
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-info bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Total Entries</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['count'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0dcaf0" aria-hidden="true"><path d="M4 4h16v4H4zM4 10h16v4H4zM4 16h16v4H4z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-success bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Total Amount</p>
                                <span class="fw-bold" style="font-size:.85rem;">₹{{ number_format((float)($totals['total'] ?? 0), 2) }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#20c997" aria-hidden="true"><path d="M12 1C5.93 1 1 5.93 1 12s4.93 11 11 11 11-4.93 11-11S18.07 1 12 1zm1 17h-2v-2H8v-2h3v-2H8V8h3V6h2v2h3v2h-3v2h3v2h-3v2z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-primary bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Paid</p>
                                <span class="fw-bold" style="font-size:.85rem;">₹{{ number_format((float)($totals['paid'] ?? 0), 2) }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0d6efd" aria-hidden="true"><path d="M9 16.2l-3.5-3.5L4 14.2l5 5 12-12-1.5-1.5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-warning bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Balance</p>
                                <span class="fw-bold" style="font-size:.85rem;">₹{{ number_format((float)($totals['balance'] ?? 0), 2) }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#ffc107" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5zm0 7l-10 5 10 5 10-5-10-5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Bill No</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Supplier</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Balance</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $e)
                            <tr>
                                <td>{{ $loop->iteration + ($items->currentPage()-1)*$items->perPage() }}</td>
                                <td>{{ $e->bill_number }}</td>
                                <td>{{ $e->date }}</td>
                                <td>{{ $e->sparePartCategory->title ?? '-' }}</td>
                                <td>{{ $e->sparePartSupplier->business_first_name ?? '-' }}</td>
                                <td>₹{{ number_format((float)($e->total_amount ?? 0), 2) }}</td>
                                <td>₹{{ number_format((float)($e->paid_amount ?? 0), 2) }}</td>
                                <td>₹{{ number_format((float)($e->balance_amount ?? 0), 2) }}</td>
                                <td class="text-center"><a wire:click="viewExpense({{ $e->id }})" title="View"><i class="bx bx-show text-primary" style="font-size: 20px;"></i></a></td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center py-4">No expenses found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-3 py-2 d-flex justify-content-between">
                <small class="text-muted">Showing {{ $items->firstItem() }}–{{ $items->lastItem() }} of {{ $items->total() }}</small>
                {!! $items->links() !!}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade @if($detail) show d-block @endif" tabindex="-1" style="@if($detail) display:block; background:rgba(0,0,0,.35); @endif" @if(!$detail) aria-hidden="true" @endif>
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Expense Details</h5>
                    <button type="button" class="btn-close" wire:click="$set('viewExpenseId', null)"></button>
                </div>
                <div class="modal-body">
                    @if($detail)
                        <div class="border rounded p-2 mb-2 shadow">
                            <div class="row g-2">
                                <div class="col-md-3"><div class="text-muted small">Bill No</div><div>{{ $detail->bill_number }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Date</div><div>{{ $detail->date }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Category</div><div>{{ $detail->sparePartCategory->title ?? '-' }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Supplier</div><div>{{ $detail->sparePartSupplier->business_first_name ?? '-' }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Total</div><div>₹{{ number_format((float)($detail->total_amount ?? 0), 2) }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Paid</div><div>₹{{ number_format((float)($detail->paid_amount ?? 0), 2) }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Balance</div><div>₹{{ number_format((float)($detail->balance_amount ?? 0), 2) }}</div></div>
                            </div>
                        </div>
                        <div>
                            <div class="text-muted small">Description</div>
                            <div>{{ $detail->description ?? '-' }}</div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="$set('viewExpenseId', null)">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
