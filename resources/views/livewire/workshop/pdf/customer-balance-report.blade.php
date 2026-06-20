<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Balance Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #1e293b;
            margin: 20px;
            background-color: #ffffff;
        }

        .report-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .report-header h2 {
            font-size: 20px;
            color: #0f172a;
            margin: 0 0 5px 0;
            letter-spacing: 0.4px;
        }

        .report-header p {
            color: #64748b;
            font-size: 12px;
            margin: 0;
        }

        .divider {
            height: 3px;
            width: 100%;
            background: linear-gradient(to right, #38bdf8, #f43f5e);
            border-radius: 3px;
            margin: 15px 0;
        }

        .summary-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px 0;
            margin-bottom: 20px;
        }

        .summary-card {
            padding: 10px;
            border-radius: 6px;
            text-align: center;
        }

        .summary-card .title {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .summary-card .value {
            font-size: 15px;
            font-weight: bold;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.data-table th, table.data-table td {
            border: 1px solid #e2e8f0;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        table.data-table th {
            background: #f8fafc;
            color: #0f172a;
            font-weight: bold;
            font-size: 11px;
        }

        table.data-table td {
            font-size: 11px;
            color: #334155;
        }

        table.data-table tr:nth-child(even) td {
            background: #f9fafb;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-danger {
            color: #ef4444;
        }

        .text-success {
            color: #22c55e;
        }

        .fw-bold {
            font-weight: bold;
        }

        .footer-note {
            font-size: 9px;
            text-align: right;
            color: #94a3b8;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="report-header">
        <h2>Customer Balance Report</h2>
        <p>Outstanding and pending balances list for customers</p>
        @if($fromDate || $toDate)
            <p style="margin-top: 4px; font-size: 11px; font-weight: bold;">
                Period: {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d-M-Y') : 'Beginning' }} to {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d-M-Y') : 'Present' }}
            </p>
        @endif
    </div>

    <div class="divider"></div>

    <table class="summary-table">
        <tr>
            <td class="summary-card" style="background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; width: 25%;">
                <div class="title">Customers</div>
                <div class="value">{{ $totals['total_customers'] }}</div>
            </td>
            <td class="summary-card" style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; width: 25%;">
                <div class="title">Total Bill</div>
                <div class="value">₹{{ number_format($totals['total_bill'], 2) }}</div>
            </td>
            <td class="summary-card" style="background: #f0fdfa; border: 1px solid #99f6e4; color: #0f766e; width: 25%;">
                <div class="title">Total Paid</div>
                <div class="value">₹{{ number_format($totals['total_paid'], 2) }}</div>
            </td>
            <td class="summary-card" style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; width: 25%;">
                <div class="title">Outstanding</div>
                <div class="value">₹{{ number_format($totals['total_balance'], 2) }}</div>
            </td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 25%;">Customer Name</th>
                <th style="width: 15%;">Mobile No.</th>
                <th style="width: 15%; text-align: center;">Job Cards</th>
                <th style="width: 13%; text-align: right;">Bill Amount</th>
                <th style="width: 13%; text-align: right;">Paid Amount</th>
                <th style="width: 14%; text-align: right;">Pending Balance</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $i => $c)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>
                        <div class="fw-bold">{{ $c->name }} {{ $c->lastname }}</div>
                        @if($c->email)
                            <div style="font-size: 9px; color: #64748b; margin-top: 2px;">{{ $c->email }}</div>
                        @endif
                    </td>
                    <td>{{ $c->mobile_no ?? '-' }}</td>
                    <td class="text-center">{{ $c->jobcards_count }}</td>
                    <td class="text-right">₹{{ number_format($c->total_bill, 2) }}</td>
                    <td class="text-right text-success">₹{{ number_format($c->total_paid, 2) }}</td>
                    <td class="text-right fw-bold text-danger">₹{{ number_format($c->total_balance, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 20px; color: #64748b;">No customer balance records found matching the criteria.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-note">
        Report generated on {{ now()->format('d M Y, h:i A') }}
    </div>

</body>
</html>
