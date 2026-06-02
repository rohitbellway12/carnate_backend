<div class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- High-Impact Stats Row -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 g-4 mb-4">
        <div class="col">
            <div class="card radius-10 border-0 border-start border-3 border-primary shadow-sm bg-light-primary">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-primary fw-bold text-uppercase small">Total Sub Admins</p>
                            <h3 class="my-1 text-primary">{{ $subadmin }}</h3>
                            <p class="mb-0 font-13 text-muted">Active sub-admin accounts</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-white shadow-sm text-primary ms-auto"><i class='bx bxs-user-account'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-3 border-info shadow-sm bg-light-info">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-info fw-bold text-uppercase small">Workshops</p>
                            <h3 class="my-1 text-info">{{ $workshop }}</h3>
                            <p class="mb-0 font-13 text-muted">Registered workshops</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-white shadow-sm text-info ms-auto"><i class='bx bxs-wrench'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-3 border-warning shadow-sm bg-light-warning">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-warning fw-bold text-uppercase small">Spare Part Vendors</p>
                            <h3 class="my-1 text-warning">{{ $sparepart }}</h3>
                            <p class="mb-0 font-13 text-muted">Spare part suppliers</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-white shadow-sm text-warning ms-auto"><i class='bx bxs-cart'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-3 border-success shadow-sm bg-light-success">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-success fw-bold text-uppercase small">Total Payments</p>
                            <h3 class="my-1 text-success">{{ $totalPayments }}</h3>
                            <p class="mb-0 font-13 text-muted">Payment transactions</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-white shadow-sm text-success ms-auto"><i class='bx bxs-wallet'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-3 border-danger shadow-sm bg-light-danger">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-danger fw-bold text-uppercase small">Total Payment Amount</p>
                            <h3 class="my-1 text-danger">₹{{ number_format($totalPaymentAmount, 2) }}</h3>
                            <p class="mb-0 font-13 text-muted">All-time collected</p>
                        </div>
                        <!-- <div class="widgets-icons-2 rounded-circle bg-white shadow-sm text-danger ms-auto"><i class='bx bxs-money'></i></div> -->
                   <div class="widgets-icons-2 rounded-circle bg-white shadow-sm text-danger ms-auto">
    <i class='bx bx-rupee'></i>
</div>
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
                            <h6 class="mb-0">Order Management Overview</h6>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-3 g-3">
                        <div class="col">
                            <div class="p-3 border radius-10 text-center">
                                <h3 class="mb-0 text-primary">{{ $orderStats['pending'] }}</h3>
                                <p class="mb-0 text-secondary small text-uppercase">Pending Orders</p>
                                <div class="progress mt-3" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border radius-10 text-center">
                                <h3 class="mb-0 text-info">{{ $orderStats['confirmed'] }}</h3>
                                <p class="mb-0 text-secondary small text-uppercase">Confirmed Orders</p>
                                <div class="progress mt-3" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border radius-10 text-center">
                                <h3 class="mb-0 text-success">{{ $orderStats['total'] }}</h3>
                                <p class="mb-0 text-secondary small text-uppercase">Total Orders</p>
                                <div class="progress mt-3" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.order-list') }}" class="btn btn-outline-primary btn-sm w-100">Go to Orders <i class='bx bx-right-arrow-alt'></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Statistics -->
        <div class="col-12 col-xl-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <h6 class="mb-3">System Statistics</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">Total Customers <span class="badge bg-primary rounded-pill">{{ $totalCustomers }}</span></li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Total Vehicles <span class="badge bg-info rounded-pill">{{ $totalVehicles }}</span></li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Total Users <span class="badge bg-success rounded-pill">{{ $totalUsers }}</span></li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Total Orders <span class="badge bg-warning rounded-pill">{{ $totalOrders }}</span></li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Total Job Cards <span class="badge bg-danger rounded-pill">{{ $totalJobCards }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Job Cards -->
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent border-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Recent Job Cards</h6>
                        </div>
                        <div class="ms-auto text-primary"><i class='bx bxs-wrench'></i></div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Job Card No</th>
                                    <th>Customer</th>
                                    <th>Vehicle</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentJobCards as $jobcard)
                                <tr>
                                    <td><span class="badge bg-light-primary text-primary w-100">{{ $jobcard->jobcard_number }}</span></td>
                                    <td>{{ $jobcard->customer?->name ?? 'N/A' }}</td>
                                    <td>{{ $jobcard->vehicle?->modelname ?? 'N/A' }}</td>
                                    <td>
                                        @if($jobcard->status == 0)
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($jobcard->status == 1)
                                            <span class="badge bg-info">In Progress</span>
                                        @elseif($jobcard->status == 2)
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-secondary">Unknown</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted small italic">No job cards found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent border-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Recent Orders</h6>
                        </div>
                        <div class="ms-auto text-success"><i class='bx bxs-shopping-bag'></i></div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $orders = \App\Models\Order::with(['workShopVendor', 'sparePartVendor'])->orderBy('id', 'DESC')->limit(5)->get();
                                @endphp
                                @forelse($orders as $order)
                                <tr>
                                    <td><span class="badge bg-light-primary text-primary w-100">#{{ $order->id }}</span></td>
                                    <td>{{ $order->workShopVendor?->name ?? $order->sparePartVendor?->name ?? 'N/A' }}</td>
                                    <td>₹{{ number_format($order->orderItem->sum('price') * $order->orderItem->sum('quantity'), 2) }}</td>
                                    <td>
                                        @if($order->is_confim == 0)
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @else
                                            <span class="badge bg-success">Confirmed</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted small italic">No orders found</td>
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
