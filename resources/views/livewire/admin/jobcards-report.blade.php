<div class="container-fluid mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-tasks text-primary me-2"></i> Job Cards Report</h5>

            <div class="d-flex flex-wrap align-items-end justify-content-end gap-3">
                <!-- 🔍 Search -->
                <div>
                    <label class="form-label mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Search number, customer..." wire:model.live="search" style="min-width:180px;">
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="form-label mb-1">Status</label>
                    <select class="form-select form-select-sm" wire:model.live="statusFilter" style="min-width:130px;">
                        <option value="">All Statuses</option>
                        <option value="0">Open</option>
                        <option value="1">Confirmed</option>
                        <option value="2">Completed</option>
                        <option value="3">Closed</option>
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
                <!-- Total Job Cards - Light Blue -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#dbeafe;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#1d4ed8;">Total Job Cards</p>
                                <span class="fw-bold fs-4" style="color:#1e3a8a;">{{ $totals['total'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#bfdbfe;">
                                <i class="fas fa-file-invoice" style="color:#1d4ed8;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Open & Confirmed - Light Red -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#fee2e2;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#dc2626;">Open & Confirmed</p>
                                <span class="fw-bold fs-5" style="color:#7f1d1d;">Open: {{ $totals['open'] ?? 0 }}</span>
                                <span class="d-block small" style="color:#b91c1c;">Confirmed: {{ $totals['confirmed'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#fecaca;">
                                <i class="fas fa-clock" style="color:#dc2626;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Completed & Closed - Light Green -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#dcfce7;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#15803d;">Completed & Closed</p>
                                <span class="fw-bold fs-5" style="color:#14532d;">Done: {{ $totals['completed'] ?? 0 }}</span>
                                <span class="d-block small" style="color:#166534;">Closed: {{ $totals['closed'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#bbf7d0;">
                                <i class="fas fa-check-double" style="color:#15803d;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Value - Light Purple -->
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm h-100 border-0" style="background:#ede9fe;">
                        <div class="card-body py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 small fw-semibold" style="color:#7c3aed;">Total Value / Balance</p>
                                <span class="fw-bold fs-5" style="color:#4c1d95;">₹{{ number_format($totals['total_amount'] ?? 0, 2) }}</span>
                                <span class="d-block small" style="color:#6d28d9;">Bal: ₹{{ number_format($totals['total_balance'] ?? 0, 2) }}</span>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#ddd6fe;">
                                <i class="fas fa-wallet" style="color:#7c3aed;"></i>
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
                            <th>Job Card #</th>
                            <th>Customer Name</th>
                            <th>Vehicle No</th>
                            <th>Vehicle</th>
                            <th>Workshop</th>
                            <th>Date</th>
                            <th class="text-end">Final Bill</th>
                            <th class="text-end">Paid (Adv)</th>
                            <th class="text-end">Balance</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobcards as $j)
                            <tr>
                                <td>{{ $loop->iteration + ($jobcards->currentPage()-1)*$jobcards->perPage() }}</td>
                                <td class="fw-bold">{{ $j->jobcard_number }}</td>
                                <td>{{ $j->customer_name ?? 'N/A' }}</td>
                                <td><span class="badge bg-secondary text-white">{{ $j->vehical_number ?? 'N/A' }}</span></td>
                                <td>{{ $j->vehical ?? 'N/A' }}</td>
                                <td>{{ $j->workshop->company_name ?? ($j->workshop ? $j->workshop->name.' '.$j->workshop->lastname : 'N/A') }}</td>
                                <td>{{ $j->entry_date ? \Carbon\Carbon::parse($j->entry_date)->format('d M Y') : 'N/A' }}</td>
                                <td class="text-end fw-semibold">₹{{ number_format((float)($j->final_amount ?? $j->amount ?? 0), 2) }}</td>
                                <td class="text-end text-success">₹{{ number_format((float)($j->advance ?? 0), 2) }}</td>
                                <td class="text-end text-danger fw-semibold">₹{{ number_format((float)($j->balance_amount ?? 0), 2) }}</td>
                                <td>
                                    @switch($j->status)
                                        @case(1)
                                            <span class="badge bg-primary text-white px-2 py-1">Confirmed</span>
                                            @break
                                        @case(2)
                                            <span class="badge bg-success text-white px-2 py-1">Completed</span>
                                            @break
                                        @case(3)
                                            <span class="badge bg-info text-dark px-2 py-1">Closed</span>
                                            @break
                                        @default
                                            <span class="badge bg-danger text-white px-2 py-1">Open</span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-link p-0 text-primary" wire:click="viewJobCard({{ $j->id }})" title="View Details">
                                        <i class="bx bx-show fs-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center py-4 text-muted">No Job Cards found matching filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $jobcards->firstItem() ?? 0 }}–{{ $jobcards->lastItem() ?? 0 }} of {{ $jobcards->total() }}</small>
                {!! $jobcards->links() !!}
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade @if($detail) show d-block @endif" tabindex="-1" style="@if($detail) display:block; background:rgba(0,0,0,.45); @endif">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold"><i class="fas fa-file-invoice me-2 text-primary"></i> Job Card Details: {{ $detail->jobcard_number ?? '' }}</h5>
                    <button type="button" class="btn-close" wire:click="$set('viewJobCardId', null)"></button>
                </div>
                <div class="modal-body p-4">
                    @if($detail)
                        <div class="row g-4">
                            <!-- Column 1: General Info -->
                            <div class="col-12 col-md-4">
                                <div class="border rounded p-3 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-info-circle text-primary me-2"></i> General Info</h6>
                                    <div class="mb-2"><strong>Job Card #:</strong> {{ $detail->jobcard_number }}</div>
                                    <div class="mb-2"><strong>Date Created:</strong> {{ $detail->entry_date ? \Carbon\Carbon::parse($detail->entry_date)->format('d M Y, h:i A') : 'N/A' }}</div>
                                    <div class="mb-2"><strong>Workshop Name:</strong> {{ $detail->workshop->company_name ?? ($detail->workshop ? $detail->workshop->name.' '.$detail->workshop->lastname : 'N/A') }}</div>
                                    <div class="mb-2">
                                        <strong>Status:</strong>
                                        @switch($detail->status)
                                            @case(1)
                                                <span class="badge bg-primary">Confirmed</span>
                                                @break
                                            @case(2)
                                                <span class="badge bg-success">Completed</span>
                                                @break
                                            @case(3)
                                                <span class="badge bg-info text-dark">Closed</span>
                                                @break
                                            @default
                                                <span class="badge bg-danger">Open</span>
                                        @endswitch
                                    </div>
                                    <div class="mb-0 text-muted small"><strong>Notes:</strong> {{ $detail->notes ?? 'No special notes.' }}</div>
                                </div>
                            </div>

                            <!-- Column 2: Customer & Vehicle Info -->
                            <div class="col-12 col-md-4">
                                <div class="border rounded p-3 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-car text-success me-2"></i> Customer & Vehicle</h6>
                                    <div class="mb-2"><strong>Customer Name:</strong> {{ $detail->customer_name ?? ($detail->customer ? $detail->customer->name.' '.$detail->customer->lastname : 'N/A') }}</div>
                                    <div class="mb-2"><strong>Mobile:</strong> {{ $detail->customer->mobile_no ?? 'N/A' }}</div>
                                    <div class="mb-2"><strong>Vehicle Model:</strong> {{ $detail->vehical ?? 'N/A' }}</div>
                                    <div class="mb-2"><strong>Plate Number:</strong> <span class="badge bg-dark">{{ $detail->vehical_number ?? 'N/A' }}</span></div>
                                    <div class="mb-2"><strong>KM Running:</strong> {{ number_format((float)($detail->km_runing ?? 0)) }} km</div>
                                    <div class="mb-0"><strong>Fuel Level:</strong> {{ $detail->fual_level ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- Column 3: Billing Info -->
                            <div class="col-12 col-md-4">
                                <div class="border rounded p-3 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-calculator text-warning me-2"></i> Billing Summary</h6>
                                    <div class="mb-2 d-flex justify-content-between"><span>Base Amount:</span> <span class="fw-semibold">₹{{ number_format((float)($detail->amount ?? 0), 2) }}</span></div>
                                    <div class="mb-2 d-flex justify-content-between"><span>Discount:</span> <span class="text-danger">-₹{{ number_format((float)($detail->discount ?? 0), 2) }}</span></div>
                                    <div class="mb-2 d-flex justify-content-between border-top pt-2"><strong>Final Total:</strong> <strong class="text-primary">₹{{ number_format((float)($detail->final_amount ?? $detail->amount ?? 0), 2) }}</strong></div>
                                    <div class="mb-2 d-flex justify-content-between"><span>Advance Paid:</span> <span class="text-success">₹{{ number_format((float)($detail->advance ?? 0), 2) }}</span></div>
                                    <div class="mb-2 d-flex justify-content-between border-top pt-2"><strong>Outstanding:</strong> <strong class="text-danger">₹{{ number_format((float)($detail->balance_amount ?? 0), 2) }}</strong></div>
                                    <div class="mb-0"><strong>Payment Type:</strong> {{ $detail->payment_type ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- Row 2: Spare Parts Used & Labours -->
                            <div class="col-12 col-md-6">
                                <div class="border rounded p-3 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-cogs text-secondary me-2"></i> Spare Parts Used</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Part Name</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-end">Price</th>
                                                    <th class="text-end">Tax %</th>
                                                    <th class="text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($detail->jobCardSpareParts as $part)
                                                    @php
                                                        $partQty = (float)($part->qty ?? 1);
                                                        $partPrice = (float)($part->price ?? 0);
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <div class="fw-semibold">{{ $part->productStock->sparePart->name ?? 'Spare Part' }}</div>
                                                            <small class="text-muted">{{ $part->productStock->sparePart->sku ?? 'N/A' }}</small>
                                                        </td>
                                                        <td class="text-center">{{ $partQty }}</td>
                                                        <td class="text-end">₹{{ number_format($partPrice, 2) }}</td>
                                                        <td class="text-end">{{ $part->tax_percentage ?? 0 }}%</td>
                                                        <td class="text-end fw-semibold">₹{{ number_format($partQty * $partPrice, 2) }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center py-3 text-muted">No spare parts recorded.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="border rounded p-3 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-wrench text-dark me-2"></i> Labours & Extra Charges</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Label / Charge Type</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-end">Rate</th>
                                                    <th class="text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($detail->labours as $labour)
                                                    @php
                                                        $labourQty = (float)($labour->qty ?? 1);
                                                        $labourRate = (float)($labour->amount ?? $labour->charges ?? 0);
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <div class="fw-semibold">{{ $labour->label }}</div>
                                                            <small class="text-muted">{{ ucfirst($labour->charge_type ?? 'labour') }}</small>
                                                        </td>
                                                        <td class="text-center">{{ $labourQty }}</td>
                                                        <td class="text-end">₹{{ number_format($labourRate, 2) }}</td>
                                                        <td class="text-end fw-semibold">₹{{ number_format($labourQty * $labourRate, 2) }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center py-3 text-muted">No labour or extra charges recorded.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary" wire:click="$set('viewJobCardId', null)">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
