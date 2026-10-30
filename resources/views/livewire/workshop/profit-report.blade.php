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
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
        }

        /* ── Export Button ── */
        .btn-export-pdf {
            background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
            color: #ffffff !important;
            font-weight: 600;
            font-size: 13px;
            padding: 9px 18px;
            border-radius: 10px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(229, 57, 53, 0.25);
            transition: all 0.2s;
        }

        .btn-export-pdf:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(229, 57, 53, 0.35);
        }

        /* ── Top 4 KPI Cards ── */
        .pr-metric-card {
            background: #ffffff;
            border: 1px solid var(--slate-border);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
            padding: 20px 22px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .pr-metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        }

        .pr-metric-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .pr-metric-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: var(--slate-muted);
        }

        .pr-metric-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .icon-sales { background: var(--success-green-soft); color: var(--success-green); }
        .icon-cogs { background: var(--warning-amber-soft); color: var(--warning-amber); }
        .icon-expenses { background: var(--brand-red-soft); color: var(--brand-red); }
        .icon-profit { background: var(--info-indigo-soft); color: var(--info-indigo); }

        .pr-metric-val {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin: 0 0 6px;
            color: var(--dark-navy);
        }

        .pr-metric-footer {
            font-size: 12px;
            color: var(--slate-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .badge-pill-soft {
            display: inline-flex;
            align-items: center;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        /* Hero Profit Card */
        .pr-metric-card.hero-profit {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border-color: #334155;
            color: #ffffff;
        }
        .pr-metric-card.hero-profit .pr-metric-title { color: #94a3b8; }
        .pr-metric-card.hero-profit .pr-metric-val { color: #10b981; }
        .pr-metric-card.hero-profit.negative .pr-metric-val { color: #f87171; }
        .pr-metric-card.hero-profit .pr-metric-footer { color: #cbd5e1; }

        /* ── Formula Cards Section ── */
        .pr-formula-box {
            background: #ffffff;
            border: 1px solid var(--slate-border);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .pr-formula-header {
            background: #ffffff;
            border-bottom: 1.5px solid var(--slate-border);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pr-formula-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .badge-income-title {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .badge-cost-title {
            background: #fff5f5;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .pr-formula-col {
            padding: 24px 26px;
        }

        .pr-formula-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid #f1f5f9;
            margin-bottom: 10px;
            transition: all 0.15s;
        }

        .pr-formula-row:hover {
            background: #f8fafc;
            border-color: #e2e8f0;
            transform: translateX(2px);
        }

        .pr-item-name {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--slate-text);
        }

        .pr-item-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .pr-item-price {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark-navy);
        }

        /* Total Summaries */
        .pr-total-bar {
            padding: 16px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 16px;
        }

        .pr-total-bar.income-total {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border: 1.5px solid #a7f3d0;
            color: #065f46;
        }

        .pr-total-bar.expense-total {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe4e6 100%);
            border: 1.5px solid #fecdd3;
            color: #9f1239;
        }

        /* ── Final Equation Banner ── */
        .pr-equation-banner {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            padding: 22px 28px;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            border-top: 1px solid #334155;
        }

        .equation-left {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .eq-pill {
            padding: 8px 16px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
        }
        .eq-pill.sales-pill { background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); }
        .eq-pill.costs-pill { background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); }

        .eq-pill-label { font-size: 11px; text-transform: uppercase; font-weight: 700; color: #94a3b8; }
        .eq-pill-val { font-size: 16px; font-weight: 800; color: #ffffff; }

        .eq-sign {
            font-size: 22px;
            font-weight: 800;
            color: #94a3b8;
        }

        .profit-right-box {
            text-align: right;
        }

        .profit-final-val {
            font-size: 30px;
            font-weight: 900;
            letter-spacing: -0.5px;
            color: #10b981;
            margin: 0;
        }
        .profit-final-val.negative { color: #f87171; }

        /* ── Table Styling ── */
        .pr-table-card {
            background: #ffffff;
            border: 1px solid var(--slate-border);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }

        .pr-table-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--slate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
        }

        .pr-table thead th {
            background: #f8fafc;
            color: var(--slate-muted);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 13px 18px;
            border-bottom: 1.5px solid var(--slate-border);
            white-space: nowrap;
        }

        .pr-table tbody td {
            padding: 14px 18px;
            font-size: 13.5px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .pr-table tbody tr:hover {
            background-color: #f8fafc;
        }
    </style>

    {{-- ════════════════════ HEADER SECTION ════════════════════ --}}
    <div class="pr-header-card">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="pr-header-title-box">
                <div class="pr-header-icon">
                    <i class="bx bx-pie-chart-alt-2"></i>
                </div>
                <div>
                    <h1 class="pr-main-title">Workshop Profit & Loss Report</h1>
                    <p class="pr-main-subtitle">
                        Accurate financial balance sheet: <strong>Total Sales (1)</strong> Less <strong>Purchases & Expenses (2)</strong> = <strong>Net Profit</strong>
                    </p>
                </div>
            </div>

            <div>
                <button type="button" class="btn-export-pdf" wire:click="downloadPDF" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="downloadPDF">
                        <i class="bx bxs-file-pdf fs-5"></i> Export PDF Statement
                    </span>
                    <span wire:loading wire:target="downloadPDF">
                        <span class="spinner-border spinner-border-sm me-1"></span> Preparing PDF...
                    </span>
                </button>
            </div>
        </div>

        <hr class="my-3" style="border-color: #f1f5f9;">

        {{-- Date Filters Bar --}}
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-2">
                <span class="font-12 fw-bold text-muted text-uppercase me-1"><i class="bx bx-calendar me-1"></i>Period:</span>
                <div class="pr-tabs-container">
                    <button type="button" class="pr-tab-btn {{ $filterType === 'daily' ? 'active' : '' }}" wire:click="$set('filterType', 'daily')">
                        Today
                    </button>
                    <button type="button" class="pr-tab-btn {{ $filterType === 'weekly' ? 'active' : '' }}" wire:click="$set('filterType', 'weekly')">
                        This Week
                    </button>
                    <button type="button" class="pr-tab-btn {{ $filterType === 'monthly' ? 'active' : '' }}" wire:click="$set('filterType', 'monthly')">
                        This Month
                    </button>
                    <button type="button" class="pr-tab-btn {{ $filterType === 'all' ? 'active' : '' }}" wire:click="$set('filterType', 'all')">
                        All Time
                    </button>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="input-group input-group-sm" style="max-width: 175px;">
                    <span class="input-group-text bg-white text-muted border-end-0"><i class="bx bx-calendar-event"></i></span>
                    <input type="date" class="form-control border-start-0 ps-1" wire:model.live="fromDate" title="From Date">
                </div>
                <span class="text-muted fw-bold font-13">—</span>
                <div class="input-group input-group-sm" style="max-width: 175px;">
                    <span class="input-group-text bg-white text-muted border-end-0"><i class="bx bx-calendar-event"></i></span>
                    <input type="date" class="form-control border-start-0 ps-1" wire:model.live="toDate" title="To Date">
                </div>
            </div>
        </div>
    </div>

    {{-- ════════════════════ TOP 4 KPI METRIC CARDS ════════════════════ --}}
    <div class="row g-3 mb-4">
        {{-- Card 1: Total Sales --}}
        <div class="col-xl-3 col-md-6">
            <div class="pr-metric-card">
                <div class="pr-metric-top">
                    <span class="pr-metric-title">1) Total Sales (Revenue)</span>
                    <div class="pr-metric-icon icon-sales">
                        <i class="bx bx-trending-up"></i>
                    </div>
                </div>
                <h2 class="pr-metric-val">₹{{ number_format($financials['sales']['total'], 2) }}</h2>
                <div class="pr-metric-footer">
                    <span class="badge-pill-soft icon-sales">
                        <i class="bx bx-check me-1"></i>{{ $financials['jobcards_count'] }} JobCards Billed
                    </span>
                </div>
            </div>
        </div>

        {{-- Card 2: Purchases & Outsource Cost --}}
        <div class="col-xl-3 col-md-6">
            <div class="pr-metric-card">
                <div class="pr-metric-top">
                    <span class="pr-metric-title">2) Direct Purchases (Cost)</span>
                    <div class="pr-metric-icon icon-cogs">
                        <i class="bx bx-cart"></i>
                    </div>
                </div>
                <h2 class="pr-metric-val">₹{{ number_format($financials['costs']['direct_total'], 2) }}</h2>
                <div class="pr-metric-footer">
                    <span class="badge-pill-soft icon-cogs">
                        Parts, Lubes, Acc, Tools & Outsource
                    </span>
                </div>
            </div>
        </div>

        {{-- Card 3: Workshop Expenses --}}
        <div class="col-xl-3 col-md-6">
            <div class="pr-metric-card">
                <div class="pr-metric-top">
                    <span class="pr-metric-title">Workshop Expenses</span>
                    <div class="pr-metric-icon icon-expenses">
                        <i class="bx bx-receipt"></i>
                    </div>
                </div>
                <h2 class="pr-metric-val">₹{{ number_format($financials['costs']['expenses'], 2) }}</h2>
                <div class="pr-metric-footer">
                    <span class="badge-pill-soft icon-expenses">
                        Rent, electricity, tea, staff overheads
                    </span>
                </div>
            </div>
        </div>

        {{-- Card 4: Net Profit Hero --}}
        <div class="col-xl-3 col-md-6">
            <div class="pr-metric-card hero-profit {{ $financials['net_profit'] < 0 ? 'negative' : '' }}">
                <div class="pr-metric-top">
                    <span class="pr-metric-title">Net Profit (1 — 2)</span>
                    <div class="pr-metric-icon icon-profit" style="background: rgba(255,255,255,0.1); color:#34d399;">
                        <i class="bx bx-shield-quarter"></i>
                    </div>
                </div>
                <h2 class="pr-metric-val">₹{{ number_format($financials['net_profit'], 2) }}</h2>
                <div class="pr-metric-footer">
                    <span>Profit Margin:</span>
                    <span class="badge" style="background: rgba(16,185,129,0.2); color:#34d399; font-weight:700;">
                        {{ $financials['profit_margin'] }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ════════════════════ FORMULA BREAKDOWN SECTION ════════════════════ --}}
    <div class="pr-formula-box">
        <div class="pr-formula-header">
            <div class="d-flex align-items-center gap-2">
                <div style="width:32px;height:32px;background:#f8fafc;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#475569;border:1px solid #e2e8f0;">
                    <i class="bx bx-calculator fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold font-15 mb-0 text-dark">Statement Breakdown Formula</h5>
                    <span class="font-12 text-muted">1) Sales Revenue &nbsp;—&nbsp; 2) Purchases & Expenses &nbsp;=&nbsp; Net Profit</span>
                </div>
            </div>

            <div>
                <span class="badge bg-light text-dark border font-12 px-3 py-2">
                    <i class="bx bx-info-circle me-1 text-primary"></i> Real-time synchronized with JobCards & Expenses
                </span>
            </div>
        </div>

        <div class="row g-0">
            {{-- ── LEFT PANEL: 1) SALES / REVENUE BREAKDOWN ── --}}
            <div class="col-lg-6 border-end pr-formula-col">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                    <span class="pr-formula-badge badge-income-title">
                        <i class="bx bx-plus-circle"></i> 1) Sales / Revenue Breakdown
                    </span>
                    <span class="font-12 text-muted fw-bold">Customer Billed Amount</span>
                </div>

                {{-- Item 1: Labour charges --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#eff6ff;color:#3b82f6;">
                            <i class="bx bx-wrench"></i>
                        </div>
                        <div>
                            <div>Labour charges</div>
                            <small class="text-muted font-11">In-house mechanic service billing</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-success">+ ₹{{ number_format($financials['sales']['labour_charges'], 2) }}</span>
                </div>

                {{-- Item 2: Parts sale --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#f5f3ff;color:#8b5cf6;">
                            <i class="bx bx-cog"></i>
                        </div>
                        <div>
                            <div>Parts sale</div>
                            <small class="text-muted font-11">Spare parts billed on JobCards & Counter</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-success">+ ₹{{ number_format($financials['sales']['parts_sale'], 2) }}</span>
                </div>

                {{-- Item 3: Lubes sale --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#fffbeb;color:#d97706;">
                            <i class="bx bx-droplet"></i>
                        </div>
                        <div>
                            <div>Lubes sale</div>
                            <small class="text-muted font-11">Engine oil, gear oil & fluids sale</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-success">+ ₹{{ number_format($financials['sales']['lubes_sale'], 2) }}</span>
                </div>

                {{-- Item 4: Accessory sale --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#fdf2f8;color:#db2777;">
                            <i class="bx bx-customize"></i>
                        </div>
                        <div>
                            <div>Accessory sale</div>
                            <small class="text-muted font-11">Vehicle styling & fitment accessories</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-success">+ ₹{{ number_format($financials['sales']['accessory_sale'], 2) }}</span>
                </div>

                {{-- Item 5: Tools sale --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#f0fdfa;color:#0d9488;">
                            <i class="bx bx-box"></i>
                        </div>
                        <div>
                            <div>Tools sale</div>
                            <small class="text-muted font-11">Equipment & specialized tools</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-success">+ ₹{{ number_format($financials['sales']['tools_sale'], 2) }}</span>
                </div>

                {{-- Item 6: Outsource sale --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#e0e7ff;color:#4f46e5;">
                            <i class="bx bx-user-check"></i>
                        </div>
                        <div>
                            <div>Outsource sale</div>
                            <small class="text-muted font-11">External jobs billed to customer (lathe, ac, etc.)</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-success">+ ₹{{ number_format($financials['sales']['outsource_sale'], 2) }}</span>
                </div>

                {{-- 1) Total Sales Bar --}}
                <div class="pr-total-bar income-total">
                    <div>
                        <span class="fw-bold font-15">1) Total Sales</span>
                        <div class="font-11 text-muted">Sum of all 6 revenue items</div>
                    </div>
                    <span class="fw-bold font-20">₹{{ number_format($financials['sales']['total'], 2) }}</span>
                </div>
            </div>

            {{-- ── RIGHT PANEL: 2) PURCHASES & EXPENSES BREAKDOWN (LESS) ── --}}
            <div class="col-lg-6 pr-formula-col">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                    <span class="pr-formula-badge badge-cost-title">
                        <i class="bx bx-minus-circle"></i> 2) Purchases & Expenses Breakdown (Less)
                    </span>
                    <span class="font-12 text-muted fw-bold">Actual Cost to Workshop</span>
                </div>

                {{-- Item 1: Parts purchase --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#fee2e2;color:#dc2626;">
                            <i class="bx bx-cog"></i>
                        </div>
                        <div>
                            <div>Parts purchase</div>
                            <small class="text-muted font-11">Purchase price of parts consumed in jobs</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-danger">— ₹{{ number_format($financials['costs']['parts_purchase'], 2) }}</span>
                </div>

                {{-- Item 2: Lubes purchase --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#fef3c7;color:#b45309;">
                            <i class="bx bx-droplet"></i>
                        </div>
                        <div>
                            <div>Lubes purchase</div>
                            <small class="text-muted font-11">Purchase cost of engine oil & lubricants</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-danger">— ₹{{ number_format($financials['costs']['lubes_purchase'], 2) }}</span>
                </div>

                {{-- Item 3: Accessory purchase --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#fce7f3;color:#be185d;">
                            <i class="bx bx-customize"></i>
                        </div>
                        <div>
                            <div>Accessory purchase</div>
                            <small class="text-muted font-11">Purchase cost of accessories used</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-danger">— ₹{{ number_format($financials['costs']['accessory_purchase'], 2) }}</span>
                </div>

                {{-- Item 4: Tools purchase --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#ccfbf1;color:#0f766e;">
                            <i class="bx bx-box"></i>
                        </div>
                        <div>
                            <div>Tools purchase</div>
                            <small class="text-muted font-11">Tooling & equipment replacement costs</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-danger">— ₹{{ number_format($financials['costs']['tools_purchase'], 2) }}</span>
                </div>

                {{-- Item 5: Outsource purchase --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#ede9fe;color:#6d28d9;">
                            <i class="bx bx-user-x"></i>
                        </div>
                        <div>
                            <div>Outsource purchase</div>
                            <small class="text-muted font-11">Amount paid to external mechanic/vendor</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-danger">— ₹{{ number_format($financials['costs']['outsource_purchase'], 2) }}</span>
                </div>

                {{-- Item 6: Expenses --}}
                <div class="pr-formula-row">
                    <div class="pr-item-name">
                        <div class="pr-item-icon" style="background:#fee2e2;color:#991b1b;">
                            <i class="bx bx-receipt"></i>
                        </div>
                        <div>
                            <div>Workshop Expenses</div>
                            <small class="text-muted font-11">Rent, electricity, tea, staff overheads</small>
                        </div>
                    </div>
                    <span class="pr-item-price text-danger">— ₹{{ number_format($financials['costs']['expenses'], 2) }}</span>
                </div>

                {{-- 2) Total Costs Bar --}}
                <div class="pr-total-bar expense-total">
                    <div>
                        <span class="fw-bold font-15">2) Total Direct Purchases</span>
                        <div class="font-11 text-muted">Parts, Lubes, Acc, Tools & Outsource cost</div>
                    </div>
                    <span class="fw-bold font-20">₹{{ number_format($financials['costs']['direct_total'], 2) }}</span>
                </div>
            </div>
        </div>

        {{-- ── FINAL EQUATION HERO BANNER ── --}}
        <div class="pr-equation-banner">
            <div class="equation-left">
                <div class="eq-pill sales-pill">
                    <span class="eq-pill-label">1) Total Sales</span>
                    <span class="eq-pill-val text-success">₹{{ number_format($financials['sales']['total'], 2) }}</span>
                </div>

                <span class="eq-sign">—</span>

                <div class="eq-pill costs-pill">
                    <span class="eq-pill-label">2) Direct Purchases</span>
                    <span class="eq-pill-val text-danger">₹{{ number_format($financials['costs']['direct_total'], 2) }}</span>
                </div>

                <span class="eq-sign">=</span>

                <div class="eq-pill" style="background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.3);">
                    <span class="eq-pill-label" style="color:#93c5fd;">Profit</span>
                    <span class="eq-pill-val text-primary">₹{{ number_format($financials['gross_profit'], 2) }}</span>
                </div>

                <span class="eq-sign">—</span>

                <div class="eq-pill" style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.3);">
                    <span class="eq-pill-label" style="color:#fcd34d;">Expenses</span>
                    <span class="eq-pill-val text-warning">₹{{ number_format($financials['costs']['expenses'], 2) }}</span>
                </div>

                <span class="eq-sign">=</span>
            </div>

            <div class="profit-right-box">
                <div class="font-12 text-uppercase fw-bold" style="color:#94a3b8;letter-spacing:0.8px;">
                    Net Workshop Profit
                </div>
                <h1 class="profit-final-val {{ $financials['net_profit'] < 0 ? 'negative' : '' }}">
                    ₹{{ number_format($financials['net_profit'], 2) }}
                </h1>
                <div class="font-12" style="color:#cbd5e1;">
                    Overall Profit Margin: <strong class="text-success">{{ $financials['profit_margin'] }}%</strong>
                </div>
            </div>
        </div>
    </div>

    {{-- ════════════════════ JOBCARDS PROFIT BREAKDOWN TABLE ════════════════════ --}}
    <div class="pr-table-card">
        <div class="pr-table-header">
            <div>
                <h5 class="fw-bold font-16 mb-0 text-dark">
                    <i class="bx bx-list-check me-2 text-danger"></i>JobCards Profit Breakdown
                </h5>
                <span class="font-12 text-muted">Vehicle-wise sales billing, purchase costs & net margin</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="input-group input-group-sm" style="min-width: 280px;">
                    <span class="input-group-text bg-white text-muted"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search JobCard # / Customer / Plate..." wire:model.live.debounce.300ms="search">
                </div>
                <select class="form-select form-select-sm" wire:model.live="perPage" style="width: 85px;">
                    <option value="10">10 / page</option>
                    <option value="25">25 / page</option>
                    <option value="50">50 / page</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table pr-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th>JobCard #</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Vehicle Details</th>
                        <th class="text-end">Sales (₹)</th>
                        <th class="text-end">Cost (₹)</th>
                        <th class="text-end">Profit (₹)</th>
                        <th class="text-center">Margin</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobcards as $jc)
                        @php
                            // Calculate jobcard sales
                            $jcLabourSale = (float) $jc->labours->sum(fn($l) => (float)($l->amount ?? $l->charges ?? 0));
                            $jcPartsSale = (float) $jc->jobCardSpareParts->sum('final_amount');
                            $jcTotalSale = $jcLabourSale + $jcPartsSale;

                            // Calculate jobcard cost
                            $jcOutsourceCost = (float) $jc->labours->where('charge_type', 2)->sum(fn($l) => (float)($l->outsource_price ?? 0));
                            $jcPartsCost = (float) $jc->jobCardSpareParts->sum(fn($p) => ($p->quantity ?: 1) * (float)($p->purchase_price ?? 0));
                            $jcTotalCost = $jcOutsourceCost + $jcPartsCost;

                            $jcProfit = $jcTotalSale - $jcTotalCost;
                            $jcMargin = $jcTotalSale > 0 ? round(($jcProfit / $jcTotalSale) * 100, 1) : 0;
                        @endphp
                        <tr>
                            <td>
                                <strong class="text-dark font-14">{{ $jc->jobcard_number ?? ('#' . $jc->id) }}</strong>
                            </td>
                            <td>
                                <span class="text-muted font-12">{{ $jc->created_at ? $jc->created_at->format('d M Y') : '—' }}</span>
                            </td>
                            <td>
                                <div class="fw-bold font-13">{{ $jc->customer_name ?? '—' }}</div>
                                <small class="text-muted font-11">{{ $jc->customer?->mobile_no ?? '' }}</small>
                            </td>
                            <td>
                                <div class="fw-bold font-13">{{ $jc->vehical_number ?? '—' }}</div>
                                <small class="text-muted font-11">{{ $jc->vehicle?->brand ?? '' }} {{ $jc->vehicle?->variant ?? '' }}</small>
                            </td>
                            <td class="text-end font-14 fw-bold text-success">
                                ₹{{ number_format($jcTotalSale, 2) }}
                            </td>
                            <td class="text-end font-14 fw-bold text-danger">
                                ₹{{ number_format($jcTotalCost, 2) }}
                            </td>
                            <td class="text-end font-14 fw-extrabold {{ $jcProfit >= 0 ? 'text-primary' : 'text-danger' }}">
                                ₹{{ number_format($jcProfit, 2) }}
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $jcMargin >= 20 ? 'bg-success-subtle text-success border border-success-subtle' : ($jcMargin > 0 ? 'bg-warning-subtle text-warning border border-warning-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle') }} font-12 px-2 py-1">
                                    {{ $jcMargin }}%
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-secondary border font-11">
                                    {{ $jc->status == 2 ? 'Completed' : 'Closed' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div style="width:60px;height:60px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:30px;margin-bottom:10px;">
                                        <i class="bx bx-receipt"></i>
                                    </div>
                                    <h6 class="fw-bold text-muted mb-1">No JobCards Found</h6>
                                    <span class="text-muted font-12">No JobCards found for the selected date range. Try changing the period filter above.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($jobcards->hasPages())
            <div class="p-3 border-top d-flex justify-content-end bg-white">
                {{ $jobcards->links() }}
            </div>
        @endif
    </div>

</div>
