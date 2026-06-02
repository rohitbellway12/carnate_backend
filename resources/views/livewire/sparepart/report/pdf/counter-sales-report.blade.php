<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Counter Sales Report</title>
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
            background: #22c55e;
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
        .status-unpaid { color: #dc2626; }
        .status-partial { color: #d97706; }
        .status-paid { color: #16a34a; }
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
        <h2>Counter Sales Report</h2>
        <p>Comprehensive overview of over-the-counter sales invoices, customer details, and payment histories</p>
    </div>

    <div class="divider"></div>

    <div class="summary-box">
        <table>
            <tr>
                <td><strong>Total Bills:</strong> {{ $totals['total'] }}</td>
                <td><strong>Fully Paid:</strong> {{ $totals['paid'] }}</td>
                <td><strong>Partially Paid:</strong> {{ $totals['partial'] }}</td>
                <td><strong>Unpaid Bills:</strong> {{ $totals['unpaid'] }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Total billing Net:</strong> ₹{{ number_format((float)$totals['total_amount'], 2) }}</td>
                <td><strong>Total Collected:</strong> ₹{{ number_format((float)$totals['paid_amount'], 2) }}</td>
                <td><strong>Total Outstanding:</strong> ₹{{ number_format((float)$totals['balance_amount'], 2) }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 12%;">Invoice No</th>
                <th style="width: 20%;">Customer Name</th>
                <th style="width: 13%;">Mobile</th>
                <th style="width: 12%;">Billing Date</th>
                <th style="width: 11%; text-align: right;">Net Total (₹)</th>
                <th style="width: 11%; text-align: right;">Paid (₹)</th>
                <th style="width: 11%; text-align: right;">Balance (₹)</th>
                <th style="width: 12%; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $index => $s)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>#{{ $s->countersale_number }}</strong></td>
                    <td>{{ $s->Customer->name ?? 'N/A' }}</td>
                    <td>{{ $s->Customer->mobile_no ?? 'N/A' }}</td>
                    <td>{{ $s->date ? \Carbon\Carbon::parse($s->date)->format('d M Y') : 'N/A' }}</td>
                    <td class="text-right" style="font-weight: bold;">{{ number_format((float)$s->subtotal, 2) }}</td>
                    <td class="text-right text-success">{{ number_format((float)$s->partial_amount, 2) }}</td>
                    <td class="text-right text-danger">{{ number_format((float)$s->balance_amount, 2) }}</td>
                    <td class="text-center">
                        @switch((int)$s->status)
                            @case(0) <span class="status-badge status-unpaid">Un-paid</span> @break
                            @case(1) <span class="status-badge status-partial">Partial</span> @break
                            @case(2) <span class="status-badge status-paid">Full Paid</span> @break
                        @endswitch
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">No counter sales found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer-note">
        Report generated via Spare Part Portal on {{ now()->format('d M Y, h:i A') }}
    </p>
</body>
</html>
