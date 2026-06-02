<div class="container-fluid mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-chart-line text-primary me-2"></i> Workshops Report</h5>

            <div class="d-flex flex-wrap align-items-end justify-content-end gap-3">
                <!-- 🔍 Search -->
                <div>
                    <label class="form-label mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Search name, company..." wire:model.live="search" style="min-width:180px;">
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="form-label mb-1">Status</label>
                    <select class="form-select form-select-sm" wire:model.live="statusFilter" style="min-width:130px;">
                        <option value="">All Statuses</option>
                        <option value="subscribed">Subscribed</option>
                        <option value="trial">Trial</option>
                        <option value="inactive">Inactive</option>
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
                <!-- Total Workshops - Light Blue -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#dbeafe;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#1d4ed8;">Total Workshops</p>
                                <span class="fw-bold fs-4" style="color:#1e3a8a;">{{ $totals['total'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#bfdbfe;">
                                <i class="fas fa-tools" style="color:#1d4ed8;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Subscribed - Light Green -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#dcfce7;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#15803d;">Subscribed</p>
                                <span class="fw-bold fs-4" style="color:#14532d;">{{ $totals['subscribed'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#bbf7d0;">
                                <i class="fas fa-check-circle" style="color:#15803d;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Trial - Light Yellow -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#fef9c3;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#a16207;">Trial Mode</p>
                                <span class="fw-bold fs-4" style="color:#713f12;">{{ $totals['trial'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#fde68a;">
                                <i class="fas fa-hourglass-half" style="color:#a16207;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Inactive - Light Red -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#fee2e2;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#dc2626;">Inactive</p>
                                <span class="fw-bold fs-4" style="color:#7f1d1d;">{{ $totals['inactive'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#fecaca;">
                                <i class="fas fa-times-circle" style="color:#dc2626;"></i>
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
                            <th>Vendor Name</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Join Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($workshops as $w)
                            <tr>
                                <td>{{ $loop->iteration + ($workshops->currentPage()-1)*$workshops->perPage() }}</td>
                                <td class="fw-semibold">{{ $w->name }} {{ $w->lastname }}</td>
                                <td>{{ $w->company_name ?? 'N/A' }}</td>
                                <td>{{ $w->email }}</td>
                                <td>{{ $w->mobile_no }}</td>
                                <td>{{ $w->cityName ? $w->cityName->name : 'N/A' }}</td>
                                <td>
                                    @if($w->is_subscribe)
                                        <span class="badge" style="background:#dcfce7;color:#15803d;border:1px solid #86efac;">Subscribed</span>
                                    @elseif($w->is_trial)
                                        <span class="badge" style="background:#fef9c3;color:#a16207;border:1px solid #fde047;">Trial</span>
                                    @else
                                        <span class="badge" style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($w->created_at)->format('d M Y') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-link p-0 text-primary" wire:click="viewWorkshop({{ $w->id }})" title="View Details">
                                        <i class="bx bx-show fs-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">No workshops found matching filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $workshops->firstItem() ?? 0 }}–{{ $workshops->lastItem() ?? 0 }} of {{ $workshops->total() }}</small>
                {!! $workshops->links() !!}
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade @if($detail) show d-block @endif" tabindex="-1" style="@if($detail) display:block; background:rgba(0,0,0,.45); @endif">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold"><i class="fas fa-tools me-2 text-primary"></i> Workshop Vendor Details</h5>
                    <button type="button" class="btn-close" wire:click="$set('viewWorkshopId', null)"></button>
                </div>
                <div class="modal-body p-4">
                    @if($detail)
                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <div class="border rounded p-3 bg-light bg-opacity-50">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-user-circle text-primary me-2"></i> Profile Information</h6>
                                    <div class="mb-2"><strong>Name:</strong> {{ $detail->name }} {{ $detail->lastname }}</div>
                                    <div class="mb-2"><strong>Company Name:</strong> {{ $detail->company_name ?? 'N/A' }}</div>
                                    <div class="mb-2"><strong>Email:</strong> {{ $detail->email }}</div>
                                    <div class="mb-2"><strong>Mobile:</strong> {{ $detail->mobile_no }}</div>
                                    <div class="mb-0"><strong>Join Date:</strong> {{ \Carbon\Carbon::parse($detail->created_at)->format('d M Y, H:i A') }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="border rounded p-3 bg-light bg-opacity-50">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-credit-card text-success me-2"></i> Subscription Status</h6>
                                    <div class="mb-2">
                                        <strong>Subscription Status:</strong>
                                        @if($detail->is_subscribe)
                                            <span class="badge bg-success px-2 py-1">Subscribed</span>
                                        @elseif($detail->is_trial)
                                            <span class="badge bg-warning text-dark px-2 py-1">Trial Mode</span>
                                        @else
                                            <span class="badge bg-danger px-2 py-1">Inactive</span>
                                        @endif
                                    </div>
                                    <div class="mb-2"><strong>Subscription Start:</strong> {{ $detail->subscription_start_date ? \Carbon\Carbon::parse($detail->subscription_start_date)->format('d M Y') : 'N/A' }}</div>
                                    <div class="mb-2"><strong>Subscription End:</strong> {{ $detail->subscription_end_date ? \Carbon\Carbon::parse($detail->subscription_end_date)->format('d M Y') : 'N/A' }}</div>
                                    <div class="mb-2"><strong>Trial Start Date:</strong> {{ $detail->trial_start_date ? \Carbon\Carbon::parse($detail->trial_start_date)->format('d M Y') : 'N/A' }}</div>
                                    <div class="mb-0"><strong>Trial Days:</strong> {{ $detail->trial_days ?? 0 }} Days</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="border rounded p-3 bg-light bg-opacity-50">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i> Address & Settings</h6>
                                    <div class="mb-2"><strong>Address:</strong> {{ $detail->address ?? 'N/A' }}</div>
                                    <div class="mb-2"><strong>City / State / Pincode:</strong> {{ $detail->cityName ? $detail->cityName->name : 'N/A' }} / {{ $detail->pincode ?? 'N/A' }}</div>
                                    <div class="mb-2"><strong>GST Details:</strong> {{ $detail->is_gst ? 'Yes (GST Number: '.$detail->gst.')' : 'No' }}</div>
                                    <div class="mb-0"><strong>Branch Details:</strong> {{ $detail->branch_name ? $detail->branch_name . ' (' . $detail->branch_email . ')' : 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary" wire:click="$set('viewWorkshopId', null)">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
