<div class="carnate-dashboard-wrapper">
    <style>
        .carnate-dashboard-wrapper {
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

        /* Subscription Banner */
        .sub-banner {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border: 1px solid #fde68a;
            color: #92400e;
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
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
        .kpi-card.active-jobs::after { background: var(--brand-red); }
        .kpi-card.completed::after { background: var(--brand-blue); }
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

        .status-badge.open { background: #e0f2fe; color: #0284c7; }
        .status-badge.process { background: #fef3c7; color: #d97706; }
        .status-badge.confirmed { background: #f3e8ff; color: #7e22ce; }
        .status-badge.completed { background: #dcfce7; color: #16a34a; }
        .status-badge.closed { background: #f1f5f9; color: #475569; }

        .veh-plate-badge {
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

        .veh-model-name {
            font-weight: 600;
            color: var(--brand-slate);
            font-size: 13px;
            margin-top: 3px;
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

        /* Appointment / Inventory List Items */
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

    {{-- 1. Dashboard Header & Quick Action Shortcuts --}}
    <div class="dash-header-card">
        <div class="dash-title-group">
            <h3><i class="bx bx-tachometer text-danger"></i> Workshop Command Center</h3>
            <p>Real-time overview of bays, revenue, active job cards & inventory</p>
        </div>

        <div class="quick-action-btns">
            <a href="{{ route('workshop.jobcardadd') }}" class="btn-quick-primary">
                <i class="bx bx-plus-circle"></i> + New Job Card
            </a>
            <a href="{{ route('workshop.addcountersale') }}" class="btn-quick-secondary">
                <i class="bx bx-cart-add"></i> + Counter Sale
            </a>
            <a href="{{ route('workshop.appointments') }}" class="btn-quick-secondary">
                <i class="bx bx-calendar-plus"></i> Appointments
            </a>
            <a href="{{ route('workshop.productstock') }}" class="btn-quick-secondary">
                <i class="bx bx-package"></i> Manage Stock
            </a>
        </div>
    </div>

    {{-- Subscription Expiry Warning --}}
    @if ($message)
        <div class="sub-banner">
            <i class="bx bx-error-circle fs-5"></i>
            <div>{{ $message }}</div>
        </div>
    @endif

    {{-- 2. Top 4 High-Impact KPI Cards --}}
    <div class="row g-3 mb-4">
        {{-- Card 1: Monthly Revenue (Profit & Loss Match) --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card revenue">
                <div class="kpi-header">
                    <span class="kpi-label">This Month Revenue</span>
                    <div class="kpi-icon-box green">
                        <i class="bx bx-rupee"></i>
                    </div>
                </div>
                <h2 class="kpi-value">₹{{ number_format($monthlyRevenue) }}</h2>
                <div class="kpi-meta">
                    @if ($inProcessEstimatedRevenue > 0)
                        <span class="kpi-badge info" title="Estimated value of vehicles currently being repaired in bays">
                            ₹{{ number_format($inProcessEstimatedRevenue) }} In-Process
                        </span>
                    @else
                        @if ($revenueGrowthPercent >= 0)
                            <span class="kpi-badge up"><i class="bx bx-trending-up"></i> +{{ $revenueGrowthPercent }}%</span>
                        @else
                            <span class="kpi-badge warn"><i class="bx bx-trending-down"></i> {{ $revenueGrowthPercent }}%</span>
                        @endif
                    @endif
                    <span>(Completed / Closed)</span>
                </div>
            </div>
        </div>

        {{-- Card 2: Active In-Bay Vehicles --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card active-jobs">
                <div class="kpi-header">
                    <span class="kpi-label">Vehicles In Workshop</span>
                    <div class="kpi-icon-box red">
                        <i class="bx bx-car"></i>
                    </div>
                </div>
                <h2 class="kpi-value">{{ $activeJobsCount }} <span style="font-size: 15px; font-weight: 600; color: var(--brand-muted);">Cars</span></h2>
                <div class="kpi-meta">
                    <span class="kpi-badge info">{{ $processJobsCount }} In-Process</span>
                    <span>{{ $openJobsCount }} Open · {{ $confirmedJobsCount }} Confirmed</span>
                </div>
            </div>
        </div>

        {{-- Card 3: Completed & Ready Jobs --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card completed">
                <div class="kpi-header">
                    <span class="kpi-label">Completed This Month</span>
                    <div class="kpi-icon-box blue">
                        <i class="bx bx-check-double"></i>
                    </div>
                </div>
                <h2 class="kpi-value">{{ $completedThisMonth }} <span style="font-size: 15px; font-weight: 600; color: var(--brand-muted);">Jobs</span></h2>
                <div class="kpi-meta">
                    <span>Total All-Time: <strong>{{ $totalJobCards }}</strong> Job Cards</span>
                </div>
            </div>
        </div>

        {{-- Card 4: Appointments & Low Stock Alert --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card alerts">
                <div class="kpi-header">
                    <span class="kpi-label">Upcoming / Alerts</span>
                    <div class="kpi-icon-box amber">
                        <i class="bx bx-bell"></i>
                    </div>
                </div>
                <h2 class="kpi-value">{{ $upcomingAppointmentsCount }} <span style="font-size: 15px; font-weight: 600; color: var(--brand-muted);">Appointments</span></h2>
                <div class="kpi-meta">
                    @if ($lowStockCount > 0)
                        <span class="kpi-badge warn"><i class="bx bx-error"></i> {{ $lowStockCount }} items low</span>
                        <span>in inventory</span>
                    @else
                        <span class="kpi-badge up">Inventory Healthy</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Visual Interactive Analytics & Charts --}}
    <div class="row g-3 mb-4">
        {{-- Revenue & Job Volume Trend Chart --}}
        <div class="col-12 col-xl-8">
            <div class="dash-panel h-100 mb-0">
                <div class="panel-header">
                    <h5 class="panel-title">
                        <i class="bx bx-bar-chart-alt-2"></i> Revenue & Workload Trend (Last 6 Months)
                    </h5>
                    <span class="badge bg-light text-dark border">Billed (₹) & Job Cards</span>
                </div>
                <div class="panel-body">
                    <div id="chart-revenue-trend" style="min-height: 290px;"></div>
                </div>
            </div>
        </div>

        {{-- Job Status Distribution Donut Chart --}}
        <div class="col-12 col-xl-4">
            <div class="dash-panel h-100 mb-0">
                <div class="panel-header">
                    <h5 class="panel-title">
                        <i class="bx bx-pie-chart-alt-2"></i> Job Card Stages
                    </h5>
                    <span class="badge bg-light text-dark border">Live Split</span>
                </div>
                <div class="panel-body">
                    <div id="chart-job-stages" style="min-height: 290px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. Live Workshop Operations (Floor Control) --}}
    <div class="row g-3">
        {{-- Left: Live In-Bay Vehicles Table --}}
        <div class="col-12 col-xl-8">
            <div class="dash-panel mb-0 h-100">
                <div class="panel-header">
                    <h5 class="panel-title">
                        <i class="bx bx-wrench"></i> Vehicles Currently in Workshop Bays
                    </h5>
                    <a href="{{ route('workshop.jobcard') }}" class="panel-link">
                        View All Job Cards <i class="bx bx-chevron-right"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="dash-table">
                        <thead>
                            <tr>
                                <th>Vehicle Info</th>
                                <th>Job Card / Customer</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activeJobCards as $jc)
                                <tr>
                                    <td>
                                        <span class="veh-plate-badge">{{ $jc->vehical_number ?: 'NO-PLATE' }}</span>
                                        <div class="veh-model-name">{{ Str::limit($jc->vehical ?: ($jc->vehicle->modelname ?? 'Vehicle'), 25) }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; color: #1e293b;">
                                            {{ $jc->jobcard_number ?: '#' . $jc->id }}
                                        </div>
                                        <div class="text-muted" style="font-size: 12px;">
                                            <i class="bx bx-user"></i> {{ Str::limit($jc->customer_name ?: ($jc->customer->name ?? 'Customer'), 18) }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($jc->status == 0)
                                            <span class="status-badge open"><i class="bx bx-time"></i> Open</span>
                                        @elseif ($jc->status == 4)
                                            <span class="status-badge process"><i class="bx bx-cog bx-spin"></i> Process</span>
                                        @elseif ($jc->status == 1)
                                            <span class="status-badge confirmed"><i class="bx bx-check"></i> Confirmed</span>
                                        @elseif ($jc->status == 2)
                                            <span class="status-badge completed"><i class="bx bx-check-circle"></i> Ready</span>
                                        @else
                                            <span class="status-badge closed">Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; color: #0f172a;">
                                            ₹{{ number_format((float)($jc->final_amount ?: $jc->amount)) }}
                                        </div>
                                        <div class="text-muted" style="font-size: 11px;">
                                            {{ \Carbon\Carbon::parse($jc->created_at)->format('d M, h:i A') }}
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('workshop.jobcardedit', ['id' => $jc->id]) }}" 
                                           class="action-icon-btn" 
                                           title="Open / Edit Job Card">
                                            <i class="bx bx-right-arrow-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state-box">
                                            <i class="bx bx-check-shield"></i>
                                            <p>No active vehicles in bays right now. All caught up!</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Right: Appointments & Low Stock Alerts --}}
        <div class="col-12 col-xl-4">
            <div class="d-flex flex-column gap-3 h-100">
                {{-- Upcoming Appointments Card --}}
                <div class="dash-panel mb-0">
                    <div class="panel-header">
                        <h5 class="panel-title">
                            <i class="bx bx-calendar-event"></i> Upcoming Visits
                        </h5>
                        <a href="{{ route('workshop.appointments') }}" class="panel-link">Manage</a>
                    </div>
                    <div class="panel-body">
                        @forelse ($upcomingAppointments as $app)
                            <div class="mini-list-item">
                                <div>
                                    <h6 class="mini-item-title">{{ $app->customer_name ?: 'Customer' }}</h6>
                                    <div class="mini-item-sub">
                                        <i class="bx bx-car"></i> {{ $app->vehicle_number_plate ?: 'No vehicle' }} · 
                                        <span class="text-danger font-monospace">{{ $app->appointment_time ?: 'Morning' }}</span>
                                    </div>
                                </div>
                                <span class="badge bg-light text-dark border">
                                    {{ \Carbon\Carbon::parse($app->appointment_date)->format('d M') }}
                                </span>
                            </div>
                        @empty
                            <div class="empty-state-box py-3">
                                <i class="bx bx-calendar-check" style="font-size: 28px;"></i>
                                <p style="font-size: 12px;">No pending customer visits for today.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Low Stock Inventory Alert Card --}}
                <div class="dash-panel mb-0 flex-grow-1">
                    <div class="panel-header">
                        <h5 class="panel-title">
                            <i class="bx bx-error text-danger"></i> Low Stock Alerts
                        </h5>
                        <a href="{{ route('workshop.productstock') }}" class="panel-link">Order Stock</a>
                    </div>
                    <div class="panel-body">
                        @forelse ($lowStockItems as $item)
                            <div class="mini-list-item">
                                <div>
                                    <h6 class="mini-item-title">{{ Str::limit($item->part_number ?: ($item->category ?? 'Spare Part'), 22) }}</h6>
                                    <div class="mini-item-sub">
                                        {{ $item->brand ?: 'Standard' }} · Price: ₹{{ number_format((float)$item->price) }}
                                    </div>
                                </div>
                                <div>
                                    @if ($item->stock <= 0)
                                        <span class="badge bg-danger">Out of Stock</span>
                                    @else
                                        <span class="badge bg-warning text-dark">{{ $item->stock }} Left</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="empty-state-box py-3">
                                <i class="bx bx-check-circle text-success" style="font-size: 28px;"></i>
                                <p style="font-size: 12px;">All spare parts stock levels are sufficient!</p>
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
            initWorkshopCharts();
        });

        // Also re-init if Livewire updates
        document.addEventListener('livewire:navigated', function () {
            initWorkshopCharts();
        });

        function initWorkshopCharts() {
            if (typeof ApexCharts === 'undefined') {
                return;
            }

            // 1. Revenue & Job Volume Trend Chart
            const trendMonths = @json($trendMonths);
            const trendRevenues = @json($trendRevenues);
            const trendJobs = @json($trendJobs);

            const trendOptions = {
                series: [{
                    name: 'Revenue (₹)',
                    type: 'area',
                    data: trendRevenues
                }, {
                    name: 'Job Cards Count',
                    type: 'column',
                    data: trendJobs
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
                colors: ['#e53935', '#0ea5e9'],
                labels: trendMonths,
                markers: {
                    size: [4, 0]
                },
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
                        text: 'Job Cards',
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
                                return seriesIndex === 0 ? '₹' + Number(y).toLocaleString('en-IN') : y + ' Jobs';
                            }
                            return y;
                        }
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right'
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4
                }
            };

            const chartTrendEl = document.querySelector("#chart-revenue-trend");
            if (chartTrendEl) {
                chartTrendEl.innerHTML = '';
                const chartTrend = new ApexCharts(chartTrendEl, trendOptions);
                chartTrend.render();
            }

            // 2. Job Stages Donut Chart
            const statusLabels = @json($statusLabels);
            const statusSeries = @json($statusSeries);

            // Check if series has any non-zero value
            const hasData = statusSeries.some(val => val > 0);
            const donutSeries = hasData ? statusSeries : [1, 1, 1, 1, 1];
            const donutLabels = hasData ? statusLabels : ['Open', 'In Process', 'Confirmed', 'Completed', 'Closed'];

            const donutOptions = {
                series: donutSeries,
                labels: donutLabels,
                chart: {
                    type: 'donut',
                    height: 290,
                    fontFamily: 'inherit'
                },
                colors: ['#38bdf8', '#f59e0b', '#a855f7', '#22c55e', '#64748b'],
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
                                    formatter: function (val) {
                                        return val;
                                    }
                                },
                                total: {
                                    show: true,
                                    label: 'Total Jobs',
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
                legend: {
                    position: 'bottom',
                    fontSize: '12px',
                    markers: { radius: 12 }
                },
                stroke: { width: 2, colors: ['#ffffff'] }
            };

            const chartStagesEl = document.querySelector("#chart-job-stages");
            if (chartStagesEl) {
                chartStagesEl.innerHTML = '';
                const chartStages = new ApexCharts(chartStagesEl, donutOptions);
                chartStages.render();
            }
        }
    </script>
</div>
