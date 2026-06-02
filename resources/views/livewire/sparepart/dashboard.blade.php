<div class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">SparePart</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Real-time Inventory & Order Insights</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- High-Impact Stats Row -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-4">
        <div class="col">
            <div class="card radius-10 border-0 border-start border-3 border-primary shadow-sm bg-light-primary">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-primary fw-bold text-uppercase small">Total Revenue</p>
                            <h3 class="my-1 text-primary">₹ {{ number_format($totalRevenue, 2) }}</h3>
                            <p class="mb-0 font-13 text-muted">All-time sales value</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-white shadow-sm text-primary ms-auto"><i class='bx bxs-wallet'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-3 border-info shadow-sm bg-light-info">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-info fw-bold text-uppercase small">Real-time Stock</p>
                            <h3 class="my-1 text-info">{{ number_format($totalStockQuantity) }}</h3>
                            <p class="mb-0 font-13 text-muted">Across {{ $stocks }} SKUs</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-white shadow-sm text-info ms-auto"><i class='bx bxs-box'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-3 border-warning shadow-sm bg-light-warning">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-warning fw-bold text-uppercase small">Pending Orders</p>
                            <h3 class="my-1 text-warning">{{ $orderStats['pending'] }}</h3>
                            <p class="mb-0 font-13 text-muted">Awaiting action</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-white shadow-sm text-warning ms-auto"><i class='bx bxs-time-five'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-3 border-danger shadow-sm bg-light-danger">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-danger fw-bold text-uppercase small">Critical Alerts</p>
                            <h3 class="my-1 text-danger">{{ count($lowStockItems) }}</h3>
                            <p class="mb-0 font-13 text-muted">Low stock products</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-white shadow-sm text-danger ms-auto"><i class='bx bxs-error-circle'></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Order Management Overview -->
        <div class="col-12 col-xl-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <h6 class="mb-0">Order Management Hub</h6>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-3 g-3">
                        <div class="col">
                            <div class="p-3 border radius-10 text-center">
                                <h3 class="mb-0 text-primary">{{ $orderStats['pending'] }}</h3>
                                <p class="mb-0 text-secondary small text-uppercase">Pending</p>
                                <div class="progress mt-3" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border radius-10 text-center">
                                <h3 class="mb-0 text-info">{{ $orderStats['accepted'] }}</h3>
                                <p class="mb-0 text-secondary small text-uppercase">Accepted</p>
                                <div class="progress mt-3" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border radius-10 text-center">
                                <h3 class="mb-0 text-success">{{ $orderStats['delivered'] }}</h3>
                                <p class="mb-0 text-secondary small text-uppercase">Handovered/Delivered</p>
                                <div class="progress mt-3" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('sparepart.order') }}" class="btn btn-outline-primary btn-sm w-100">Go to Order Management <i class='bx bx-right-arrow-alt'></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Breakdown (Small Stats) -->
        <div class="col-12 col-xl-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <h6 class="mb-3">Inventory Insights</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">Accessories <span class="badge bg-success rounded-pill">{{ $accessory }}</span></li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Parts <span class="badge bg-info rounded-pill">{{ $parts }}</span></li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Tools <span class="badge bg-danger rounded-pill">{{ $tools }}</span></li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Lubricants <span class="badge bg-warning text-dark rounded-pill">{{ $lubricant }}</span></li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Categories <span class="badge bg-primary rounded-pill">{{ $category }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Low Stock Alerts -->
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent border-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Low Stock Alerts</h6>
                        </div>
                        <div class="ms-auto text-danger"><i class='bx bxs-bell-ring'></i></div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Part Name</th>
                                    <th>Part No</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lowStockItems as $item)
                                <tr>
                                    <td>{{ $item->partname }}</td>
                                    <td><span class="badge bg-light-secondary text-secondary w-100">{{ $item->part_no }}</span></td>
                                    <td><span class="text-danger fw-bold">{{ $item->quantity }}</span></td>
                                    <td><a href="{{ route('sparepart.stock.list') }}" class="btn btn-sm btn-outline-danger radius-30">Restock</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted small italic">No low stock items detected. Inventory looks healthy!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Selling Products -->
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent border-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Top Selling Products</h6>
                        </div>
                        <div class="ms-auto text-success"><i class='bx bxs-badge-check'></i></div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Sold Qty</th>
                                    <th>Inventory Plan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topSellingProducts as $product)
                                <tr>
                                    <td>{{ @$product->SpareParts->name ?? 'N/A' }}</td>
                                    <td><span class="badge bg-light-success text-success w-100">{{ $product->total_sold }}</span></td>
                                    <td><div class="progress" style="height: 5px;"><div class="progress-bar bg-success" style="width: 80%"></div></div></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted small italic">No sales data available for insights.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
