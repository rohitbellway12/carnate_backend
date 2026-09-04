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
                               placeholder="Search Part Name, Brand, No..." wire:model.live.debounce.300ms="search" style="min-width: 280px;">
                        <span class="position-absolute top-50 translate-middle-y start-0 ps-3 text-secondary"><i class="bx bx-search fs-5"></i></span>
                    </div>

                    <!-- 🗂️ Category Filter -->
                    <div>
                        <select class="form-select form-select-sm border-secondary" wire:model.live="categoryFilter">
                            <option value="">All Categories</option>
                            <option value="1">Accessory</option>
                            <option value="2">Parts</option>
                            <option value="3">Tools</option>
                            <option value="4">Lubricants</option>
                        </select>
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

    <!-- 📈 Summary Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Items -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #dbeafe;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #1e3a8a !important;">Total Products</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #1e3a8a !important;">{{ $totals['total_entries'] }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-primary text-white"><i class="bx bx-layer"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Quantity -->
        <div class="col-6 col-md-3">
            <div class="card rounded-4 shadow-sm h-100 border-0" style="background: #f3e8ff;">
                <div class="card-body py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-1 fw-semibold small" style="color: #581c87 !important;">Total Stock Qty</p>
                        <h3 class="mb-0 text-dark fw-bold" style="color: #581c87 !important;">{{ number_format($totals['total_quantity']) }}</h3>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-warning text-dark"><i class="bx bx-package"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Value -->
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

        <!-- Alerts -->
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

    <!-- 🗂️ Category Quick Summary -->
    <div class="row g-2 mb-4">
        @php
            $catConfig = [
                1 => ['label' => 'Accessory',  'icon' => 'bx-car',       'color' => '#3b82f6', 'bg' => '#eff6ff'],
                2 => ['label' => 'Parts',      'icon' => 'bx-cog',       'color' => '#f59e0b', 'bg' => '#fffbeb'],
                3 => ['label' => 'Tools',      'icon' => 'bx-wrench',    'color' => '#8b5cf6', 'bg' => '#f5f3ff'],
                4 => ['label' => 'Lubricants', 'icon' => 'bx-droplet',   'color' => '#10b981', 'bg' => '#f0fdf4'],
            ];
        @endphp
        @foreach($catConfig as $typeId => $cfg)
        <div class="col-6 col-md-3">
            <div class="card rounded-3 border-0 shadow-sm" style="background: {{ $cfg['bg'] }};">
                <div class="card-body py-2 px-3 d-flex align-items-center gap-2">
                    <i class="bx {{ $cfg['icon'] }} fs-4" style="color: {{ $cfg['color'] }};"></i>
                    <div>
                        <div class="fw-semibold small" style="color: {{ $cfg['color'] }};">{{ $cfg['label'] }}</div>
                        <div class="fw-bold text-dark">{{ $totals['by_category'][$typeId] }} items</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- 📊 Main Data Table -->
    <div class="card rounded-4 shadow-sm border-0">
        <div class="card-body p-4">
            <h5 class="mb-3 text-dark">Stock Status List</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Part Name</th>
                            <th>Part Number</th>
                            <th>Brand</th>
                            <th class="text-center">Rack No</th>
                            <th class="text-center">Stock Qty</th>
                            <th class="text-end">Selling Price (₹)</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        @php
                            $categoryLabels = [1 => 'Accessory', 2 => 'Parts', 3 => 'Tools', 4 => 'Lubricants'];
                            $categoryColors = [1 => 'primary', 2 => 'warning', 3 => 'info', 4 => 'success'];
                        @endphp
                        @forelse($stocks as $index => $s)
                            <tr>
                                <td>{{ ($stocks->currentPage() - 1) * $stocks->perPage() + $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-{{ $categoryColors[$s->spare_part_type] ?? 'secondary' }} text-{{ $s->spare_part_type == 2 ? 'dark' : 'white' }}">
                                        {{ $categoryLabels[$s->spare_part_type] ?? 'Other' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $s->label->title ?? '-' }}</div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="flex-grow-1"><code class="part-number-text">{{ strtoupper($s->part_number ?: '-') }}</code></span>
                                        @if($s->part_number)
                                            <button class="btn btn-sm btn-light p-1 border-0 copy-part-number" data-part-number="{{ $s->part_number }}" title="Copy Part Number" style="line-height:1;">
                                                <i class="bx bx-copy" style="font-size:16px;"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $s->brand ?: '-' }}</td>
                                <td class="text-center"><span class="badge bg-secondary">{{ $s->rack_no ?: '-' }}</span></td>
                                <td class="text-center">
                                    <span class="fw-bold text-dark">{{ $s->stock }}</span>
                                    <small class="text-muted">{{ $s->unit->name ?? 'pcs' }}</small>
                                </td>
                                <td class="text-end fw-semibold">₹{{ number_format((float)$s->price, 2) }}</td>
                                <td class="text-center">
                                    @if($s->stock <= 0)
                                        <span class="badge bg-danger text-white">Out of Stock</span>
                                    @elseif($s->stock <= 5)
                                        <span class="badge bg-warning text-dark">Low Stock</span>
                                    @else
                                        <span class="badge bg-success text-white">In Stock</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-secondary py-4">No matching stock items found.</td>
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
    <script>
        document.addEventListener('livewire:navigated', () => {
            document.querySelectorAll('.copy-part-number').forEach(btn => {
                btn.addEventListener('click', function() {
                    const partNumber = this.getAttribute('data-part-number');
                    navigator.clipboard.writeText(partNumber).then(() => {
                        const icon = this.querySelector('i');
                        icon.className = 'bx bx-check';
                        setTimeout(() => {
                            icon.className = 'bx bx-copy';
                        }, 1500);
                    });
                });
            });
        });
    </script>
</div>
