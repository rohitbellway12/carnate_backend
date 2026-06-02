<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payments Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11.5px;
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
            margin: 15px 0;
        }
        .summary-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-weight: 500;
        }
        .summary-box table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }
        .summary-box td {
            border: none;
            padding: 4px;
            font-size: 12px;
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
            font-size: 11px;
            text-transform: uppercase;
        }
        table.data-table td {
            color: #334155;
            font-size: 10.5px;
        }
        table.data-table tr:nth-child(even) td {
            background: #f8fafc;
        }
        .status-badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
        }
        .status-success { color: #16a34a; }
        .status-failed { color: #dc2626; }
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
        <h2>Payments Report</h2>
        <p>Comprehensive overview of workshop transaction records, amounts, and settlement statuses</p>
    </div>

    <div class="divider"></div>

    <div class="summary-box">
        <table>
            <tr>
                <td><strong>Total Transactions:</strong> {{ $totals['total'] }}</td>
                <td><strong>Success:</strong> {{ $totals['success'] }}</td>
                <td><strong>Failed:</strong> {{ $totals['failed'] }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Settled Revenue:</strong> ₹{{ number_format((float)$totals['total_amount'], 2) }}</td>
                <td><strong>Failed Volume:</strong> ₹{{ number_format((float)$totals['failed_amount'], 2) }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 23%;">Payment ID (Txn)</th>
                <th style="width: 12%;">Order ID</th>
                <th style="width: 25%;">Workshop Vendor</th>
                <th style="width: 18%;">Payment Date</th>
                <th style="width: 17%;" class="text-right">Amount (₹)</th>
                <th style="width: 10%; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $p->payment_id }}</strong></td>
                    <td>#{{ $p->order_id }}</td>
                    <td>{{ $p->user ? $p->user->name.' '.$p->user->lastname : 'N/A' }}</td>
                    <td>{{ $p->created_at ? \Carbon\Carbon::parse($p->created_at)->format('d M Y, h:i A') : 'N/A' }}</td>
                    <td class="text-right fw-bold">{{ number_format((float)$p->amount, 2) }}</td>
                    <td style="text-align: center;">
                        @if(strtolower($p->status) === 'success')
                            <span class="status-badge status-success">Success</span>
                        @else
                            <span class="status-badge status-failed">Failed</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No payment transactions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer-note">
        Report generated via Admin Portal on {{ now()->format('d M Y, h:i A') }}
    </p>
</body>
</html>
