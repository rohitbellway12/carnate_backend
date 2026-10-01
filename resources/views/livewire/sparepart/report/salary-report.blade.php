<div class="carnate-salary-report-page">

    <style>
        .carnate-salary-report-page {
            --carnate-bg: #f7f8fa;
            --carnate-card: #ffffff;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            --carnate-green: #16a34a;
            --carnate-green-soft: #f0fdf4;
            --carnate-blue-soft: #eff6ff;
            background: var(--carnate-bg);
            color: var(--carnate-text);
        }

        .carnate-salary-report-page .carnate-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .carnate-salary-report-page .carnate-page-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--carnate-text);
        }

        .carnate-salary-report-page .carnate-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 5px;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-salary-report-page .carnate-breadcrumb a {
            color: var(--carnate-muted);
            text-decoration: none;
        }

        .carnate-salary-report-page .carnate-breadcrumb a:hover {
            color: var(--carnate-red);
        }

        .carnate-salary-report-page .carnate-report-card {
            background: var(--carnate-card);
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }

        .carnate-salary-report-page .carnate-filter-section {
            padding: 18px 20px;
            border-bottom: 1px solid var(--carnate-border);
            background: #fff;
        }

        .carnate-salary-report-page .carnate-filter-grid {
            display: grid;
            grid-template-columns: minmax(220px, 1fr) auto auto auto;
            gap: 10px;
            align-items: center;
        }

        .carnate-salary-report-page .carnate-input-wrap {
            position: relative;
        }

        .carnate-salary-report-page .carnate-input-wrap i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 2;
            font-size: 17px;
        }

        .carnate-salary-report-page .carnate-input-wrap input {
            padding-left: 38px;
        }

        .carnate-salary-report-page .form-control,
        .carnate-salary-report-page .form-select {
            min-height: 42px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            color: var(--carnate-text);
            background: #fff;
            box-shadow: none;
            font-size: 14px;
        }

        .carnate-salary-report-page .form-control:focus,
        .carnate-salary-report-page .form-select:focus {
            border-color: rgba(229, 57, 53, 0.45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.08);
        }

        .carnate-salary-report-page .carnate-date-group {
            display: flex;
            gap: 8px;
        }

        .carnate-salary-report-page .carnate-date-group .form-control {
            width: 145px;
        }

        .carnate-salary-report-page .carnate-export-btn {
            min-height: 42px;
            padding: 0 16px;
            border: 0;
            border-radius: 9px;
            background: var(--carnate-red);
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            white-space: nowrap;
        }

        .carnate-salary-report-page .carnate-export-btn:hover {
            background: #d9322f;
            color: #fff;
        }

        .carnate-salary-report-page .carnate-summary {
            padding: 18px 20px 4px;
        }

        .carnate-salary-report-page .carnate-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .carnate-salary-report-page .carnate-summary-card {
            min-height: 100px;
            border: 1px solid var(--carnate-border);
            border-radius: 13px;
            background: #fff;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .carnate-salary-report-page .carnate-summary-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.06);
        }

        .carnate-salary-report-page .carnate-summary-card.is-green {
            border-color: #bbf7d0;
            background: var(--carnate-green-soft);
        }

        .carnate-salary-report-page .carnate-summary-icon {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            border-radius: 11px;
            background: #f1f5f9;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .carnate-salary-report-page .is-green .carnate-summary-icon {
            background: #dcfce7;
            color: var(--carnate-green);
        }

        .carnate-salary-report-page .carnate-summary-label {
            margin: 0 0 4px;
            color: var(--carnate-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-salary-report-page .carnate-summary-value {
            margin: 0;
            color: var(--carnate-text);
            font-size: 20px;
            font-weight: 700;
            line-height: 1.2;
        }

        .carnate-salary-report-page .carnate-table-section {
            padding: 18px 20px 0;
        }

        .carnate-salary-report-page .carnate-table-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .carnate-salary-report-page .carnate-table-title {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-salary-report-page .carnate-table-wrapper {
            border: 1px solid var(--carnate-border);
            border-radius: 12px;
            overflow-x: auto;
        }

        .carnate-salary-report-page .carnate-salary-table {
            width: 100%;
            min-width: 950px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-salary-report-page .carnate-salary-table thead th {
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--carnate-border);
            padding: 13px 14px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-salary-report-page .carnate-salary-table tbody td {
            padding: 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .carnate-salary-report-page .carnate-salary-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-salary-report-page .carnate-salary-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-salary-report-page .carnate-employee {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 180px;
        }

        .carnate-salary-report-page .carnate-employee-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            flex: 0 0 36px;
        }

        .carnate-salary-report-page .carnate-employee-name {
            color: var(--carnate-text);
            font-weight: 600;
        }

        .carnate-salary-report-page .carnate-money {
            font-variant-numeric: tabular-nums;
        }

        .carnate-salary-report-page .carnate-total {
            color: var(--carnate-text);
            font-weight: 700;
        }

        .carnate-salary-report-page .carnate-table-footer {
            background: #f8fafc;
        }

        .carnate-salary-report-page .carnate-table-footer th {
            padding: 14px;
            border-top: 1px solid var(--carnate-border);
            color: var(--carnate-text);
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-salary-report-page .carnate-empty {
            padding: 55px 20px !important;
            text-align: center;
            color: var(--carnate-muted);
        }

        .carnate-salary-report-page .carnate-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .carnate-salary-report-page .carnate-pagination {
            padding: 16px 0 20px;
            display: flex;
            justify-content: flex-end;
        }

        @media (max-width: 1199px) {
            .carnate-salary-report-page .carnate-filter-grid {
                grid-template-columns: 1fr 1fr;
            }

            .carnate-salary-report-page .carnate-summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767px) {
            .carnate-salary-report-page .carnate-page-title {
                font-size: 20px;
            }

            .carnate-salary-report-page .carnate-filter-grid {
                grid-template-columns: 1fr;
            }

            .carnate-salary-report-page .carnate-date-group {
                width: 100%;
            }

            .carnate-salary-report-page .carnate-date-group .form-control {
                width: 50%;
            }

            .carnate-salary-report-page .carnate-export-btn {
                width: 100%;
            }

            .carnate-salary-report-page .carnate-summary-grid {
                grid-template-columns: 1fr;
            }

            .carnate-salary-report-page .carnate-filter-section,
            .carnate-salary-report-page .carnate-summary,
            .carnate-salary-report-page .carnate-table-section {
                padding-left: 12px;
                padding-right: 12px;
            }
        }
    </style>

    <!-- Page Header -->
    <div class="carnate-page-header">
        <div>
            <h1 class="carnate-page-title">Salary Report</h1>

            <div class="carnate-breadcrumb">
                <a href="{{ route('sparepart.dashboard') }}">
                    <i class="bx bx-home-alt"></i>
                </a>
                <span>/</span>
                <span>Reports</span>
                <span>/</span>
                <span>Salary Report</span>
            </div>
        </div>
    </div>

    <div class="carnate-report-card">

        <!-- Filters -->
        <div class="carnate-filter-section">
            <div class="carnate-filter-grid">

                <div class="carnate-input-wrap">
                    <i class="bx bx-search"></i>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search staff..."
                        wire:model.live="search"
                    >
                </div>

                <div class="carnate-date-group">
                    <input
                        type="date"
                        class="form-control"
                        wire:model.lazy="fromDate"
                    >

                    <input
                        type="date"
                        class="form-control"
                        wire:model.lazy="toDate"
                    >
                </div>

                <select
                    class="form-select"
                    wire:model.live="filterType"
                    style="width:150px;"
                >
                    <option value="">All</option>
                    <option value="daily">Today</option>
                    <option value="weekly">This Week</option>
                    <option value="monthly">This Month</option>
                </select>

                <button
                    type="button"
                    class="carnate-export-btn"
                    wire:click="downloadPDF"
                >
                    <i class="bx bxs-file-pdf"></i>
                    <span>Export PDF</span>
                </button>

            </div>
        </div>

        <!-- Summary -->
        <div class="carnate-summary">
            <div class="carnate-summary-grid">

                <div class="carnate-summary-card">
                    <div>
                        <p class="carnate-summary-label">Staff</p>
                        <p class="carnate-summary-value">
                            {{ $totals['staff_count'] ?? 0 }}
                        </p>
                    </div>
                    <div class="carnate-summary-icon">
                        <i class="bx bx-group"></i>
                    </div>
                </div>

                <div class="carnate-summary-card">
                    <div>
                        <p class="carnate-summary-label">Completed Target</p>
                        <p class="carnate-summary-value">
                            ₹{{ number_format($totals['completed_target'] ?? 0, 2) }}
                        </p>
                    </div>
                    <div class="carnate-summary-icon">
                        <i class="bx bx-target-lock"></i>
                    </div>
                </div>

                <div class="carnate-summary-card">
                    <div>
                        <p class="carnate-summary-label">Incentive</p>
                        <p class="carnate-summary-value">
                            ₹{{ number_format($totals['incentive'] ?? 0, 2) }}
                        </p>
                    </div>
                    <div class="carnate-summary-icon">
                        <i class="bx bx-gift"></i>
                    </div>
                </div>

                <div class="carnate-summary-card is-green">
                    <div>
                        <p class="carnate-summary-label">Total Salary</p>
                        <p class="carnate-summary-value">
                            ₹{{ number_format($totals['total_salary'] ?? 0, 2) }}
                        </p>
                    </div>
                    <div class="carnate-summary-icon">
                        <i class="bx bx-wallet"></i>
                    </div>
                </div>

            </div>
        </div>

        <!-- Salary Table -->
        <div class="carnate-table-section">

            <div class="carnate-table-heading">
                <h3 class="carnate-table-title">Salary Details</h3>
            </div>

            <div class="carnate-table-wrapper">
                <table class="carnate-salary-table">
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
                                    <div class="carnate-employee">
                                        <div class="carnate-employee-avatar">
                                            {{ strtoupper(substr($row['name'], 0, 1)) }}
                                        </div>

                                        <div class="carnate-employee-name">
                                            {{ $row['name'] }}
                                        </div>
                                    </div>
                                </td>

                                <td class="text-end carnate-money">
                                    {{ number_format($row['base_salary'], 2) }}
                                </td>

                                <td class="text-end carnate-money">
                                    {{ number_format($row['monthly_target'], 2) }}
                                </td>

                                <td class="text-end carnate-money">
                                    {{ number_format($row['completed_target'], 2) }}
                                </td>

                                <td class="text-end carnate-money">
                                    {{ number_format($row['over_target'], 2) }}
                                </td>

                                <td class="text-end carnate-money">
                                    {{ number_format($row['incentive'], 2) }}
                                </td>

                                <td class="text-end carnate-money carnate-total">
                                    {{ number_format($row['total_salary'], 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="carnate-empty">
                                    <div class="carnate-empty-icon">
                                        <i class="bx bx-file"></i>
                                    </div>
                                    <div>No data found for selected period.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    @if($rows->count() > 0)
                        <tfoot>
                            <tr class="carnate-table-footer">
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

            <!-- Pagination -->
            <div class="carnate-pagination">
                {!! $rows->links() !!}
            </div>

        </div>

    </div>

</div>