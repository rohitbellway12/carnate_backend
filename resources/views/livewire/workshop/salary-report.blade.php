<div class="carnate-salary-report-page">

    <style>
        .carnate-salary-report-page {
            --sr-bg: #f7f8fa;
            --sr-card: #ffffff;
            --sr-text: #111827;
            --sr-muted: #64748b;
            --sr-border: #e2e8f0;
            --sr-red: #e53935;
            --sr-red-dark: #c92f2c;
            --sr-red-soft: #fff5f5;
            --sr-green: #16a34a;
            --sr-green-soft: #f0fdf4;
            --sr-icon: #f1f5f9;
            --sr-shadow: 0 8px 28px rgba(15, 23, 42, 0.06);

            color: var(--sr-text);
        }

        /* Header */
        .carnate-salary-report-page .sr-header {
            background: var(--sr-card);
            border: 1px solid var(--sr-border);
            border-radius: 16px;
            box-shadow: var(--sr-shadow);
            padding: 18px 20px;
            margin-bottom: 18px;
        }

        .carnate-salary-report-page .sr-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .carnate-salary-report-page .sr-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: var(--sr-red-soft);
            color: var(--sr-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .carnate-salary-report-page .sr-title {
            margin: 0;
            font-size: 19px;
            font-weight: 700;
            color: var(--sr-text);
        }

        .carnate-salary-report-page .sr-subtitle {
            margin: 3px 0 0;
            font-size: 12px;
            color: var(--sr-muted);
        }

        .carnate-salary-report-page .sr-toolbar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* Inputs */
        .carnate-salary-report-page .sr-search {
            position: relative;
            width: 210px;
        }

        .carnate-salary-report-page .sr-search i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            pointer-events: none;
            z-index: 2;
        }

        .carnate-salary-report-page .sr-search input,
        .carnate-salary-report-page .sr-date,
        .carnate-salary-report-page .sr-filter {
            height: 40px;
            border: 1px solid var(--sr-border);
            border-radius: 9px;
            background: #fff;
            color: var(--sr-text);
            font-size: 12px;
            outline: none;
            box-shadow: none;
            transition: .2s ease;
        }

        .carnate-salary-report-page .sr-search input {
            width: 100%;
            padding: 0 12px 0 37px;
        }

        .carnate-salary-report-page .sr-date {
            width: 145px;
            padding: 0 11px;
        }

        .carnate-salary-report-page .sr-filter {
            width: 150px;
            padding: 0 10px;
        }

        .carnate-salary-report-page .sr-search input:focus,
        .carnate-salary-report-page .sr-date:focus,
        .carnate-salary-report-page .sr-filter:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        /* Export */
        .carnate-salary-report-page .sr-export {
            height: 40px;
            border: 0;
            border-radius: 9px;
            padding: 0 14px;
            background: var(--sr-red);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: .2s ease;
        }

        .carnate-salary-report-page .sr-export:hover {
            background: var(--sr-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        /* Summary cards */
        .carnate-salary-report-page .sr-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 18px;
        }

        .carnate-salary-report-page .sr-summary-card {
            position: relative;
            min-height: 92px;
            padding: 17px;
            background: var(--sr-card);
            border: 1px solid var(--sr-border);
            border-radius: 14px;
            box-shadow: var(--sr-shadow);
            overflow: hidden;
        }

        .carnate-salary-report-page .sr-summary-card::after {
            content: "";
            position: absolute;
            right: -25px;
            top: -25px;
            width: 85px;
            height: 85px;
            border-radius: 50%;
            background: rgba(229, 57, 53, .035);
        }

        .carnate-salary-report-page .sr-summary-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            height: 100%;
        }

        .carnate-salary-report-page .sr-summary-label {
            margin: 0 0 5px;
            color: var(--sr-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-salary-report-page .sr-summary-value {
            display: block;
            color: var(--sr-text);
            font-size: 17px;
            font-weight: 800;
            line-height: 1.2;
        }

        .carnate-salary-report-page .sr-summary-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--sr-icon);
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
        }

        .carnate-salary-report-page .sr-summary-card.total {
            border-color: rgba(22, 163, 74, .18);
        }

        .carnate-salary-report-page .sr-summary-card.total .sr-summary-icon {
            background: var(--sr-green-soft);
            color: var(--sr-green);
        }

        .carnate-salary-report-page .sr-summary-card.incentive .sr-summary-icon {
            background: var(--sr-red-soft);
            color: var(--sr-red);
        }

        /* Table card */
        .carnate-salary-report-page .sr-table-card {
            background: var(--sr-card);
            border: 1px solid var(--sr-border);
            border-radius: 16px;
            box-shadow: var(--sr-shadow);
            overflow: hidden;
        }

        .carnate-salary-report-page .sr-table-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--sr-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-salary-report-page .sr-table-title {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: var(--sr-text);
        }

        .carnate-salary-report-page .sr-table-subtitle {
            margin: 3px 0 0;
            color: var(--sr-muted);
            font-size: 11px;
        }

        .carnate-salary-report-page .sr-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .carnate-salary-report-page .sr-table {
            width: 100%;
            min-width: 950px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-salary-report-page .sr-table thead th {
            padding: 13px 15px;
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--sr-border);
            border-top: 0;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-salary-report-page .sr-table tbody td {
            padding: 14px 15px;
            background: #fff;
            border-bottom: 1px solid #eef2f7;
            color: #334155;
            font-size: 12px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .carnate-salary-report-page .sr-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-salary-report-page .sr-table tbody tr:hover td {
            background: #fafafa;
        }

        .carnate-salary-report-page .sr-employee {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: var(--sr-text);
        }

        .carnate-salary-report-page .sr-avatar {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: var(--sr-icon);
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .carnate-salary-report-page .sr-money {
            font-variant-numeric: tabular-nums;
        }

        .carnate-salary-report-page .sr-incentive {
            color: var(--sr-red);
            font-weight: 700;
        }

        .carnate-salary-report-page .sr-total {
            color: var(--sr-text);
            font-weight: 800;
        }

        .carnate-salary-report-page .sr-table tfoot th {
            padding: 14px 15px;
            background: #f8fafc;
            border-top: 1px solid var(--sr-border);
            color: var(--sr-text);
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* Empty state */
        .carnate-salary-report-page .sr-empty {
            padding: 50px 20px !important;
            text-align: center;
            color: var(--sr-muted);
        }

        .carnate-salary-report-page .sr-empty-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: var(--sr-icon);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 23px;
        }

        .carnate-salary-report-page .sr-empty-title {
            margin: 0;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
        }

        /* Pagination */
        .carnate-salary-report-page .sr-pagination {
            padding: 15px 20px;
            border-top: 1px solid var(--sr-border);
            display: flex;
            justify-content: flex-end;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .carnate-salary-report-page .sr-header > .sr-header-inner {
                align-items: flex-start !important;
                flex-direction: column;
            }

            .carnate-salary-report-page .sr-toolbar {
                width: 100%;
                justify-content: flex-start;
            }

            .carnate-salary-report-page .sr-summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 767.98px) {
            .carnate-salary-report-page .sr-header {
                padding: 16px;
            }

            .carnate-salary-report-page .sr-toolbar {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .carnate-salary-report-page .sr-search,
            .carnate-salary-report-page .sr-filter,
            .carnate-salary-report-page .sr-date {
                width: 100%;
            }

            .carnate-salary-report-page .sr-export {
                width: 100%;
                justify-content: center;
            }

            .carnate-salary-report-page .sr-summary-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .carnate-salary-report-page .sr-summary-card {
                min-height: 86px;
                padding: 13px;
            }

            .carnate-salary-report-page .sr-summary-value {
                font-size: 14px;
            }

            .carnate-salary-report-page .sr-summary-icon {
                width: 32px;
                height: 32px;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .carnate-salary-report-page .sr-toolbar {
                grid-template-columns: 1fr;
            }

            .carnate-salary-report-page .sr-summary-grid {
                grid-template-columns: 1fr;
            }

            .carnate-salary-report-page .sr-title {
                font-size: 18px;
            }
        }
    </style>

    {{-- Header --}}
    <div class="sr-header">

        <div class="sr-header-inner d-flex align-items-center justify-content-between gap-3">

            <div class="sr-title-wrap">
                <div class="sr-title-icon">
                    <i class="bx bx-wallet"></i>
                </div>

                <div>
                    <h5 class="sr-title">Salary Report</h5>
                    <p class="sr-subtitle">
                        Staff salary, targets and incentive summary
                    </p>
                </div>
            </div>

            <div class="sr-toolbar">

                {{-- Search --}}
                <div class="sr-search">
                    <i class="bx bx-search"></i>
                    <input type="text"
                        placeholder="Search staff..."
                        wire:model.live="search">
                </div>

                {{-- Date Range --}}
                <input type="date"
                    class="sr-date"
                    wire:model.lazy="fromDate">

                <input type="date"
                    class="sr-date"
                    wire:model.lazy="toDate">

                {{-- Filter --}}
                <select class="sr-filter"
                    wire:model.live="filterType">
                    <option value="">All</option>
                    <option value="daily">Today</option>
                    <option value="weekly">This Week</option>
                    <option value="monthly">This Month</option>
                </select>

                {{-- Export --}}
                <button class="sr-export"
                    wire:click="downloadPDF">
                    <i class="bx bxs-file-pdf"></i>
                    Export PDF
                </button>

            </div>

        </div>

    </div>

    {{-- Summary --}}
    <div class="sr-summary-grid">

        {{-- Staff --}}
        <div class="sr-summary-card">
            <div class="sr-summary-content">
                <div>
                    <p class="sr-summary-label">Staff</p>
                    <span class="sr-summary-value">
                        {{ $totals['staff_count'] ?? 0 }}
                    </span>
                </div>

                <div class="sr-summary-icon">
                    <i class="bx bx-group"></i>
                </div>
            </div>
        </div>

        {{-- Completed Target --}}
        <div class="sr-summary-card">
            <div class="sr-summary-content">
                <div>
                    <p class="sr-summary-label">Completed Target</p>
                    <span class="sr-summary-value">
                        ₹{{ number_format($totals['completed_target'] ?? 0, 2) }}
                    </span>
                </div>

                <div class="sr-summary-icon">
                    <i class="bx bx-check"></i>
                </div>
            </div>
        </div>

        {{-- Incentive --}}
        <div class="sr-summary-card incentive">
            <div class="sr-summary-content">
                <div>
                    <p class="sr-summary-label">Incentive</p>
                    <span class="sr-summary-value">
                        ₹{{ number_format($totals['incentive'] ?? 0, 2) }}
                    </span>
                </div>

                <div class="sr-summary-icon">
                    <i class="bx bx-badge-check"></i>
                </div>
            </div>
        </div>

        {{-- Total Salary --}}
        <div class="sr-summary-card total">
            <div class="sr-summary-content">
                <div>
                    <p class="sr-summary-label">Total Salary</p>
                    <span class="sr-summary-value">
                        ₹{{ number_format($totals['total_salary'] ?? 0, 2) }}
                    </span>
                </div>

                <div class="sr-summary-icon">
                    <i class="bx bx-wallet"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- Salary Table --}}
    <div class="sr-table-card">

        <div class="sr-table-header">
            <div>
                <h6 class="sr-table-title">Salary Details</h6>
                <p class="sr-table-subtitle">
                    Employee-wise salary and incentive breakdown
                </p>
            </div>
        </div>

        <div class="sr-table-wrap">

            <table class="table sr-table">

                <thead>
                    <tr>
                        <th>Employee</th>
                        <th class="text-end">Base Salary</th>
                        <th class="text-end">Monthly Target</th>
                        <th class="text-end">Completed Target</th>
                        <th class="text-end">Over Target</th>
                        <th class="text-end">Incentive</th>
                        <th class="text-end">Total Salary</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($rows as $row)

                        <tr>

                            <td>
                                <div class="sr-employee">
                                    <span class="sr-avatar">
                                        <i class="bx bx-user"></i>
                                    </span>

                                    <span>
                                        {{ $row['name'] }}
                                    </span>
                                </div>
                            </td>

                            <td class="text-end sr-money">
                                {{ number_format($row['base_salary'], 2) }}
                            </td>

                            <td class="text-end sr-money">
                                {{ number_format($row['monthly_target'], 2) }}
                            </td>

                            <td class="text-end sr-money">
                                {{ number_format($row['completed_target'], 2) }}
                            </td>

                            <td class="text-end sr-money">
                                {{ number_format($row['over_target'], 2) }}
                            </td>

                            <td class="text-end sr-money sr-incentive">
                                {{ number_format($row['incentive'], 2) }}
                            </td>

                            <td class="text-end sr-money sr-total">
                                {{ number_format($row['total_salary'], 2) }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="sr-empty">

                                <div class="sr-empty-icon">
                                    <i class="bx bx-wallet"></i>
                                </div>

                                <p class="sr-empty-title">
                                    No data found for selected period.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

                @if($rows->count() > 0)

                    <tfoot>
                        <tr>
                            <th class="text-end">Totals</th>

                            <th class="text-end">
                                {{ number_format($totals['base_salary'] ?? 0, 2) }}
                            </th>

                            <th class="text-end">
                                {{ number_format($totals['monthly_target'] ?? 0, 2) }}
                            </th>

                            <th class="text-end">
                                {{ number_format($totals['completed_target'] ?? 0, 2) }}
                            </th>

                            <th class="text-end">
                                {{ number_format($totals['over_target'] ?? 0, 2) }}
                            </th>

                            <th class="text-end">
                                {{ number_format($totals['incentive'] ?? 0, 2) }}
                            </th>

                            <th class="text-end">
                                {{ number_format($totals['total_salary'] ?? 0, 2) }}
                            </th>
                        </tr>
                    </tfoot>

                @endif

            </table>

        </div>

        <div class="sr-pagination">
            {!! $rows->links() !!}
        </div>

    </div>

</div>