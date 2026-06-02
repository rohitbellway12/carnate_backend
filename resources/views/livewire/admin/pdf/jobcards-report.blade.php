<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Cards Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11.5px;
            color: #1e293b;
            margin: 15px;
            background-color: #ffffff;
        }
        .report-header {
            text-align: center;
            margin-bottom: 15px;
        }
        .report-header h2 {
            font-size: 20px;
            color: #0f172a;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .report-header p {
            color: #64748b;
            font-size: 12px;
            margin: 0;
        }
        .divider {
            height: 3px;
            width: 100%;
            background: #2563eb;
            margin: 12px 0;
        }
        .summary-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        .summary-box table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }
        .summary-box td {
            border: none;
            padding: 4px;
            font-size: 11px;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #e2e8f0;
            padding: 6px 8px;
            text-align: left;
        }
        table.data-table th {
            background: #f1f5f9;
            color: #0f172a;
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
        }
        table.data-table td {
            color: #334155;
            font-size: 10px;
        }
        table.data-table tr:nth-child(even) td {
            background: #f8fafc;
        }
        .status-badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
        }
        .status-open { color: #dc2626; }
        .status-confirmed { color: #2563eb; }
        .status-completed { color: #16a34a; }
        .status-closed { color: #0891b2; }
        .footer-note {
            font-size: 9.5px;
            text-align: right;
            color: #94a3b8;
            margin-top: 25px;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="report-header">
        <h2>Job Cards Report</h2>
        <p>Comprehensive overview of workshop job cards, statuses, and billing amounts</p>
    </div>

    <div class="divider"></div>

    <div class="summary-box">
        <table>
            <tr>
                <td><strong>Total Cards:</strong> {{ $totals['total'] }}</td>
                <td><strong>Open:</strong> {{ $totals['open'] }}</td>
                <td><strong>Confirmed:</strong> {{ $totals['confirmed'] }}</td>
                <td><strong>Completed:</strong> {{ $totals['completed'] }}</td>
                <td><strong>Closed:</strong> {{ $totals['closed'] }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Total Bill Value:</strong> ₹{{ number_format((float)$totals['total_amount'], 2) }}</td>
                <td colspan="2"><strong>Total Advances Paid:</strong> ₹{{ number_format((float)$totals['total_paid'], 2) }}</td>
                <td><strong>Outstanding Balance:</strong> ₹{{ number_format((float)$totals['total_balance'], 2) }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 4%;">#</th>
                <th style="width: 10%;">Job Card #</th>
                <th style="width: 16%;">Customer</th>
                <th style="width: 10%;">Vehicle No</th>
                <th style="width: 10%;">Vehicle</th>
                <th style="width: 18%;">Workshop</th>
                <th style="width: 9%;">Date</th>
                <th style="width: 8%;" class="text-right">Total (₹)</th>
                <th style="width: 8%;" class="text-right">Paid (₹)</th>
                <th style="width: 7%;" class="text-right">Bal (₹)</th>
                <th style="width: 8%; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jobcards as $index => $j)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $j->jobcard_number }}</strong></td>
                    <td>{{ $j->customer_name ?? 'N/A' }}</td>
                    <td>{{ $j->vehical_number ?? 'N/A' }}</td>
                    <td>{{ $j->vehical ?? 'N/A' }}</td>
                    <td>{{ $j->workshop->company_name ?? ($j->workshop ? $j->workshop->name.' '.$j->workshop->lastname : 'N/A') }}</td>
                    <td>{{ $j->entry_date ? \Carbon\Carbon::parse($j->entry_date)->format('d M Y') : 'N/A' }}</td>
                    <td class="text-right fw-semibold">{{ number_format((float)($j->final_amount ?? $j->amount ?? 0), 2) }}</td>
                    <td class="text-right" style="color: #16a34a;">{{ number_format((float)($j->advance ?? 0), 2) }}</td>
                    <td class="text-right" style="color: #dc2626; font-weight: bold;">{{ number_format((float)($j->balance_amount ?? 0), 2) }}</td>
                    <td style="text-align: center;">
                        @switch($j->status)
                            @case(1)
                                <span class="status-badge status-confirmed">Confirmed</span>
                                @break
                            @case(2)
                                <span class="status-badge status-completed">Completed</span>
                                @break
                            @case(3)
                                <span class="status-badge status-closed">Closed</span>
                                @break
                            @default
                                <span class="status-badge status-open">Open</span>
                        @endswitch
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" style="text-align: center;">No job cards found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer-note">
        Report generated via Admin Portal on {{ now()->format('d M Y, h:i A') }}
    </p>
</body>
</html>
