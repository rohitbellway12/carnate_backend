<div class="carnate-profit-report-page">

    <style>
        .carnate-profit-report-page {
            --brand-red: #e53935;
            --brand-red-dark: #c62828;
            --brand-red-soft: #fff5f5;
            --brand-red-border: #fed7d7;
            
            --success-green: #10b981;
            --success-green-dark: #059669;
            --success-green-soft: #ecfdf5;
            --success-green-border: #a7f3d0;
            
            --warning-amber: #f59e0b;
            --warning-amber-soft: #fffbeb;
            --warning-amber-border: #fde68a;

            --info-indigo: #6366f1;
            --info-indigo-soft: #eef2ff;

            --dark-navy: #0f172a;
            --slate-text: #1e293b;
            --slate-muted: #64748b;
            --slate-light: #f8fafc;
            --slate-border: #e2e8f0;

            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: var(--slate-text);
        }

        /* ── Header Card ── */
        .pr-header-card {
            background: #ffffff;
            border: 1px solid var(--slate-border);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
            padding: 22px 26px;
            margin-bottom: 22px;
        }

        .pr-header-title-box {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .pr-header-icon {
            width: 48px;
            height: 48px;
            border-radius: 13px;
            background: linear-gradient(135deg, #e53935 0%, #b71c1c 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 14px rgba(229, 57, 53, 0.28);
            flex-shrink: 0;
        }

        .pr-main-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark-navy);
            margin: 0;
            letter-spacing: -0.3px;
        }

        .pr-main-subtitle {
            font-size: 13px;
            color: var(--slate-muted);
            margin: 3px 0 0;
        }

        /* ── Quick Filter Tabs ── */
        .pr-tabs-container {
            display: inline-flex;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 12px;
            border: 1px solid var(--slate-border);
        }

        .pr-tab-btn {
            border: none;
            background: transparent;
            padding: 7px 16px;
            font-size: 13px;
            font-weight: 600;
            color: var(--slate-muted);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .pr-tab-btn:hover {
            color: var(--slate-text);
        }

        .pr-tab-btn.active {
            background: #ffffff;
            color: var(--brand-red);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        /* ── Controls Row ── */
        .pr-controls-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid var(--slate-border);
        }

        .pr-date-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .pr-date-input-wrap i {
            position: absolute;
            left: 12px;
            color: var(--slate-muted);
            font-size: 13px;
            pointer-events: none;
        }

        .pr-date-input {
            height: 38px;
            padding: 6px 12px 6px 34px;
            border: 1px solid var(--slate-border);
            border-radius: 9px;
            background: #ffffff;
            font-size: 12.5px;
            font-weight: 500;
            color: var(--slate-text);
            transition: all 0.2s ease;
        }

        .pr-date-input:focus {
            border-color: var(--brand-red);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.12);
            outline: none;
        }

        .pr-btn-pdf {
            height: 38px;
            padding: 0 18px;
            background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
            color: #ffffff;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(229, 57, 53, 0.25);
            margin-left: auto;
        }

        .pr-btn-pdf:hover {
            background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
            box-shadow: 0 6px 16px rgba(229, 57, 53, 0.35);
            transform: translateY(-1px);
            color: #ffffff;
        }

        /* ── Top Summary / KPI Cards ── */
        .pr-kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        @media (max-width: 1200px) {
            .pr-kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .pr-kpi-grid {
                grid-template-columns: 1fr;
            }
        }

        .pr-kpi-card {
            background: #ffffff;
            border: 1px solid var(--slate-border);
            border-radius: 14px;
            padding: 18px 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
            transition: all 0.25s ease;
        }

        .pr-kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.07);
        }

        .pr-kpi-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .pr-kpi-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--slate-muted);
            margin: 0;
        }

        .pr-kpi-icon-bubble {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .pr-kpi-value {
            font-size: 25px;
            font-weight: 700;
            line-height: 1.15;
            color: var(--dark-navy);
            margin: 0 0 6px;
            letter-spacing: -0.5px;
        }

        .pr-kpi-subtext {
            font-size: 11.5px;
            color: var(--slate-muted);
            margin: 0;
        }

        /* Card color themes */
        .pr-kpi-card.sales {
            border-left: 4px solid var(--info-indigo);
        }
        .pr-kpi-card.sales .pr-kpi-icon-bubble {
            background: var(--info-indigo-soft);
            color: var(--info-indigo);
        }

        .pr-kpi-card.purchases {
            border-left: 4px solid var(--warning-amber);
        }
        .pr-kpi-card.purchases .pr-kpi-icon-bubble {
            background: var(--warning-amber-soft);
            color: var(--warning-amber);
        }

        .pr-kpi-card.expenses {
            border-left: 4px solid #ef4444;
        }
        .pr-kpi-card.expenses .pr-kpi-icon-bubble {
            background: #fee2e2;
            color: #ef4444;
        }

        .pr-kpi-card.profit {
            border-left: 4px solid var(--success-green);
        }
        .pr-kpi-card.profit.is-loss {
            border-left: 4px solid #dc2626;
        }
        .pr-kpi-card.profit .pr-kpi-icon-bubble {
            background: var(--success-green-soft);
            color: var(--success-green);
        }
        .pr-kpi-card.profit.is-loss .pr-kpi-icon-bubble {
            background: var(--brand-red-soft);
            color: var(--brand-red);
        }

        /* ── Two Column Formula Cards ── */
        .pr-formula-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        @media (max-width: 991px) {
            .pr-formula-grid {
                grid-template-columns: 1fr;
            }
        }

        .pr-breakdown-card {
            background: #ffffff;
            border: 1px solid var(--slate-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.03);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .pr-card-header {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--slate-border);
        }

        .pr-card-header.income-header {
            background: linear-gradient(180deg, #f0fdf4 0%, #ffffff 100%);
            border-top: 4px solid var(--success-green);
        }

        .pr-card-header.expense-header {
            background: linear-gradient(180deg, #fff5f5 0%, #ffffff 100%);
            border-top: 4px solid var(--brand-red);
        }

        .pr-card-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pr-badge-number {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
        }

        .pr-badge-number.green {
            background: var(--success-green-soft);
            color: var(--success-green-dark);
            border: 1px solid var(--success-green-border);
        }

        .pr-badge-number.red {
            background: var(--brand-red-soft);
            color: var(--brand-red);
            border: 1px solid var(--brand-red-border);
        }

        .pr-card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark-navy);
            margin: 0;
        }

        .pr-header-pill {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .pr-header-pill.green {
            background: var(--success-green-soft);
            color: var(--success-green-dark);
            border: 1px solid var(--success-green-border);
        }

        .pr-header-pill.red {
            background: var(--brand-red-soft);
            color: var(--brand-red);
            border: 1px solid var(--brand-red-border);
        }

        /* ── Rows inside breakdown ── */
        .pr-breakdown-body {
            padding: 14px 20px;
            flex-grow: 1;
        }

        .pr-line-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 11px 0;
            border-bottom: 1px dashed var(--slate-border);
        }

        .pr-line-item:last-child {
            border-bottom: none;
        }

        .pr-line-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .pr-line-bullet {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .pr-line-bullet.blue { background: #eff6ff; color: #2563eb; }
        .pr-line-bullet.teal { background: #f0fdfa; color: #0d9488; }
        .pr-line-bullet.purple { background: #faf5ff; color: #9333ea; }
        .pr-line-bullet.orange { background: #fff7ed; color: #ea580c; }
        .pr-line-bullet.rose { background: #fff1f2; color: #e11d48; }
        .pr-line-bullet.amber { background: #fefce8; color: #ca8a04; }
        .pr-line-bullet.gray { background: #f1f5f9; color: #475569; }

        .pr-line-name {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--slate-text);
            margin: 0;
        }

        .pr-line-subtext {
            font-size: 11px;
            color: var(--slate-muted);
            margin: 1px 0 0;
        }

        .pr-line-val {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark-navy);
            text-align: right;
        }

        /* ── Card Footer Total ── */
        .pr-card-footer {
            padding: 16px 20px;
            background: #f8fafc;
            border-top: 1px solid var(--slate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .pr-footer-label {
            font-size: 13.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--slate-muted);
            margin: 0;
        }

        .pr-footer-total {
            font-size: 20px;
            font-weight: 800;
            color: var(--dark-navy);
            letter-spacing: -0.3px;
        }

        .pr-footer-total.green { color: var(--success-green-dark); }
        .pr-footer-total.red { color: var(--brand-red); }

        /* ── Grand Profit Banner ── */
        .pr-profit-banner {
            border-radius: 16px;
            padding: 22px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            box-shadow: 0 6px 24px rgba(15, 23, 42, 0.05);
            border: 1px solid;
            position: relative;
            overflow: hidden;
        }

        .pr-profit-banner.is-profit {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border-color: var(--success-green-border);
        }

        .pr-profit-banner.is-loss {
            background: linear-gradient(135deg, #fff5f5 0%, #fee2e2 100%);
            border-color: var(--brand-red-border);
        }

        .pr-banner-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .pr-banner-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
        }

        .pr-profit-banner.is-profit .pr-banner-icon {
            background: #10b981;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);
        }

        .pr-profit-banner.is-loss .pr-banner-icon {
            background: #ef4444;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(239, 68, 68, 0.35);
        }

        .pr-banner-title {
            font-size: 20px;
            font-weight: 800;
            color: var(--dark-navy);
            margin: 0;
            letter-spacing: -0.3px;
        }

        .pr-banner-desc {
            font-size: 13px;
            color: var(--slate-muted);
            margin: 4px 0 0;
        }

        .pr-banner-right {
            text-align: right;
        }

        .pr-banner-amount {
            font-size: 32px;
            font-weight: 900;
            line-height: 1;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .pr-profit-banner.is-profit .pr-banner-amount {
            color: var(--success-green-dark);
        }

        .pr-profit-banner.is-loss .pr-banner-amount {
            color: #b91c1c;
        }

        .pr-banner-margin {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 12px;
            margin-top: 6px;
        }

        .pr-profit-banner.is-profit .pr-banner-margin {
            background: #10b981;
            color: #ffffff;
        }

        .pr-profit-banner.is-loss .pr-banner-margin {
            background: #ef4444;
            color: #ffffff;
        }

        /* ── Formula Card Info ── */
        .pr-formula-reminder {
            background: #ffffff;
            border: 1px solid var(--slate-border);
            border-radius: 12px;
            padding: 14px 20px;
            font-size: 12.5px;
            color: var(--slate-muted);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .pr-formula-reminder code {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            background: #f1f5f9;
            color: var(--dark-navy);
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>

    {{-- Main Container --}}
    <div class="container-fluid px-3 px-md-4 py-3">

        {{-- Header & Filters Card --}}
        <div class="pr-header-card">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="pr-header-title-box">
                    <div class="pr-header-icon">
                        <i class="fa fa-chart-pie"></i>
                    </div>
                    <div>
                        <h1 class="pr-main-title">Spare Part Vendor Profit & Loss Report</h1>
                        <p class="pr-main-subtitle">
                            Financial summary based on sales, direct inventory purchases, platform charges & expenses
                        </p>
                    </div>
                </div>

                {{-- Quick Filter Pills --}}
                <div class="pr-tabs-container">
                    <button type="button" 
                            wire:click="$set('filterType', 'daily')" 
                            class="pr-tab-btn {{ $filterType === 'daily' ? 'active' : '' }}">
                        <i class="fa fa-calendar-day me-1"></i> Today
                    </button>
                    <button type="button" 
                            wire:click="$set('filterType', 'weekly')" 
                            class="pr-tab-btn {{ $filterType === 'weekly' ? 'active' : '' }}">
                        <i class="fa fa-calendar-week me-1"></i> This Week
                    </button>
                    <button type="button" 
                            wire:click="$set('filterType', 'monthly')" 
                            class="pr-tab-btn {{ $filterType === 'monthly' ? 'active' : '' }}">
                        <i class="fa fa-calendar-alt me-1"></i> This Month
                    </button>
                    <button type="button" 
                            wire:click="$set('filterType', 'all')" 
                            class="pr-tab-btn {{ $filterType === 'all' ? 'active' : '' }}">
                        <i class="fa fa-infinity me-1"></i> All Time
                    </button>
                </div>
            </div>

            {{-- Date Inputs Row --}}
            <div class="pr-controls-row">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-muted small fw-semibold">Custom Period:</span>
                    <div class="pr-date-input-wrap">
                        <i class="fa fa-calendar"></i>
                        <input type="date" class="pr-date-input" wire:model.live="fromDate" placeholder="From Date">
                    </div>
                    <span class="text-muted small">to</span>
                    <div class="pr-date-input-wrap">
                        <i class="fa fa-calendar"></i>
                        <input type="date" class="pr-date-input" wire:model.live="toDate" placeholder="To Date">
                    </div>

                    @if($fromDate || $toDate)
                        <button type="button" wire:click="$set('filterType', 'monthly')" class="btn btn-sm btn-outline-secondary rounded-pill px-3 ms-2">
                            <i class="fa fa-times me-1"></i> Reset
                        </button>
                    @endif
                </div>

                {{-- Download PDF Button --}}
                <button type="button" wire:click="downloadPDF" wire:loading.attr="disabled" class="pr-btn-pdf">
                    <span wire:loading.remove wire:target="downloadPDF">
                        <i class="fa fa-file-pdf"></i> Download PDF Statement
                    </span>
                    <span wire:loading wire:target="downloadPDF">
                        <i class="fa fa-spinner fa-spin"></i> Generating PDF...
                    </span>
                </button>
            </div>
        </div>

        {{-- 4 KPI Top Summary Cards --}}
        <div class="pr-kpi-grid">
            {{-- 1. Total Sales --}}
            <div class="pr-kpi-card sales">
                <div class="pr-kpi-top">
                    <span class="pr-kpi-label">Total Revenue (1)</span>
                    <div class="pr-kpi-icon-bubble">
                        <i class="fa fa-cash-register"></i>
                    </div>
                </div>
                <h3 class="pr-kpi-value">₹{{ number_format($f['totalSales'], 2) }}</h3>
                <p class="pr-kpi-subtext">
                    Counter (₹{{ number_format($f['counterSale'], 2) }}) + Online (₹{{ number_format($f['onlineSale'], 2) }})
                </p>
            </div>

            {{-- 2. Total Purchases --}}
            <div class="pr-kpi-card purchases">
                <div class="pr-kpi-top">
                    <span class="pr-kpi-label">Inventory Purchases</span>
                    <div class="pr-kpi-icon-bubble">
                        <i class="fa fa-boxes-stacked"></i>
                    </div>
                </div>
                <h3 class="pr-kpi-value">₹{{ number_format($f['totalPurchases'], 2) }}</h3>
                <p class="pr-kpi-subtext">
                    {{ $f['poCount'] }} POs (Parts, Lubes, Acc., Tools)
                </p>
            </div>

            {{-- 3. Platform & Expenses --}}
            <div class="pr-kpi-card expenses">
                <div class="pr-kpi-top">
                    <span class="pr-kpi-label">Commission & Expenses</span>
                    <div class="pr-kpi-icon-bubble">
                        <i class="fa fa-receipt"></i>
                    </div>
                </div>
                <h3 class="pr-kpi-value">₹{{ number_format($f['platformCharges'] + $f['expenses'], 2) }}</h3>
                <p class="pr-kpi-subtext">
                    Commission: ₹{{ number_format($f['platformCharges'], 2) }} | Shop: ₹{{ number_format($f['expenses'], 2) }}
                </p>
            </div>

            {{-- 4. Net Profit / Loss --}}
            <div class="pr-kpi-card profit {{ !$f['isProfitable'] ? 'is-loss' : '' }}">
                <div class="pr-kpi-top">
                    <span class="pr-kpi-label">{{ $f['isProfitable'] ? 'Net Profit' : 'Net Loss' }}</span>
                    <div class="pr-kpi-icon-bubble">
                        <i class="fa {{ $f['isProfitable'] ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                    </div>
                </div>
                <h3 class="pr-kpi-value {{ $f['isProfitable'] ? 'text-success' : 'text-danger' }}">
                    ₹{{ number_format($f['netProfit'], 2) }}
                </h3>
                <p class="pr-kpi-subtext">
                    Margin: <strong>{{ $f['marginPercentage'] }}%</strong> (Sales - All Costs)
                </p>
            </div>
        </div>

        {{-- Grand Profit Banner --}}
        <div class="pr-profit-banner {{ $f['isProfitable'] ? 'is-profit' : 'is-loss' }}">
            <div class="pr-banner-left">
                <div class="pr-banner-icon">
                    <i class="fa {{ $f['isProfitable'] ? 'fa-coins' : 'fa-triangle-exclamation' }}"></i>
                </div>
                <div>
                    <h2 class="pr-banner-title">
                        {{ $f['isProfitable'] ? 'Net Profit Earned' : 'Net Loss Incurred' }}
                    </h2>
                    <p class="pr-banner-desc">
                        Calculation: [Total Sales: ₹{{ number_format($f['totalSales'], 2) }}] Less [Purchases + Commission + Expenses: ₹{{ number_format($f['totalExpenses'], 2) }}]
                    </p>
                </div>
            </div>
            <div class="pr-banner-right">
                <h2 class="pr-banner-amount">₹{{ number_format($f['netProfit'], 2) }}</h2>
                <div class="pr-banner-margin">
                    <i class="fa {{ $f['isProfitable'] ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                    {{ $f['marginPercentage'] }}% Net Margin
                </div>
            </div>
        </div>

        {{-- 2-Column Detailed Breakdown Cards --}}
        <div class="pr-formula-grid">

            {{-- ── COLUMN 1: REVENUE / SALES (1) ── --}}
            <div class="pr-breakdown-card">
                <div class="pr-card-header income-header">
                    <div class="pr-card-header-left">
                        <div class="pr-badge-number green">1</div>
                        <h4 class="pr-card-title">Total Sales Revenue</h4>
                    </div>
                    <span class="pr-header-pill green">Income (+)</span>
                </div>

                <div class="pr-breakdown-body">
                    {{-- Counter Sale --}}
                    <div class="pr-line-item">
                        <div class="pr-line-left">
                            <div class="pr-line-bullet blue">
                                <i class="fa fa-cash-register"></i>
                            </div>
                            <div>
                                <h5 class="pr-line-name">Counter Sale</h5>
                                <p class="pr-line-subtext">{{ $f['counterSaleCount'] }} Physical invoices generated</p>
                            </div>
                        </div>
                        <div class="pr-line-val text-primary">₹{{ number_format($f['counterSale'], 2) }}</div>
                    </div>

                    {{-- Online Sale --}}
                    <div class="pr-line-item">
                        <div class="pr-line-left">
                            <div class="pr-line-bullet teal">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div>
                                <h5 class="pr-line-name">Online Sale</h5>
                                <p class="pr-line-subtext">{{ $f['onlineOrdersCount'] }} Confirmed/Delivered online orders</p>
                            </div>
                        </div>
                        <div class="pr-line-val text-teal">₹{{ number_format($f['onlineSale'], 2) }}</div>
                    </div>
                </div>

                <div class="pr-card-footer">
                    <span class="pr-footer-label">Total Sales (1)</span>
                    <span class="pr-footer-total green">₹{{ number_format($f['totalSales'], 2) }}</span>
                </div>
            </div>

            {{-- ── COLUMN 2: COSTS & DEDUCTIONS (2) ── --}}
            <div class="pr-breakdown-card">
                <div class="pr-card-header expense-header">
                    <div class="pr-card-header-left">
                        <div class="pr-badge-number red">2</div>
                        <h4 class="pr-card-title">Purchases, Commission & Expenses</h4>
                    </div>
                    <span class="pr-header-pill red">Deductions (-)</span>
                </div>

                <div class="pr-breakdown-body">
                    {{-- Parts Purchase --}}
                    <div class="pr-line-item">
                        <div class="pr-line-left">
                            <div class="pr-line-bullet purple">
                                <i class="fa fa-gears"></i>
                            </div>
                            <div>
                                <h5 class="pr-line-name">Parts Purchase</h5>
                                <p class="pr-line-subtext">Spare parts purchase cost (Category 2)</p>
                            </div>
                        </div>
                        <div class="pr-line-val">₹{{ number_format($f['partsPurchase'], 2) }}</div>
                    </div>

                    {{-- Lubes Purchase --}}
                    <div class="pr-line-item">
                        <div class="pr-line-left">
                            <div class="pr-line-bullet orange">
                                <i class="fa fa-oil-can"></i>
                            </div>
                            <div>
                                <h5 class="pr-line-name">Lubes Purchase</h5>
                                <p class="pr-line-subtext">Lubricants & oils purchase cost (Category 4)</p>
                            </div>
                        </div>
                        <div class="pr-line-val">₹{{ number_format($f['lubesPurchase'], 2) }}</div>
                    </div>

                    {{-- Accessory Purchase --}}
                    <div class="pr-line-item">
                        <div class="pr-line-left">
                            <div class="pr-line-bullet rose">
                                <i class="fa fa-car-battery"></i>
                            </div>
                            <div>
                                <h5 class="pr-line-name">Accessory Purchase</h5>
                                <p class="pr-line-subtext">Car accessories purchase cost (Category 1)</p>
                            </div>
                        </div>
                        <div class="pr-line-val">₹{{ number_format($f['accessoryPurchase'], 2) }}</div>
                    </div>

                    {{-- Tools Purchase --}}
                    <div class="pr-line-item">
                        <div class="pr-line-left">
                            <div class="pr-line-bullet amber">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <div>
                                <h5 class="pr-line-name">Tools Purchase</h5>
                                <p class="pr-line-subtext">Tools & garage equipment purchase cost (Category 3)</p>
                            </div>
                        </div>
                        <div class="pr-line-val">₹{{ number_format($f['toolsPurchase'], 2) }}</div>
                    </div>

                    {{-- Platform Charges (Commission) --}}
                    <div class="pr-line-item">
                        <div class="pr-line-left">
                            <div class="pr-line-bullet gray">
                                <i class="fa fa-percent"></i>
                            </div>
                            <div>
                                <h5 class="pr-line-name">Platform Charges (Commission)</h5>
                                <p class="pr-line-subtext">Carnate platform fee on online orders</p>
                            </div>
                        </div>
                        <div class="pr-line-val text-danger">₹{{ number_format($f['platformCharges'], 2) }}</div>
                    </div>

                    {{-- Shop Expenses --}}
                    <div class="pr-line-item">
                        <div class="pr-line-left">
                            <div class="pr-line-bullet gray">
                                <i class="fa fa-file-invoice-dollar"></i>
                            </div>
                            <div>
                                <h5 class="pr-line-name">Shop Expenses</h5>
                                <p class="pr-line-subtext">{{ $f['expensesCount'] }} General expenses (rent, electricity, staff, etc.)</p>
                            </div>
                        </div>
                        <div class="pr-line-val text-danger">₹{{ number_format($f['expenses'], 2) }}</div>
                    </div>
                </div>

                <div class="pr-card-footer">
                    <span class="pr-footer-label">Total Cost & Expenses (2)</span>
                    <span class="pr-footer-total red">₹{{ number_format($f['totalExpenses'], 2) }}</span>
                </div>
            </div>

        </div>

        {{-- Formula Reminder Note --}}
        <div class="pr-formula-reminder">
            <div>
                <i class="fa fa-info-circle text-primary me-2"></i>
                <strong>Accounting Formula Applied:</strong>
                <code>1 Total (Counter + Online Sale) - 2 Total (Purchases + Commission + Expenses) = Profit</code>
            </div>
            <span class="text-muted small">Updated in Real-Time</span>
        </div>

    </div>

</div>

