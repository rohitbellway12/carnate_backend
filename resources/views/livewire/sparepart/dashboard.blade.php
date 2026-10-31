<div class="carnate-sparepart-dashboard">
    <style>
        .carnate-sparepart-dashboard {
            --brand-red: #e53935;
            --brand-red-dark: #b71c1c;
            --brand-red-soft: #fef2f2;
            --brand-dark: #0f172a;
            --brand-slate: #1e293b;
            --brand-muted: #64748b;
            --brand-border: #e2e8f0;
            --brand-bg: #f8fafc;
            --brand-card: #ffffff;
            --brand-emerald: #10b981;
            --brand-emerald-soft: #ecfdf5;
            --brand-blue: #3b82f6;
            --brand-blue-soft: #eff6ff;
            --brand-amber: #f59e0b;
            --brand-amber-soft: #fffbeb;
            --brand-purple: #8b5cf6;
            --brand-purple-soft: #f5f3ff;

            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: var(--brand-slate);
            padding-bottom: 30px;
        }

        /* Header & Quick Action Buttons */
        .dash-header-card {
            background: var(--brand-card);
            border: 1px solid var(--brand-border);
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 22px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .dash-title-group h3 {
            margin: 0;
            font-size: 22px;
            font-weight: 750;
            color: var(--brand-slate);
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dash-title-group p {
            margin: 4px 0 0;
            font-size: 13px;
            color: var(--brand-muted);
        }

        .quick-action-btns {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-quick-primary {
            background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
            color: #fff !important;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 18px;
            border-radius: 10px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            box-shadow: 0 4px 12px rgba(229, 57, 53, 0.25);
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-quick-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(229, 57, 53, 0.35);
            color: #fff;
        }

        .btn-quick-secondary {
            background: #fff;
            color: var(--brand-slate) !important;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 16px;
            border-radius: 10px;
            border: 1px solid var(--brand-border);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-quick-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        /* Hero KPI Cards */
        .kpi-card {
            background: var(--brand-card);
            border: 1px solid var(--brand-border);
            border-radius: 16px;
            padding: 22px 20px;
            height: 100%;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            transition: all 0.2s ease;
        }

        .kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
            border-color: #cbd5e1;
        }

        .kpi-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }

        .kpi-card.revenue::after { background: var(--brand-emerald); }
        .kpi-card.orders::after { background: var(--brand-red); }
        .kpi-card.stock::after { background: var(--brand-blue); }
        .kpi-card.alerts::after { background: var(--brand-amber); }

        .kpi-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .kpi-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--brand-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .kpi-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .kpi-icon-box.green { background: var(--brand-emerald-soft); color: var(--brand-emerald); }
        .kpi-icon-box.red { background: var(--brand-red-soft); color: var(--brand-red); }
        .kpi-icon-box.blue { background: var(--brand-blue-soft); color: var(--brand-blue); }
        .kpi-icon-box.amber { background: var(--brand-amber-soft); color: var(--brand-amber); }

        .kpi-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--brand-slate);
            margin: 0 0 6px;
            line-height: 1.1;
        }

        .kpi-meta {
            font-size: 12px;
            color: var(--brand-muted);
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .kpi-badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            padding: 2px 7px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
        }

        .kpi-badge.up { background: var(--brand-emerald-soft); color: var(--brand-emerald); }
        .kpi-badge.info { background: var(--brand-blue-soft); color: var(--brand-blue); }
        .kpi-badge.warn { background: var(--brand-amber-soft); color: var(--brand-amber); }
        .kpi-badge.danger { background: var(--brand-red-soft); color: var(--brand-red); }

        /* Panels / Section Cards */
        .dash-panel {
            background: var(--brand-card);
            border: 1px solid var(--brand-border);
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .panel-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--brand-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .panel-title {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--brand-slate);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-title i {
            color: var(--brand-red);
            font-size: 20px;
        }

        .panel-link {
            font-size: 12px;
            font-weight: 600;
            color: var(--brand-red);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .panel-link:hover {
            color: var(--brand-red-dark);
            text-decoration: underline;
        }

        .panel-body {
            padding: 20px 22px;
        }

        /* Modern Table Styling */
        .dash-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 0;
        }

        .dash-table th {
            background: #f8fafc;
            color: var(--brand-muted);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            padding: 12px 16px;
            border-top: none;
            border-bottom: 1px solid var(--brand-border);
        }

        .dash-table td {
            padding: 14px 16px;
            vertical-align: middle;
            border-bottom: 1px solid var(--brand-border);
            font-size: 13px;
        }

        .dash-table tr:last-child td {
            border-bottom: none;
        }

        .dash-table tr:hover td {
            background-color: #fafbfc;
        }

        /* Status Pills */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .status-badge.pending { background: #fef3c7; color: #d97706; }
        .status-badge.accepted { background: #e0f2fe; color: #0284c7; }
        .status-badge.delivered { background: #dcfce7; color: #16a34a; }
        .status-badge.declined { background: #fee2e2; color: #dc2626; }

        .order-num-badge {
            background: #0f172a;
            color: #ffffff;
            font-weight: 700;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 6px;
            letter-spacing: 0.5px;
            font-family: monospace;
            display: inline-block;
        }

        .action-icon-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--brand-border);
            background: #fff;
            color: var(--brand-slate);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.15s ease;
            text-decoration: none;
        }

        .action-icon-btn:hover {
            background: var(--brand-red);
            border-color: var(--brand-red);
            color: #fff;
        }

        /* Empty states */
        .empty-state-box {
            text-align: center;
            padding: 35px 20px;
            color: var(--brand-muted);
        }

        .empty-state-box i {
            font-size: 38px;
            color: #cbd5e1;
            margin-bottom: 8px;
        }

        .empty-state-box p {
            font-size: 13px;
            margin: 0;
        }

        /* Mini list items */
        .mini-list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--brand-border);
            gap: 12px;
        }

        .mini-list-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .mini-list-item:first-child {
            padding-top: 0;
        }

        .mini-item-title {
            font-weight: 700;
            font-size: 13px;
            color: var(--brand-slate);
            margin: 0;
        }

        .mini-item-sub {
            font-size: 12px;
            color: var(--brand-muted);
            margin: 2px 0 0;
        }
    </style>

    {{-- ApexCharts CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- 1. Header & Quick Actions --}}
    <div class="dash-header-card">
        <div class="dash-title-group">
            <h3><i class="bx bx-package text-danger"></i> Spare Part Distribution Hub</h3>
            <p>Real-time view of workshop orders, stock inventory, revenues & fulfillment</p>
        </div>

        <div class="quick-action-btns">
            <a href="{{ route('sparepart.stock.list') }}" class="btn-quick-primary">
                <i class="bx bx-plus-circle"></i> + Manage Stock
            </a>
            <a href="{{ route('sparepart.order') }}" class="btn-quick-secondary">
                <i class="bx bx-cart"></i> Orders Hub
            </a>
            <a href="{{ route('sparepart.paid-order') }}" class="btn-quick-secondary">
                <i class="bx bx-receipt"></i> Paid Orders
            </a>
            <a href="{{ route('sparepart.purchaseorder') }}" class="btn-quick-secondary">
                <i class="bx bx-purchase-tag"></i> Purchase Orders
            </a>
        </div>
    </div>

    {{-- 2. Top 4 High-Impact KPI Cards --}}
    <div class="row g-3 mb-4">
        {{-- Card 1: Monthly Sales Revenue (Matching Profit & Loss Report) --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card revenue">
                <div class="kpi-header">
                    <span class="kpi-label">This Month Sales</span>
                    <div class="kpi-icon-box green">
                        <i class="bx bx-rupee"></i>
                    </div>
                </div>
                <h2 class="kpi-value">₹{{ number_format($monthlyRevenue) }}</h2>
                <div class="kpi-meta">
                    @if ($monthlyGrossProfit != 0)
                        <span class="kpi-badge up" title="Gross Profit = Sales - (Purchases + Commission)">
                            ₹{{ number_format($monthlyGrossProfit) }} Profit
                        </span>
                    @endif
                    <span>(Counter + Online Sales)</span>
                </div>
            </div>
        </div>

        {{-- Card 2: Active Orders Queue --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card orders">
                <div class="kpi-header">
                    <span class="kpi-label">Workshop Orders</span>
                    <div class="kpi-icon-box red">
                        <i class="bx bx-shopping-bag"></i>
                    </div>
                </div>
                <h2 class="kpi-value">{{ $orderStats['total'] }} <span style="font-size: 15px; font-weight: 600; color: var(--brand-muted);">Orders</span></h2>
                <div class="kpi-meta">
                    @if ($orderStats['pending'] > 0)
                        <span class="kpi-badge warn">{{ $orderStats['pending'] }} Pending (₹{{ number_format($pendingOrdersAmount) }})</span>
                    @else
                        <span class="kpi-badge up">Queue Cleared</span>
                    @endif
                    <span>{{ $orderStats['accepted'] }} Accepted</span>
                </div>
            </div>
        </div>

        {{-- Card 3: Total Warehouse Stock Quantity --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card stock">
                <div class="kpi-header">
                    <span class="kpi-label">Warehouse Stock</span>
                    <div class="kpi-icon-box blue">
                        <i class="bx bx-box"></i>
                    </div>
                </div>
                <h2 class="kpi-value">{{ number_format($totalStockQuantity) }} <span style="font-size: 15px; font-weight: 600; color: var(--brand-muted);">Units</span></h2>
                <div class="kpi-meta">
                    <span>Catalog: <strong>{{ $totalCatalogParts }}</strong> Parts · <strong>{{ $totalPurchaseOrders }}</strong> POs</span>
                </div>
            </div>
        </div>

        {{-- Card 4: Inventory Alerts --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card alerts">
                <div class="kpi-header">
                    <span class="kpi-label">Inventory Health</span>
                    <div class="kpi-icon-box amber">
                        <i class="bx bx-error-alt"></i>
                    </div>
                </div>
                <h2 class="kpi-value">{{ $lowStockCount }} <span style="font-size: 15px; font-weight: 600; color: var(--brand-muted);">Low Stock</span></h2>
                <div class="kpi-meta">
                    @if ($lowStockCount > 0)
                        <span class="kpi-badge danger"><i class="bx bx-error"></i> Needs Restock</span>
                        <span>Threshold &le; 10 units</span>
                    @else
                        <span class="kpi-badge up">Healthy Levels</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Visual Interactive Analytics & Charts --}}
    <div class="row g-3 mb-4">
        {{-- Sales Revenue & Orders Trend Chart --}}
        <div class="col-12 col-xl-8">
            <div class="dash-panel h-100 mb-0">
                <div class="panel-header">
                    <h5 class="panel-title">
                        <i class="bx bx-bar-chart-alt-2"></i> Sales & Orders Trend (Last 6 Months)
                    </h5>
                    <span class="badge bg-light text-dark border">Revenue (₹) & Orders</span>
                </div>
                <div class="panel-body">
                    <div id="chart-sparepart-trend" style="min-height: 290px;"></div>
                </div>
            </div>
        </div>

        {{-- Category Breakdown Donut Chart --}}
        <div class="col-12 col-xl-4">
            <div class="dash-panel h-100 mb-0">
                <div class="panel-header">
                    <h5 class="panel-title">
                        <i class="bx bx-pie-chart-alt-2"></i> Catalog by Category
                    </h5>
                    <span class="badge bg-light text-dark border">Inventory Share</span>
                </div>
                <div class="panel-body">
                    <div id="chart-sparepart-categories" style="min-height: 290px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. Operational Panels --}}
    <div class="row g-3">
        {{-- Left: Recent Workshop Orders --}}
        <div class="col-12 col-xl-8">
            <div class="dash-panel mb-0 h-100">
                <div class="panel-header">
                    <h5 class="panel-title">
                        <i class="bx bx-cart"></i> Recent Workshop Orders
                    </h5>
                    <a href="{{ route('sparepart.order') }}" class="panel-link">
                        View All Orders <i class="bx bx-chevron-right"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="dash-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Workshop Details</th>
                                <th>Items</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentOrders as $order)
                                <tr>
                                    <td>
                                        <span class="order-num-badge">
                                            {{ $order->spare_invoice_number ?: ($order->invoice_number ?: '#' . $order->id) }}
                                        </span>
                                        <div class="text-muted" style="font-size: 11px; margin-top: 3px;">
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('d M, h:i A') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; color: #1e293b;">
                                            {{ $order->workShopVendor->company_name ?? ($order->workShopVendor->name ?? 'Workshop') }}
                                        </div>
                                        <div class="text-muted" style="font-size: 12px;">
                                            <i class="bx bx-phone"></i> {{ $order->workShopVendor->mobile_no ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $order->orderItem->count() }}</strong> Parts
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; color: #0f172a;">
                                            ₹{{ number_format((float)$order->total_amount) }}
                                        </div>
                                        @if ($order->payment_status == 1)
                                            <span class="badge bg-success" style="font-size: 10px;">Paid</span>
                                        @else
                                            <span class="badge bg-secondary" style="font-size: 10px;">Unpaid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->order_status == 2)
                                            <span class="status-badge declined"><i class="bx bx-x-circle"></i> Declined</span>
                                        @elseif ($order->status == 0)
                                            <span class="status-badge pending"><i class="bx bx-time"></i> Pending</span>
                                        @elseif ($order->status == 1)
                                            <span class="status-badge accepted"><i class="bx bx-check"></i> Accepted</span>
                                        @elseif ($order->status == 2)
                                            <span class="status-badge delivered"><i class="bx bx-check-double"></i> Delivered</span>
                                        @else
                                            <span class="status-badge pending">Active</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('sparepart.order') }}" 
                                           class="action-icon-btn" 
                                           title="Manage Order">
                                            <i class="bx bx-right-arrow-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state-box">
                                            <i class="bx bx-cart"></i>
                                            <p>No recent orders found from workshops.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Right: Top Selling & Critical Low Stock --}}
        <div class="col-12 col-xl-4">
            <div class="d-flex flex-column gap-3 h-100">
                {{-- Top Selling Products --}}
                <div class="dash-panel mb-0">
                    <div class="panel-header">
                        <h5 class="panel-title">
                            <i class="bx bx-trending-up text-success"></i> Top Selling Parts
                        </h5>
                        <span class="badge bg-light text-dark border">Fast Movers</span>
                    </div>
                    <div class="panel-body">
                        @forelse ($topSellingProducts as $item)
                            <div class="mini-list-item">
                                <div>
                                    <h6 class="mini-item-title">{{ Str::limit($item->SpareParts->partname ?? ($item->category ?? 'Spare Part'), 22) }}</h6>
                                    <div class="mini-item-sub">
                                        Revenue: ₹{{ number_format((float)$item->total_rev) }}
                                    </div>
                                </div>
                                <span class="badge bg-light text-primary border font-monospace">
                                    {{ (int)$item->total_sold }} Sold
                                </span>
                            </div>
                        @empty
                            <div class="empty-state-box py-3">
                                <i class="bx bx-shopping-bag" style="font-size: 28px;"></i>
                                <p style="font-size: 12px;">No sales data yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Low Stock Items Card --}}
                <div class="dash-panel mb-0 flex-grow-1">
                    <div class="panel-header">
                        <h5 class="panel-title">
                            <i class="bx bx-error text-danger"></i> Low Stock Alerts
                        </h5>
                        <a href="{{ route('sparepart.stock.list') }}" class="panel-link">Restock</a>
                    </div>
                    <div class="panel-body">
                        @forelse ($lowStockItems as $stock)
                            <div class="mini-list-item">
                                <div>
                                    <h6 class="mini-item-title">{{ Str::limit($stock->partname ?: 'Part #' . $stock->part_no, 22) }}</h6>
                                    <div class="mini-item-sub">
                                        P/N: {{ $stock->part_no ?: 'N/A' }} · {{ $stock->company_name ?: 'Standard' }}
                                    </div>
                                </div>
                                <div>
                                    @if ($stock->quantity <= 0)
                                        <span class="badge bg-danger">Out of Stock</span>
                                    @else
                                        <span class="badge bg-warning text-dark">{{ $stock->quantity }} Left</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="empty-state-box py-3">
                                <i class="bx bx-check-circle text-success" style="font-size: 28px;"></i>
                                <p style="font-size: 12px;">All spare parts stock levels are healthy!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ApexCharts Script Initialization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initSparepartCharts();
        });

        document.addEventListener('livewire:navigated', function () {
            initSparepartCharts();
        });

        function initSparepartCharts() {
            if (typeof ApexCharts === 'undefined') {
                return;
            }

            // 1. Sales & Orders Trend Chart
            const trendMonths = @json($trendMonths);
            const trendRevenues = @json($trendRevenues);
            const trendOrders = @json($trendOrders);

            const trendOptions = {
                series: [{
                    name: 'Sales Revenue (₹)',
                    type: 'area',
                    data: trendRevenues
                }, {
                    name: 'Orders Count',
                    type: 'column',
                    data: trendOrders
                }],
                chart: {
                    height: 290,
                    type: 'line',
                    toolbar: { show: false },
                    fontFamily: 'inherit'
                },
                stroke: {
                    curve: 'smooth',
                    width: [3, 0]
                },
                fill: {
                    type: ['gradient', 'solid'],
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [0, 95, 100]
                    }
                },
                colors: ['#10b981', '#3b82f6'],
                labels: trendMonths,
                markers: { size: [4, 0] },
                yaxis: [{
                    title: {
                        text: 'Revenue (₹)',
                        style: { color: '#64748b', fontSize: '11px' }
                    },
                    labels: {
                        formatter: function (val) {
                            return '₹' + (val >= 1000 ? (val / 1000).toFixed(0) + 'k' : val);
                        }
                    }
                }, {
                    opposite: true,
                    title: {
                        text: 'Orders',
                        style: { color: '#64748b', fontSize: '11px' }
                    },
                    labels: {
                        formatter: function (val) {
                            return Math.round(val);
                        }
                    }
                }],
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function (y, { seriesIndex }) {
                            if (typeof y !== "undefined") {
                                return seriesIndex === 0 ? '₹' + Number(y).toLocaleString('en-IN') : y + ' Orders';
                            }
                            return y;
                        }
                    }
                },
                legend: { position: 'top', horizontalAlign: 'right' },
                grid: { borderColor: '#f1f5f9', strokeDashArray: 4 }
            };

            const chartTrendEl = document.querySelector("#chart-sparepart-trend");
            if (chartTrendEl) {
                chartTrendEl.innerHTML = '';
                const chartTrend = new ApexCharts(chartTrendEl, trendOptions);
                chartTrend.render();
            }

            // 2. Categories Donut Chart
            const categoryLabels = @json($categoryLabels);
            const categorySeries = @json($categorySeries);

            const hasData = categorySeries.some(val => val > 0);
            const donutSeries = hasData ? categorySeries : [1, 1, 1, 1];
            const donutLabels = hasData ? categoryLabels : ['Parts', 'Accessories', 'Lubricants', 'Tools'];

            const donutOptions = {
                series: donutSeries,
                labels: donutLabels,
                chart: {
                    type: 'donut',
                    height: 290,
                    fontFamily: 'inherit'
                },
                colors: ['#e53935', '#0ea5e9', '#f59e0b', '#8b5cf6'],
                plotOptions: {
                    pie: {
                        donut: {
                            size: '68%',
                            labels: {
                                show: true,
                                name: { show: true, fontSize: '13px', fontWeight: 600 },
                                value: { 
                                    show: true, 
                                    fontSize: '22px', 
                                    fontWeight: 800,
                                    formatter: function (val) { return val; }
                                },
                                total: {
                                    show: true,
                                    label: 'Catalog Items',
                                    fontSize: '12px',
                                    fontWeight: 600,
                                    formatter: function (w) {
                                        return hasData ? w.globals.seriesTotals.reduce((a, b) => a + b, 0) : 0;
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: { enabled: false },
                legend: { position: 'bottom', fontSize: '12px', markers: { radius: 12 } },
                stroke: { width: 2, colors: ['#ffffff'] }
            };

            const chartCatEl = document.querySelector("#chart-sparepart-categories");
            if (chartCatEl) {
                chartCatEl.innerHTML = '';
                const chartCat = new ApexCharts(chartCatEl, donutOptions);
                chartCat.render();
            }
        }
    </script>
</div>
