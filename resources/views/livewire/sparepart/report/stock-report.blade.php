<div>
    <!-- 📄 Breadcrumb & Header -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Reports</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('sparepart.dashboard') }}"><i class="bx bx-home-alt text-primary"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Stock Report</li>
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
                               placeholder="Search Part Name, Brand or No..." wire:model.live.debounce.300ms="search" style="min-width: 280px;">
                        <span class="position-absolute top-50 translate-middle-y start-0 ps-3 text-secondary"><i class="bx bx-search fs-5"></i></span>
                    </div>

                    <!-- 🏷️ Brand Filter -->
                    <div>
                        <select class="form-select form-select-sm border-secondary" wire:model.live="brandFilter">
                            <option value="">All Brands</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}">{{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 📦 Stock Status Filter -->
                    <div>
                        <select class="form-select form-select-sm border-secondary" wire:model.live="stockStatusFilter">
                            <option value="">All Stock Levels</option>
                            <option value="in">In Stock (> 5)</option>
                            <option value="low">Low Stock (1 - 5)</option>
                            <option value="out">Out of Stock (0)</option>
                        </select>
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
        <!-- Total Stock Entries - Light Blue -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #dbeafe;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #1e3a8a !important;">Unique Stock Items</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #1e3a8a !important;">{{ $totals['total_entries'] }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-primary text-white"><i class="bx bx-layer"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Stock Quantity - Light Purple -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #f3e8ff;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #581c87 !important;">Total Stock Quantity</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #581c87 !important;">{{ number_format($totals['total_quantity']) }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-warning text-dark"><i class="bx bx-package"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Stock Value - Light Green -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #dcfce7;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #166534 !important;">Total Stock Value</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #166534 !important;">₹{{ number_format((float)$totals['total_value'], 2) }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-success text-white"><i class="bx bx-wallet"></i></div>
                </div>
            </div>
        </div>

        <!-- Low & Out of Stock Alerts - Light Red -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #ffe4e6;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #9f1239 !important;">Stock Alerts</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #9f1239 !important;">{{ $totals['low_stock'] + $totals['out_of_stock'] }}</h3>
                        <span class="text-danger small" style="color: #9f1239 !important; font-weight: bold;">{{ $totals['out_of_stock'] }} Out of Stock</span>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-danger text-white"><i class="bx bx-error"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 📊 Main Data Table Card -->
    <div class="card rounded-4 shadow-sm border-0">
        <div class="card-body p-4">
            <h5 class="mb-3 text-dark">Stock Status List</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Part Details</th>
                            <th>Part Number</th>
                            <th>Brand / Manufacturer</th>
                            <th class="text-center">Rack No</th>
                            <th class="text-center">Stock Quantity</th>
                            <th class="text-end">Stock Value (₹)</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        @forelse($stocks as $s)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $s->partname }}</div>
                                </td>
                                <td><code>{{ $s->part_no ?: '-' }}</code></td>
                                <td>{{ $s->company_name ?: '-' }}</td>
                                <td class="text-center"><span class="badge bg-secondary">{{ $s->rack_no ?: '-' }}</span></td>
                                <td class="text-center">
                                    <span class="fw-bold text-dark">{{ $s->quantity }}</span> {{ $s->unit->name ?? 'pcs' }}
                                </td>
                                <td class="text-end fw-semibold">₹{{ number_format((float)$s->total_payable, 2) }}</td>
                                <td class="text-center">
                                    @if($s->quantity <= 0)
                                        <span class="badge bg-danger text-white">Out of Stock</span>
                                    @elseif($s->quantity <= 5)
                                        <span class="badge bg-warning text-dark">Low Stock</span>
                                    @else
                                        <span class="badge bg-success text-white">In Stock</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-secondary py-4">No matching stock items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 📄 Pagination -->
            <div class="mt-3 d-flex justify-content-end">
                {{ $stocks->links() }}
            </div>
        </div>
    </div>
</div>
