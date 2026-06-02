<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commission & Settlements Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
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
            background: #ef4444;
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
            font-size: 9.5px;
        }
        table.data-table tr:nth-child(even) td {
            background: #f8fafc;
        }
        .status-badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8.5px;
        }
        .footer-note {
            font-size: 9.5px;
            text-align: right;
            color: #94a3b8;
            margin-top: 25px;
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
        <h2>Commission & Settlements Report</h2>
        <p>Overview of platform fee deductions, gross totals, and net settlements credited to the wallet</p>
    </div>

    <div class="divider"></div>

    <div class="summary-box">
        <table>
            <tr>
                <td><strong>Total Items:</strong> {{ $totals['total_items'] }}</td>
                <td><strong>Total Gross Amount:</strong> ₹{{ number_format((float)$totals['total_gross'], 2) }}</td>
                <td><strong>Platform Commission Deducted:</strong> <span style="color: #ef4444; font-weight: bold;">₹{{ number_format((float)$totals['total_commission'], 2) }}</span></td>
                <td><strong>Net Wallet Settlement:</strong> <span style="color: #16a34a; font-weight: bold;">₹{{ number_format((float)$totals['total_net'], 2) }}</span></td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 10%;">Order ID</th>
                <th style="width: 15%;">Order Date</th>
                <!--<th style="width: 15%;">Invoice No.</th>-->
                <th style="width: 20%;">Part Name</th>
                <th style="width: 10%; text-align: right;">Gross (₹)</th>
                <th style="width: 8%; text-align: center;">Rate</th>
                <th style="width: 12%; text-align: right;">Commission (₹)</th>
                <th style="width: 12%; text-align: right;">Net Settled (₹)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $item)
                @php
                    $commissionPercent = (float) getCommission($item->category);
                    $grossAmount = (float) $item->total_amount;
                    $commissionAmount = ($grossAmount * $commissionPercent) / 100;
                    $netAmount = $grossAmount - $commissionAmount;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>#{{ $item->order_id }}</strong></td>
                    <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : 'N/A' }}</td>
                    <!--<td>{{ sparepartOrderReference($item->order) }}</td>-->
                    <td>{{ $item->SpareParts->name ?? 'N/A' }} <br><small>Qty: {{ $item->quantity }}</small></td>
                    <td class="text-right">{{ number_format($grossAmount, 2) }}</td>
                    <td class="text-center" style="color: #ef4444; font-weight: bold;">{{ $commissionPercent }}%</td>
                    <td class="text-right" style="color: #ef4444; font-weight: bold;">-{{ number_format($commissionAmount, 2) }}</td>
                    <td class="text-right" style="color: #16a34a; font-weight: bold;">{{ number_format($netAmount, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">No transactions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer-note">
        Report generated via Spare Part Portal on {{ now()->format('d M Y, h:i A') }}
    </p>
</body>
</html>
