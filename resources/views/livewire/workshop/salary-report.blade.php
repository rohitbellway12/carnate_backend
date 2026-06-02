<div class="container-fluid mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <h5 class="mb-0">Salary Report</h5>
            <div class="d-flex align-items-center justify-content-between gap-2">
                <div class="input-group" style="max-width:210px; d-flex gap-2">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search staff..." wire:model.live="search">
                </div>

                <div class="d-flex gap-2">
                    <input type="date" class="form-control" style="width: 145px;" wire:model.lazy="fromDate">
                    <input type="date" class="form-control" style="width: 145px;" wire:model.lazy="toDate">
                </div>
                {{-- <div class="d-flex">
                    <small class="text-muted">Showing {{ $rows->firstItem() }}–{{ $rows->lastItem() }} of {{ $rows->total() }}</small>
                </div> --}}
                <div class="d-flex gap-2">
                    <select class="form-select" wire:model.live="filterType" style="width: 150px;">
                        <option value="">All</option>
                        <option value="daily">Today</option>
                        <option value="weekly">This Week</option>
                        <option value="monthly">This Month</option>
                    </select>

                    <button class="btn btn-secondary" wire:click="downloadPDF">
                        <i class="bx bxs-file-pdf"></i> Export PDF
                    </button>
                </div>
            </div>

        </div>

        <div class="px-3 pt-3  w-100">
            <div class="row g-2">
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-info bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Staff</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totals['staff_count'] ?? 0 }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0dcaf0" aria-hidden="true"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V20h14v-3.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V20h6v-3.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-info bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Completed Target</p>
                                <span class="fw-bold" style="font-size:.85rem;">₹{{ number_format($totals['completed_target'] ?? 0, 2) }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0dcaf0" aria-hidden="true"><path d="M9 16.2l-3.5-3.5L4 14.2l5 5 12-12-1.5-1.5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-info bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Incentive</p>
                                <span class="fw-bold" style="font-size:.85rem;">₹{{ number_format($totals['incentive'] ?? 0, 2) }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0dcaf0" aria-hidden="true"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm1 17.93c-2.83-.48-5-2.94-5-5.93h2c0 2.21 1.79 4 4 4v1.93zM7 10c0-2.99 2.17-5.45 5-5.93V6c-2.21 0-4 1.79-4 4H7z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-3">
                    <div class="card text-white bg-success bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Total Salary</p>
                                <span class="fw-bold" style="font-size:.85rem;">₹{{ number_format($totals['total_salary'] ?? 0, 2) }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#20c997" aria-hidden="true"><path d="M12 1C5.93 1 1 5.93 1 12s4.93 11 11 11 11-4.93 11-11S18.07 1 12 1zm1 17h-2v-2H8v-2h3v-2H8V8h3V6h2v2h3v2h-3v2h3v2h-3v2z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0 mt-2">
            {{-- <div class="d-flex align-items-center justify-content-between px-3 pb-2">
                <div class="input-group" style="max-width:320px;">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search staff..." wire:model.live="search">
                </div>
                <div>

                    <small class="text-muted">Showing {{ $rows->firstItem() }}–{{ $rows->lastItem() }} of {{ $rows->total() }}</small>
                </div>
            </div> --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th class="text-end">Base Salary</th>
                            <th class="text-end">Monthly Target</th>
                            <th class="text-end">Completed Target</th>
                            <th class="text-end">Over Target</th>
                            <th class="text-end">Incentive</th>
                            <th class="text-end">Total Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rows as $row)
                            <tr>
                                <td>{{ $row['name'] }}</td>
                                <td class="text-end">{{ number_format($row['base_salary'], 2) }}</td>
                                <td class="text-end">{{ number_format($row['monthly_target'], 2) }}</td>
                                <td class="text-end">{{ number_format($row['completed_target'], 2) }}</td>
                                <td class="text-end">{{ number_format($row['over_target'], 2) }}</td>
                                <td class="text-end">{{ number_format($row['incentive'], 2) }}</td>
                                <td class="text-end fw-semibold">{{ number_format($row['total_salary'], 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">No data found for selected period.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if($rows->count() > 0)
                    <tfoot>
                        <tr class="table-light">
                            <th class="text-end">Totals</th>
                            <th class="text-end">{{ number_format($totals['base_salary'] ?? 0, 2) }}</th>
                            <th class="text-end">{{ number_format($totals['monthly_target'] ?? 0, 2) }}</th>
                            <th class="text-end">{{ number_format($totals['completed_target'] ?? 0, 2) }}</th>
                            <th class="text-end">{{ number_format($totals['over_target'] ?? 0, 2) }}</th>
                            <th class="text-end">{{ number_format($totals['incentive'] ?? 0, 2) }}</th>
                            <th class="text-end">{{ number_format($totals['total_salary'] ?? 0, 2) }}</th>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
            <div class="px-3 py-2 d-flex justify-content-end">{!! $rows->links() !!}</div>

        </div>
    </div>
</div>


