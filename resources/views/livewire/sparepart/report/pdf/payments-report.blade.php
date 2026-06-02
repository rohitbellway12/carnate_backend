<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wallet Payments Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
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
            margin-bottom: 20px;
        }
        .summary-box table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }
        .summary-box td {
            border: none;
            padding: 6px;
            font-size: 11px;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #e2e8f0;
            padding: 8px 10px;
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
        .badge {
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
        }
        .badge-deposit { color: #16a34a; }
        .badge-withdrawal { color: #dc2626; }
        .footer-note {
            font-size: 9.5px;
            text-align: right;
            color: #94a3b8;
            margin-top: 30px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="report-header">
        <h2>Wallet Payments Report</h2>
        <p>Official ledger of earnings, order payouts, and withdrawals request history</p>
    </div>

    <div class="divider"></div>

    <div class="summary-box">
        <table>
            <tr>
                <td><strong>Current Wallet Balance:</strong> <span style="font-size: 13px; font-weight: bold; color: #2563eb;">₹{{ number_format((float)$totals['balance'], 2) }}</span></td>
                <td><strong>Total Earnings (Deposits):</strong> ₹{{ number_format((float)$totals['earnings'], 2) }}</td>
                <td><strong>Total Withdrawals:</strong> ₹{{ number_format((float)$totals['withdrawals'], 2) }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 20%;">Date / Time</th>
                <th style="width: 35%;">Description</th>
                <th style="width: 15%; text-align: center;">Type</th>
                <th style="width: 12%; text-align: right;">Amount (₹)</th>
                <th style="width: 13%; text-align: right;">Wallet Bal (₹)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $t)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $t->created_at ? \Carbon\Carbon::parse($t->created_at)->format('d M Y, h:i A') : 'N/A' }}</td>
                    <td>
                        @if($t->order_id > 0)
                            
                            <br><small style="color: #64748b;">Order #{{ $t->order_id }}</small>
                        @else
                            @if($t->type == 1)
                                Withdrawal payout request
                            @else
                                Wallet adjustment
                            @endif
                        @endif
                    </td>
                    <td class="text-center">
                        @if($t->type == 0)
                            <span class="badge badge-deposit">Deposit</span>
                        @else
                            <span class="badge badge-withdrawal">Withdrawal</span>
                        @endif
                    </td>
                    <td class="text-right" style="font-weight: bold; color: {{ $t->type == 0 ? '#16a34a' : '#dc2626' }};">
                        {{ $t->type == 0 ? '+' : '-' }} ₹{{ number_format((float)$t->amount, 2) }}
                    </td>
                    <td class="text-right" style="font-weight: bold;">₹{{ number_format((float)$t->total, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No transactions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer-note">
        Report generated via Spare Part Portal on {{ now()->format('d M Y, h:i A') }}
    </p>
</body>
</html>
