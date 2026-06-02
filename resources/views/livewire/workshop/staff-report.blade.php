<div class="container-fluid mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <h5 class="mb-0">Staff Report</h5>
            {{-- <div class="input-group" style="max-width:210px;">
                <span class="input-group-text"><i class="bx bx-search"></i></span>
                <input type="text" class="form-control" placeholder="Search staff..." wire:model.live="search">
            </div> --}}

            <div class="d-flex flex-wrap align-items-end justify-content-end gap-3">
                <!-- Search -->
                <div>
                    <label class="form-label mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Search staff..." wire:model.live="search">
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

                <!-- Status -->
                {{-- <div>
                    <label class="form-label mb-1">Status</label>
                    <select class="form-select form-select-sm" wire:model.live="status">
                        <option value="">All</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div> --}}

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
                                <p class="mb-0" style="font-size:.72rem;">Total Staff</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['total_staff'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0dcaf0" aria-hidden="true"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V20h14v-3.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V20h6v-3.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-success bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Total Labour Amount</p>
                                <span class="fw-bold" style="font-size:.85rem;">₹{{ number_format($totals['total_labour_amount'] ?? 0, 2) }}</span>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th>Salary</th>

                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staff as $s)
                            <tr>
                                <td>{{ $loop->iteration + ($staff->currentPage()-1)*$staff->perPage() }}</td>
                                <td>{{ $s->name }} {{ $s->lastname }}</td>
                                <td>{{ $s->email }}</td>
                                <td>{{ $s->mobile_no }}</td>
                                <td>{{ $s->Role->name ?? '-' }}</td>
                                <td>{{ $s->salary ?? '-' }}</td>

                                <td class="text-center">
                                    <a wire:click="viewStaff({{ $s->id }})" title="View"><i class="bx bx-show text-primary" style="font-size: 20px;"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No staff found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-3 py-2 d-flex justify-content-between">
                <small class="text-muted">Showing {{ $staff->firstItem() }}–{{ $staff->lastItem() }} of {{ $staff->total() }}</small>
                {!! $staff->links() !!}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade @if($detail) show d-block @endif" tabindex="-1" style="@if($detail) display:block; background:rgba(0,0,0,.35); @endif" @if(!$detail) aria-hidden="true" @endif>
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Staff Details</h5>
                    <button type="button" class="btn-close" wire:click="$set('viewStaffId', null)"></button>
                </div>
                <div class="modal-body">
                    @if($detail)
                        <div class="border rounded p-2 mb-2 shadow">
                            <div class="row g-2">
                                <div class="col-md-3"><div class="text-muted small">Name</div><div>{{ $detail->name }} {{ $detail->lastname }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Email</div><div>{{ $detail->email }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Mobile</div><div>{{ $detail->mobile_no }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Salary</div><div>₹{{ number_format($detail->salary ?? 0, 2) }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Monthly Target</div><div>₹{{ number_format($detail->monthly_target ?? 0, 2) }}</div></div>
                                <div class="col-md-3"><div class="text-muted small">Incentive %</div><div>{{ $detail->incentives ?? 0 }}%</div></div>
                            </div>
                        </div>
                        <h6 class="mt-3 p-2">Labour Entries</h6>
                        <div class="table-responsive p-2 mt-2 shadow">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Jobcard</th>
                                        <th>Customer</th>
                                        <th>Plate</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                        <th>GST</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($detail->labours as $l)
                                        <tr>
                                            <td>{{ $l->jobcard_number }}</td>
                                            <td>{{ $l->customer_name }}</td>
                                            <td>{{ $l->vehical_number }}</td>
                                            <td>{{ $l->qty ?? 1 }}</td>
                                            <td>₹{{ number_format($l->amount ?? 0, 2) }}</td>
                                            <td>{{ $l->gst ?? 0 }}%</td>
                                            <td>{{ optional($l->created_at)->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center">No labour entries.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="$set('viewStaffId', null)">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


