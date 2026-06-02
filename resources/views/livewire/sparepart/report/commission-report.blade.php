<div>
    <!-- 📄 Breadcrumb & Header -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Reports</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('sparepart.dashboard') }}"><i class="bx bx-home-alt text-primary"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Commission Report</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- 📊 Filters Panel -->
    <div class="card rounded-4 shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <!-- 🔍 Search Bar -->
                    <div class="position-relative">
                        <input type="text" class="form-control form-control-sm ps-5 border-secondary" 
                               placeholder="Search Invoice No, Order No, Part..." wire:model.live.debounce.300ms="search" style="min-width: 280px;">
                        <span class="position-absolute top-50 translate-middle-y start-0 ps-3 text-secondary"><i class="bx bx-search fs-5"></i></span>
                    </div>

                    <!-- 🗓️ Date Quick Filter -->
                    <div>
                        <select class="form-select form-select-sm border-secondary" wire:model.live="filterType">
                            <option value="">All Time</option>
                            <option value="daily">Today</option>
                            <option value="weekly">This Week</option>
                            <option value="monthly">This Month</option>
                        </select>
                    </div>

                    <!-- 📅 From Date -->
                    <div>
                        <input type="date" class="form-control form-control-sm border-secondary" wire:model.live="fromDate">
                    </div>

                    <!-- 📅 To Date -->
                    <div>
                        <input type="date" class="form-control form-control-sm border-secondary" wire:model.live="toDate">
                    </div>
                </div>

                <!-- 🧾 Exports -->
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1" wire:click="downloadPDF">
                        <i class="bx bxs-file-pdf"></i> Export PDF
                    </button>
                    <button class="btn btn-sm btn-success text-white d-flex align-items-center gap-1" wire:click="downloadExcel">
                        <i class="bx bxs-spreadsheet"></i> Export Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 📈 Summary Cards Grid -->
    <div class="row g-3 mb-4">
        <!-- Total Gross Sales - Light Blue -->
        <div class="col-12 col-md-4">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #dbeafe;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #1e3a8a !important;">Total Gross Sales</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #1e3a8a !important;">₹{{ number_format((float)$totals['total_gross'], 2) }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-primary text-white"><i class="bx bx-receipt"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Commission Deducted - Light Red -->
        <div class="col-12 col-md-4">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #ffe4e6;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #9f1239 !important;">Platform Charge / Commission (10%)</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #9f1239 !important;">₹{{ number_format((float)$totals['total_commission'], 2) }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-danger text-white"><i class="bx bx-percentage"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Net Settlement Paid - Light Green -->
        <div class="col-12 col-md-4">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #dcfce7;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #166534 !important;">Net Settled Payout</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #166534 !important;">₹{{ number_format((float)$totals['total_net'], 2) }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-success text-white"><i class="bx bx-wallet"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 📊 Main Data Table Card -->
    <div class="card rounded-4 shadow-sm border-0">
        <div class="card-body p-4">
            <h5 class="mb-3 text-dark">Platform Commission Ledger</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order No.</th>
                            <!--<th>Invoice No.</th>-->
                            <th>Order Date</th>
                            <th>Part Details</th>
                            <th class="text-end">Gross Amount (₹)</th>
                            <th class="text-center">Commission Rate (%)</th>
                            <th class="text-end">Commission (₹)</th>
                            <th class="text-end">Net Settled (₹)</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        @forelse($items as $item)
                            @php
                                $commissionPercent = (float) getCommission($item->category);
                                $grossAmount = (float) $item->total_amount;
                                $commissionAmount = ($grossAmount * $commissionPercent) / 100;
                                $netAmount = $grossAmount - $commissionAmount;
                            @endphp
                            <tr>
                                <td><strong>#{{ $item->order_id }}</strong></td>
                                <!--<td><strong>{{ sparepartOrderReference($item->order) }}</strong></td>-->
                                <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y, h:i A') : 'N/A' }}</td>
                                <td>
                                    <div class="fw-bold">{{ $item->SpareParts->name ?? 'N/A' }}</div>
                                    <span class="text-secondary small">Qty: {{ $item->quantity }} x ₹{{ number_format((float)$item->price, 2) }}</span>
                                </td>
                                <td class="text-end">₹{{ number_format($grossAmount, 2) }}</td>
                                <td class="text-center text-danger fw-semibold">{{ $commissionPercent }}%</td>
                                <td class="text-end text-danger fw-semibold">- ₹{{ number_format($commissionAmount, 2) }}</td>
                                <td class="text-end text-success fw-bold">₹{{ number_format($netAmount, 2) }}</td>
                                <td class="text-center">
                                    @switch($item->status)
                                        @case(1) <span class="badge bg-primary text-white">Accepted</span> @break
                                        @case(3) <span class="badge bg-info text-white">Handover</span> @break
                                        @case(4) <span class="badge bg-success text-white">Received</span> @break
                                        @default <span class="badge bg-secondary text-white">Processed</span>
                                    @endswitch
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-secondary py-4">No commission logs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 📄 Pagination -->
            <div class="mt-3 d-flex justify-content-end">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>
