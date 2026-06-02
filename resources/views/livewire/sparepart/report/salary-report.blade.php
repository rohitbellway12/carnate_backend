<div>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Reports</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('sparepart.dashboard') }}"><i class="bx bx-home-alt text-primary"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Salary Report</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid mt-1 px-0">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex align-items-center justify-content-between py-3 flex-wrap gap-2">
                <h5 class="mb-0">Salary Report</h5>
                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                    <div class="input-group" style="max-width:210px;">
                        <span class="input-group-text"><i class="bx bx-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search staff..." wire:model.live="search">
                    </div>

                    <div class="d-flex gap-2">
                        <input type="date" class="form-control" style="width: 145px;" wire:model.lazy="fromDate">
                        <input type="date" class="form-control" style="width: 145px;" wire:model.lazy="toDate">
                    </div>

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

            <div class="px-3 pt-3 w-100">
                <div class="row g-2">
                    <div class="col-6 col-md-3 col-xl-3">
                        <div class="card text-white bg-info bg-gradient rounded-4 shadow h-100">
                            <div class="card-body py-1 d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0" style="font-size:.72rem;">Staff</p>
                                    <span class="fw-bold" style="font-size:.85rem;">{{ $totals['staff_count'] ?? 0 }}</span>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0 mt-2">
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
</div>
