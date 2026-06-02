<div wire:poll.10s="refreshMetrics">

    <style>
        /* Toggle icons for collapse button */
        #jobsTableToggle .icon-expand { display: none; }
        #jobsTableToggle.collapsed .icon-expand { display: inline-block; }
        #jobsTableToggle.collapsed .icon-collapse { display: none; }
        /* Smaller nav tab button */
        #jobs-tab { padding: .15rem .5rem; font-size: .8rem; }


        #jobsTableToggle {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            background: transparent !important;
            padding: 2px 6px;
        }
        #jobsTableToggle:focus {
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4 mt-4 gap-2" id="dashboardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button wire:click="setTab('jobs')" class="nav-link {{ $activeTab === 'jobs' ? 'active' : '' }}" id="jobs-tab" data-bs-toggle="tab" data-bs-target="#jobs" type="button" role="tab">
                <i class="bx bx-briefcase me-1"></i> Job Cards
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button wire:click="setTab('stocks')" class="nav-link {{ $activeTab === 'stocks' ? 'active' : '' }}" id="stock-tab" data-bs-toggle="tab" data-bs-target="#stocks" type="button" role="tab" style="padding:.15rem .5rem; font-size:.8rem;">
                <i class="bx bx-package me-1"></i> Inventory
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button wire:click="setTab('staff')" class="nav-link {{ $activeTab === 'staff' ? 'active' : '' }}" id="staff-tab" data-bs-toggle="tab" data-bs-target="#staff" type="button" role="tab" style="padding:.15rem .5rem; font-size:.8rem;">
                <i class="bx bx-user me-1"></i> Staff Performance
            </button>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="xyz-tab" data-bs-toggle="tab" data-bs-target="#xyz" type="button" role="tab">
                <i class="bx bx-user me-1"></i> xyz
            </button>
        </li> -->
    </ul>

    <div class="tab-content" id="dashboardTabsContent">
        <!-- JOB CARDS TAB -->
        <div class="tab-pane fade {{ $activeTab === 'jobs' ? 'show active' : '' }}" id="jobs" role="tabpanel">

            <!-- Metrics cards (extra compact) -->
            <div class="row g-2">
                <div class="col-6 col-md-3 col-xl-2">
                    <div class="card text-white bg-success bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Active Jobs</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $activeJobs }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0d6efd" aria-hidden="true">
                                    <path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3 col-xl-2">
                    <div class="card text-white bg-info bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Total Jobs</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $totalJobs }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0d6efd" aria-hidden="true">
                                <path d="M12 2L2 7l10 5 10-5-10-5zm0 7l-10 5 10 5 10-5-10-5zm0 7l-10 5 10 5 10-5-10-5z"/>
                            </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Cards (uniform gaps, extra compact) -->
            @php
                $statusIcons = [
                    'Open' => 'ri-folder-open-line text-primary',
                    'Confirmed' => 'ri-check-double-line text-success',
                    'Completed' => 'ri-checkbox-circle-line text-info',
                    'Closed' => 'ri-close-circle-line text-danger',
                ];
            @endphp
            <div class="row g-2 mt-2">
                @foreach ($statusCounts as $s)
                <div class="col-6 col-md-3 col-xl-2">
                    <div class="card rounded-4 shadow-sm h-100 bg-light border-0">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted fw-semibold" style="font-size:.72rem;">{{ $s['label'] }}</span>
                                <div class="fw-bold" style="font-size:.85rem;">{{ $s['count'] }}</div>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 text-primary d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                            <i class="{{ $statusIcons[$s['label']] ?? 'ri-bar-chart-line' }}" style="font-size:.9rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Jobs Table (collapsible + compact) -->
            <div class="card rounded-4 shadow-sm border-0 mt-2">
                <div class="card-header bg-white border-0 py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0" style="font-size:.9rem;">Latest Jobs</h6>
                        <button id="jobsTableToggle" class="rounded-pill border-0 {{ $jobsTableOpen ? '' : 'collapsed' }}" type="button" wire:click="toggleJobsTable" title="Hide/Show">
                            <i class="bx bx-chevron-down icon-expand {{ $jobsTableOpen ? 'd-none' : '' }}"></i>
                            <i class="bx bx-chevron-up icon-collapse {{ $jobsTableOpen ? '' : 'd-none' }}"></i>
                        </button>
                    </div>
                </div>
                <div id="jobsTableCollapse" class="collapse {{ $jobsTableOpen ? 'show' : '' }}">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-hover align-middle text-nowrap mb-0 small">
                                <thead class="table-light">
                                    <tr>
                                        <th class="small">#</th>
                                        <th class="small">Jobcard No</th>
                                        <th class="small">Customer</th>
                                        <th class="small">Vehicle</th>
                                        <th class="small">Status</th>
                                        <th class="small">Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jobs as $index => $job)
                                        <tr>
                                            <td>{{ $jobs->firstItem() + $index }}</td>
                                            <td class="fw-semibold">{{ $job->jobcard_number ?? '-' }}</td>
                                            <td>{{ $job->customer_name ?? ($job->customer->company_name ?? '-') }}</td>
                                            <td>{{ $job->vehical_number ?? ($job->vehicle->model ?? '-') }}</td>
                                            <td>
                                                <!-- @php($st = [0=>'Created',1=>'In Progress',2=>'Pending',3=>'Hold',4=>'Completed',5=>'Cancelled']) -->

                                                @php($st = [0=>'Open',1=>'Confirmed',2=>'Completed',3=>'Closed'])
                                                <span class="badge
                                                    @if($job->status==0) bg-secondary
                                                    @elseif($job->status==1) bg-primary
                                                    @elseif($job->status==2) bg-warning
                                                    @elseif($job->status==3) bg-dark
                                                    @else bg-info @endif
                                                ">
                                                    {{ $st[$job->status] ?? $job->status }}
                                                </span>
                                            </td>
                                            <td>{{ optional($job->created_at)->format('d M Y, h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No jobs found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-1">
                            {{ $jobs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- INVENTORY TAB -->

        <div class="tab-pane fade {{ $activeTab === 'stocks' ? 'show active' : '' }}" id="stocks" role="tabpanel">
            <!-- Top metric cards: Accessory, Parts, Lubricant, Tools, Total Items, Total Qty -->
            <h6 class="p-1">Stocks</h6>
            <div class="row g-2">
                @php($catOrder = [1=>'Accessory',2=>'Parts',4=>'Lubricant',3=>'Tools'])
                @foreach($catOrder as $id => $label)
                    @php($c = $stockByCategory[$id] ?? ['label'=>$label,'count'=>0,'qty'=>0])
                    <div class="col-6 col-md-3 col-xl-2">
                        <div class="card text-white bg-info bg-gradient rounded-4 shadow h-100">
                            <div class="card-body py-1 d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0" style="font-size:.72rem;">{{ $c['label'] }}</p>
                                    <span class="fw-bold" style="font-size:.85rem;">{{ $c['qty'] }}</span>
                                </div>
                                <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0dcaf0" aria-hidden="true"><path d="M4 4h16v4H4zM4 10h16v4H4zM4 16h16v4H4z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-6 col-md-3 col-xl-2">
                    <div class="card text-white bg-primary bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Total Items</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $stockTotal }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#0d6efd" aria-hidden="true"><path d="M3 3h18v4H3V3zm0 6h18v12H3V9zm2 2v8h14v-8H5z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-2">
                    <div class="card text-white bg-success bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Total Stock Qty</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $stockTotalQty }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#198754">
  <path d="M20.54 5.23L19.15 3.5A2 2 0 0 0 17.62 3H6.38a2 2 0 0 0-1.53.73L3.46 5.23A2 2 0 0 0 3 6.5V19a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.5a2 2 0 0 0-.46-1.27M12 17a2 2 0 1 1 0-4 2 2 0 0 1 0 4M5.12 5l.81-1h12l.94 1z"/>
</svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Suppliers cards -->
             <h6 class="mt-4 p-1">suppliers</h6>
            <div class="row g-2 mt-2">
                <div class="col-6 col-md-3 col-xl-2">
                    <div class="card text-white bg-warning bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Suppliers</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $supplierCount }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#ffc107" aria-hidden="true">
  <path d="M2 21h20V10l-6 4V6l-6 4V2L2 6z"/>
</svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Labour cards -->
             <h6 class="mt-4 p-1">Labour Charges</h6>
           <div class="row g-2 mt-2">
                <div class="col-6 col-md-3 col-xl-2">
                    <div class="card text-white bg-danger bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Labour Items</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ $labourCount }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#dc3545" aria-hidden="true">
                            <path d="M2 21l9-9-2-2 3-3 2 2 3-3-2-2 3-3 6 6-3 3-2-2-3 3 2 2-3 3-2-2-9 9z"/>
                            </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-2">
                    <div class="card text-white bg-secondary bg-gradient rounded-4 shadow h-100">
                        <div class="card-body py-1 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0" style="font-size:.72rem;">Labour Total</p>
                                <span class="fw-bold" style="font-size:.85rem;">{{ number_format($labourTotal, 2) }}</span>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#198754" aria-hidden="true">
                            <path d="M12 1v2a7 7 0 0 1 0 14v6h-2v-6a7 7 0 0 1 0-14V1h2zm0 4a5 5 0 0 0 0 10V5z"/>
                            </svg>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STAFF PERFORMANCE TAB -->
        <div class="tab-pane fade {{ $activeTab === 'staff' ? 'show active' : '' }}" id="staff" role="tabpanel">
            <div class="card rounded-4 shadow-sm border-0">
                <div class="card-header bg-white border-0 py-2">
                    <h6 class="fw-bold mb-0" style="font-size:.9rem;">Top Staff (Completed Job Cards)</h6>
                </div>
                <div class="card-body py-2">
                    <div class="row g-2 mb-2">
                        @php($staffColors = ['bg-primary','bg-success','bg-warning'])
                        @php($iconColors = ['#0d6efd','#198754','#ffc107'])
                        @foreach ($topStaff as $i => $staff)
                            @php($bg = $staffColors[$i % count($staffColors)])
                            @php($ico = $iconColors[$i % count($iconColors)])
                            <div class="col-6 col-md-3 col-xl-2">
                                <div class="card text-white {{ $bg }} bg-gradient rounded-4 shadow h-100">
                                    <div class="card-body py-1 d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-0" style="font-size:.72rem;">#{{ $i+1 }} {{ $staff['name'] }}</p>
                                            <span class="fw-bold" style="font-size:.85rem;">{{ $staff['count'] }}</span>
                                        </div>
                                        <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                            <i class="ri-medal-2-line" style="font-size:.9rem;color: {{ $ico }}"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="table-responsive">
                            <table class="table table-sm table-striped table-hover align-middle text-nowrap mb-0 small">
                                <thead class="table-light">
                                    <tr>
                                        <th class="small">Rank</th>
                                        <th class="small">Staff</th>
                                        <th class="small">Completed Jobs</th>
                                        <th class="small">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topStaff as $i => $staff)
                                        <tr>
                                            <td>#{{ $i+1 }}</td>
                                            <td>{{ $staff['name'] }}</td>
                                            <td>{{ $staff['count'] }}</td>
                                            <td>
                                                @if($staff['id'] > 0 && $staff['count'] > 0)
                                                    <a type="button"  title="View Completed Jobs"
                                                        wire:click="viewStaffJobs({{ $staff['id'] }})">
                                                        <i class="ri-eye-line text-primary;"></i>
                                                    </a>
                                                @else
                                                    <span class="text-muted small">—</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>

        <!-- Modal: Staff Completed Jobs -->
        <div class="modal fade" id="staffJobsModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Completed Jobs - {{ $selectedStaffName }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group">
                            @forelse ($staffJobs as $j)
                                <a href="{{ route('workshop.jobcardedit', $j['id']) }}" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-semibold">{{ $j['number'] }}</div>
                                        <div class="small text-muted">{{ $j['customer'] }} · {{ $j['phone'] }}</div>
                                    </div>
                                    <i class="bx bx-link-external"></i>
                                </a>
                            @empty
                                <div class="text-muted small text-center py-2">No jobs found.</div>
                            @endforelse
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CUSTOMERS TAB -->
        <div class="tab-pane fade" id="customers" role="tabpanel">
            <div class="alert alert-info">Customers data </div>
        </div>
    </div>
</div>
