<div class="container-fluid mt-2">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="mb-0">Job cards Report</h5>

            <div class="d-flex flex-wrap align-items-end justify-content-end gap-3">
                <!-- 🔍 Search -->
                <div>
                    <label class="form-label mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Search customer..." wire:model.live="search" style="min-width:180px;">
                </div>

                <!-- 🗓️ Filter Type -->
                <div>
                    <label class="form-label mb-1">Filter Type</label>
                    <select class="form-select form-select-sm" wire:model.live="filterType" style="min-width:150px;">
                        <option value="">All</option>
                        <option value="daily">Today</option>
                        <option value="weekly">This Week</option>
                        <option value="monthly">This Month</option>
                    </select>
                </div>

                <!-- 📅 From Date -->
                <div>
                    <label class="form-label mb-1">From</label>
                    <input type="date" class="form-control form-control-sm" wire:model.lazy="fromDate">
                </div>

                <!-- 📅 To Date -->
                <div>
                    <label class="form-label mb-1">To</label>
                    <input type="date" class="form-control form-control-sm" wire:model.lazy="toDate">
                </div>

                <!-- ⚙️ Status Filter -->
                <div>
                    <label class="form-label mb-1">Status</label>
                    <select class="form-select form-select-sm" wire:model.live="status" style="min-width:150px;">
                        <option value="">All</option>
                        <option value=00>Open</option>
                        <option value="1">Confirmed</option>
                        <option value="2">Completed</option>
                        <option value="3">Closed</option>
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



        <div class="px-3 py-3 w-100">
            <div class="row g-2 ">
                <div class="col-6 col-md-3 col-xl-4">
                    <div class="card text-white bg-info bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Total Job Cards</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['total'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0dcaf0" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5zm0 7l-10 5 10 5 10-5-10-5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-4">
                    <div class="card text-white bg-primary bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Completed</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['completed'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0d6efd" aria-hidden="true"><path d="M9 16.2l-3.5-3.5L4 14.2l5 5 12-12-1.5-1.5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-4">
                    <div class="card text-white bg-secondary bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Confirmed</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['confirmed'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0d6efd" aria-hidden="true"><path d="M5 16.2l-3.5-3.5L4 14.2l5 5 15-12-1.5-1.5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-4">
                    <div class="card text-white bg-danger bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Close</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['closed'] ?? 0 }}</span>
                            </div>
                            {{-- <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0d6efd" aria-hidden="true"><path d="M5 16.2l-3.5-3.5L4 14.2l5 5 15-12-1.5-1.5z"/></svg>
                            </div> --}}
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0d6efd" aria-hidden="true">
                                  <path d="M18.3 5.71a1 1 0 0 0-1.41 0L12 10.59 7.11 5.7A1 1 0 1 0 5.7 7.11L10.59 12l-4.89 4.89a1 1 0 1 0 1.41 1.41L12 13.41l4.89 4.89a1 1 0 0 0 1.41-1.41L13.41 12l4.89-4.89a1 1 0 0 0 0-1.4z"/>
                                </svg>
                              </div>

                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-4">
                    <div class="card text-white bg-warning bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Open</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['open'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#ffc107" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5zm0 7l-10 5 10 5 10-5-10-5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-4">
                    <div class="card text-white bg-success bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Total Amount</p>
                                <span class="fw-bold" style="font-size:.85rem;">₹{{ number_format($totals['amount'] ?? 0, 2) }}</span>
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
                            <th>Jobcard No.</th>
                            <th>Customer</th>
                            <th>Vehicle</th>
                            <th>Amount</th>
                            <th>Status</th>

                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobcards as $j)
                            <tr>
                                <td>{{ $jobcards->total() - ($loop->index + ($jobcards->currentPage()-1)*$jobcards->perPage()) }}</td>
                                <td>{{ $j->jobcard_number }}</td>
                                <td>{{ $j->customer_name }}</td>
                                <td>{{ $j->vehical }} {{ $j->vehical_number ? '('.$j->vehical_number.')' : '' }}</td>
                                <td>₹{{ number_format($j->final_amount ?? $j->amount ?? 0, 2) }}</td>
                                <td>
                                    @php($s = $j->status ?? 0)
                                    @php($label = ['Open','Confirmed','Completed','Closed'][$s] ?? '-')
                                    @php($cls = [
                                        0 => 'badge bg-warning',
                                        1 => 'badge bg-secondary',
                                        2 => 'badge bg-primary',
                                        3 => 'badge bg-danger',
                                    ][$s] ?? 'badge bg-secondary')
                                    <span class="{{ $cls }}">{{ $label }}</span>
                                </td>
                                {{-- <td>{{ optional($j->created_at)->format('d M Y') }}</td> --}}
                                <td class="text-center">
                                    <a wire:click="viewJobCard({{ $j->id }})" title="View"><i class="bx bx-show text-primary" style="font-size: 20px;"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">No job cards found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-3 py-2 d-flex justify-content-between">
                <small class="text-muted">Showing {{ $jobcards->firstItem() }}–{{ $jobcards->lastItem() }} of {{ $jobcards->total() }}</small>
                {!! $jobcards->links() !!}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade @if($detail) show d-block @endif" tabindex="-1" style="@if($detail) display:block; background:rgba(0,0,0,.35); @endif" @if(!$detail) aria-hidden="true" @endif>
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Job Card Details</h5>
                    <button type="button" class="btn-close" wire:click="$set('viewJobCardId', null)"></button>
                </div>
                <div class="modal-body">
                    @if($detail)
                        <div class="border rounded p-2 mb-2 shadow">
                            <div class="row g-2 mb-1">
                                <div class="col-md-3"><div class="text-muted small">Jobcard No.</div><div>{{ $detail->jobcard_number }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Customer</div><div>{{ $detail->customer_name }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Vehicle</div><div>{{ $detail->vehical }} {{ $detail->vehical_number ? '('.$detail->vehical_number.')' : '' }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Created</div><div>{{ optional($detail->created_at)->format('d M Y') }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Amount</div><div>₹{{ number_format($detail->amount ?? 0, 2) }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Discount</div><div>₹{{ number_format($detail->discount ?? 0, 2) }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Final</div><div>₹{{ number_format($detail->final_amount ?? 0, 2) }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Advance</div><div>₹{{ number_format($detail->advance ?? 0, 2) }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Balance</div><div>₹{{ number_format($detail->balance_amount ?? 0, 2) }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Supervisor</div><div>{{ $detail->supervisor_id }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Delivery</div><div>{{ $detail->delivery_date }} {{ $detail->delivery_time }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Status</div>
                                    @php($ds = $detail->status ?? 0)
                                    @php($dlabel = ['Open','Confirmed','Completed','Closed'][$ds] ?? '-')
                                    @php($dcls = [
                                        0 => 'badge bg-warning',
                                        1 => 'badge bg-secondary',
                                        2 => 'badge bg-primary',
                                        3 => 'badge bg-danger',
                                    ][$ds] ?? 'badge bg-secondary')
                                    <div><span class="{{ $dcls }}">{{ $dlabel }}</span></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h6 class="mt-3 p-2">Spare Parts</h6>
                        <div class="table-responsive p-2 mb-2 shadow ">
                            <table class="table table-sm ">
                                <thead>
                                    <tr>
                                        <th>Label</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Final</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($detail->jobCardSpareParts as $p)
                                        <tr>
                                            <td>{{ $p->stock_label_name ?? '-' }}</td>
                                            <td>{{ $p->quantity ?? 0 }}</td>
                                            <td>₹{{ number_format($p->price ?? 0, 2) }}</td>
                                            <td>₹{{ number_format($p->discount ?? 0, 2) }}</td>
                                            <td>₹{{ number_format($p->final_amount ?? 0, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center">No spare parts added.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <h6 class="mt-3 p-2">Labour / Extra Charges</h6>
                        <div class="table-responsive p-2 mt-3 shadow">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Label</th>
                                        <th>Mechanic</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                        <th>GST</th>
                                        <th>GST Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($detail->labours as $l)
                                        <tr>
                                            <td>{{ $l->label ?? '-' }}</td>
                                            <td>{{ $l->mechanic_name ?? '-' }}</td>
                                            <td>{{ $l->qty ?? 1 }}</td>
                                            <td>₹{{ number_format($l->amount ?? 0, 2) }}</td>
                                            <td>{{ $l->gst ?? 0 }}%</td>
                                            <td>{{ ucfirst($l->gst_type ?? '-') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center">No labour charges added.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="$set('viewJobCardId', null)">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


