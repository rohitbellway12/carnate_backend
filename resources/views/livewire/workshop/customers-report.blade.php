<div class="container-fluid mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="mb-0">Customers Report</h5>

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

                <!-- 🧾 Export PDF -->
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
                                <p class="mb-0" style="font-size:.72rem;">Total Customers</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['total_customers'] ?? 0 }}</span>
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
                                <p class="mb-0" style="font-size:.72rem;">With Vehicle</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['with_vehicle'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#20c997" aria-hidden="true"><path d="M3 13l2-2 4 4L21 5l2 2-14 14z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-warning bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Without Vehicle</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['without_vehicle'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#ffc107" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5zm0 7l-10 5 10 5 10-5-10-5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-info bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Total Vehicles</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['total_vehicles'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0dcaf0" aria-hidden="true"><path d="M4 4h16v4H4zM4 10h16v4H4zM4 16h16v4H4z"/></svg>
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
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $c)
                            <tr>
                                <td>{{ $loop->iteration + ($customers->currentPage()-1)*$customers->perPage() }}</td>
                                <td>{{ $c->name }} {{ $c->lastname }}</td>
                                <td>{{ $c->email }}</td>
                                <td>{{ $c->mobile_no }}</td>
                                <td class="text-center">
                                    <a  wire:click="viewCustomer({{ $c->id }})" title="View">
                                        <i class="bx bx-show primary text-primary" style="font-size: 20px;"> </i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No customers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-3 py-2 d-flex justify-content-between">
                <small class="text-muted">Showing {{ $customers->firstItem() }}–{{ $customers->lastItem() }} of {{ $customers->total() }}</small>
                {!! $customers->links() !!}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade @if($detail) show d-block @endif" tabindex="-1" style="@if($detail) display:block; background:rgba(0,0,0,.35); @endif" @if(!$detail) aria-hidden="true" @endif>
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title">Customer Details</h5>
                    <button type="button" class="btn-close" wire:click="$set('viewCustomerId', null)"></button>
                </div>
                <div class="modal-body">
                    @if($detail)
                    <div class="border rounded p-2 mb-2 shadow"    >

                        <div class="row g-2" >
                            <div class="col-md-6 ">
                                <div class="fw-semibold">Name</div>
                                <div>{{ $detail->name }} {{ $detail->lastname }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="fw-semibold">Email</div>
                                <div>{{ $detail->email }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="fw-semibold">Mobile</div>
                                <div>{{ $detail->mobile_no }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="fw-semibold">Address</div>
                                <div>{{ $detail->address }}</div>
                            </div>
                        </div>
                    </div>
                        <hr>
                        <div class="fw-semibold mb-1">Vehicles</div>
                        @forelse($detail->vehicles as $v)
                            <div class="border rounded p-2 mb-2 shadow">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <div class="text-muted small">Brand</div>
                                        <div>{{ $v->brand ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Variant</div>
                                        <div>{{ $v->variant ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Modification</div>
                                        <div>{{ $v->modification ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Year</div>
                                        <div>{{ $v->year ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Number Plate</div>
                                        <div>{{ $v->number_plate ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Chassis No</div>
                                        <div>{{ $v->chassis_no ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Engine No</div>
                                        <div>{{ $v->engineno ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Manufacturing Date</div>
                                        <div>{{ $v->date_of_manufacturing ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Driver Name</div>
                                        <div>{{ $v->driver_name ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Driver Number</div>
                                        <div>{{ $v->driver_number ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Policy No</div>
                                        <div>{{ $v->policy_number ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Insurance</div>
                                        <div>{{ $v->insurance_name ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted small">Pickup Address</div>
                                        <div>{{ $v->pickup_address ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted small">Drop Address</div>
                                        <div>{{ $v->drop_address ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">Policy Expiry</div>
                                        <div>{{ $v->policy_expiry_date ?? '-' }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted small">GSTIN</div>
                                        <div>{{ $v->gstin_number ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted">No vehicles linked.</div>
                        @endforelse
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="$set('viewCustomerId', null)">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('show-customer-modal', ()=>{})
    </script>
</div>


