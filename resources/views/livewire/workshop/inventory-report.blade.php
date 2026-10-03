<div class="container-fluid mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <h5 class="mb-0">Inventory Report</h5>

            <div class="d-flex flex-wrap align-items-end justify-content-end gap-3">
                <!-- Search -->
                <div>
                    <label class="form-label mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Search Lebel,part, category..." wire:model.live="search">
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
            <div class="row g-2 ">
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-info bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Items</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['count'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0dcaf0" aria-hidden="true"><path d="M4 4h16v4H4zM4 10h16v4H4zM4 16h16v4H4z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-primary bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Total Qty</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['qty'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0d6efd" aria-hidden="true"><path d="M9 16.2l-3.5-3.5L4 14.2l5 5 12-12-1.5-1.5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-success bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Stock Value</p>
                                <span class="fw-bold" style="font-size:.85rem;">₹{{ number_format((float)($totals['value'] ?? 0), 2) }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#20c997" aria-hidden="true"><path d="M12 1C5.93 1 1 5.93 1 12s4.93 11 11 11 11-4.93 11-11S18.07 1 12 1zm1 17h-2v-2H8v-2h3v-2H8V8h3V6h2v2h3v2h-3v2h3v2h-3v2z"/></svg>
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
                            <th>Label</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Part No</th>
                            <th>Rack</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Value</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stocks as $s)
                            <tr>
                                <td>{{ $stocks->total() - ($loop->index + ($stocks->currentPage()-1)*$stocks->perPage()) }}</td>
                                <td>{{ $s->label->title ?? '-' }}</td>
                                <td>{{ $s->categories->title ?? $s->category ?? '-' }}</td>
                                <td>{{ $s->unit->title ?? '-' }}</td>
                                <td>{{ $s->part_number ?? '-' }}</td>
                                <td>{{ $s->rack_no ?? '-' }}</td>
                                <td>{{ $s->stock ?? 0 }}</td>
                                <td>₹{{ number_format((float)($s->price ?? 0), 2) }}</td>
                                <td>₹{{ number_format((float)(($s->price ?? 0) * ($s->stock ?? 0)), 2) }}</td>
                                <td class="text-center"><a wire:click="viewStock({{ $s->id }})" title="View"><i class="bx bx-show text-primary" style="font-size: 20px;"></i></a></td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center py-4">No stock found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-3 py-2 d-flex justify-content-between">
                <small class="text-muted">Showing {{ $stocks->firstItem() }}–{{ $stocks->lastItem() }} of {{ $stocks->total() }}</small>
                {!! $stocks->links() !!}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade @if($viewStockId) show d-block @endif" tabindex="-1" style="@if($viewStockId) display:block; background:rgba(0,0,0,.35); @endif" @if(!$viewStockId) aria-hidden="true" @endif>
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Stock Details</h5>
                    <button type="button" class="btn-close" wire:click="$set('viewStockId', null)"></button>
                </div>
                <div class="modal-body">
                    @if($detail)
                        <div class="border rounded p-2 mb-2 shadow">
                            <div class="row g-2">
                                <div class="col-md-3"><div class="text-muted small">Label</div><div>{{ $detail->label->title ?? '-' }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Category</div><div>{{ $detail->categories->title ?? $detail->category ?? '-' }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Unit</div><div>{{ $detail->unit->title ?? '-' }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Part No</div><div>{{ $detail->part_number ?? '-' }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Rack</div><div>{{ $detail->rack_no ?? '-' }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Qty</div><div>{{ $detail->stock ?? 0 }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Price</div><div>₹{{ number_format((float)($detail->price ?? 0), 2) }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Value</div><div>₹{{ number_format((float)(($detail->price ?? 0) * ($detail->stock ?? 0)), 2) }}</div></div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="$set('viewStockId', null)">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


