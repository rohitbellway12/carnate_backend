<div class="container-fluid mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-chart-line text-primary me-2"></i> Customers Report</h5>

            <div class="d-flex flex-wrap align-items-end justify-content-end gap-3">
                <!-- 🔍 Search -->
                <div>
                    <label class="form-label mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Search name, contact..." wire:model.live="search" style="min-width:180px;">
                </div>

                <!-- Vehicle Filter -->
                <div>
                    <label class="form-label mb-1">Vehicles</label>
                    <select class="form-select form-select-sm" wire:model.live="vehicleFilter" style="min-width:130px;">
                        <option value="">All Customers</option>
                        <option value="with">With Vehicles</option>
                        <option value="without">Without Vehicles</option>
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
                <!-- Total Customers - Light Cyan -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#cffafe;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#0e7490;">Total Customers</p>
                                <span class="fw-bold fs-4" style="color:#164e63;">{{ $totals['total_customers'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#a5f3fc;">
                                <i class="fas fa-users" style="color:#0e7490;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- With Vehicle - Light Green -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#dcfce7;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#15803d;">With Vehicle</p>
                                <span class="fw-bold fs-4" style="color:#14532d;">{{ $totals['with_vehicle'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#bbf7d0;">
                                <i class="fas fa-car" style="color:#15803d;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Without Vehicle - Light Yellow -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#fef9c3;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#a16207;">Without Vehicle</p>
                                <span class="fw-bold fs-4" style="color:#713f12;">{{ $totals['without_vehicle'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#fde68a;">
                                <i class="fas fa-user-slash" style="color:#a16207;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Vehicles - Light Blue -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#dbeafe;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#1d4ed8;">Total Vehicles</p>
                                <span class="fw-bold fs-4" style="color:#1e3a8a;">{{ $totals['total_vehicles'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#bfdbfe;">
                                <i class="fas fa-bus" style="color:#1d4ed8;"></i>
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
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Registered By (Workshop)</th>
                            <th>Vehicles Count</th>
                            <th>Join Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $c)
                            <tr>
                                <td>{{ $loop->iteration + ($customers->currentPage()-1)*$customers->perPage() }}</td>
                                <td class="fw-semibold">{{ $c->name }} {{ $c->lastname }}</td>
                                <td>{{ $c->email ?? '-' }}</td>
                                <td>{{ $c->mobile_no ?? '-' }}</td>
                                <td>
                                    @if($c->user)
                                        <span class="text-secondary fw-semibold">{{ $c->user->company_name ?? ($c->user->name . ' ' . $c->user->lastname) }}</span>
                                    @else
                                        <span class="text-muted small">Admin Registered</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary text-white px-2 py-1">{{ $c->vehicles->count() }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($c->created_at)->format('d M Y') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-link p-0 text-primary" wire:click="viewCustomer({{ $c->id }})" title="View Details">
                                        <i class="bx bx-show fs-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No customers found matching filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $customers->firstItem() ?? 0 }}–{{ $customers->lastItem() ?? 0 }} of {{ $customers->total() }}</small>
                {!! $customers->links() !!}
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade @if($detail) show d-block @endif" tabindex="-1" style="@if($detail) display:block; background:rgba(0,0,0,.45); @endif">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold"><i class="fas fa-user-circle me-2 text-primary"></i> Customer & Vehicle Details</h5>
                    <button type="button" class="btn-close" wire:click="$set('viewCustomerId', null)"></button>
                </div>
                <div class="modal-body p-4">
                    @if($detail)
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="border rounded p-3 bg-light bg-opacity-50">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-id-card text-primary me-2"></i> Customer Info</h6>
                                    <div class="row g-2">
                                        <div class="col-md-6"><strong>Name:</strong> {{ $detail->name }} {{ $detail->lastname }}</div>
                                        <div class="col-md-6"><strong>Email:</strong> {{ $detail->email ?? '-' }}</div>
                                        <div class="col-md-6"><strong>Mobile:</strong> {{ $detail->mobile_no ?? '-' }}</div>
                                        <div class="col-md-6"><strong>GSTIN:</strong> {{ $detail->gst_number ?? 'N/A' }}</div>
                                        <div class="col-12"><strong>Address:</strong> {{ $detail->address ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="border rounded p-3 bg-light bg-opacity-50">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-car text-success me-2"></i> Linked Vehicles ({{ $detail->vehicles->count() }})</h6>
                                    @forelse($detail->vehicles as $v)
                                        <div class="border rounded p-2 mb-2 bg-white shadow-sm">
                                            <div class="row g-2">
                                                <div class="col-6 col-md-3"><strong>Brand:</strong> {{ $v->brand ?? '-' }}</div>
                                                <div class="col-6 col-md-3"><strong>Variant:</strong> {{ $v->variant ?? '-' }}</div>
                                                <div class="col-6 col-md-3"><strong>Plate No:</strong> {{ $v->number_plate ?? '-' }}</div>
                                                <div class="col-6 col-md-3"><strong>Chassis No:</strong> {{ $v->chassis_no ?? '-' }}</div>
                                                <div class="col-6 col-md-3"><strong>Engine No:</strong> {{ $v->engineno ?? '-' }}</div>
                                                <div class="col-6 col-md-3"><strong>Year:</strong> {{ $v->year ?? '-' }}</div>
                                                <div class="col-6 col-md-6"><strong>Insurance Info:</strong> {{ $v->insurance_name ?? '-' }} (Policy: {{ $v->policy_number ?? '-' }})</div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center text-muted my-3">No vehicles linked to this customer.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary" wire:click="$set('viewCustomerId', null)">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
