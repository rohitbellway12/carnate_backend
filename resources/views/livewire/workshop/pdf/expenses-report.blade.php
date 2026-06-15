<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expenses Report</title>
    <style>

        body {
            font-family: "DejaVu Sans", sans-serif;
            color: #1e293b;
            background: linear-gradient(to bottom, #f8fafc, #ffffff);
            margin: 30px;
            font-size: 12.5px;
        }
        /* ===== HEADER ===== */
        .report-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .report-header h1 {
            font-size: 24px;
            color: #0f172a;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .report-header p {
            font-size: 13px;
            color: #64748b;
            margin-top: 5px;
        }

        .header-divider {
            height: 4px;
            width: 160px;
            margin: 10px auto 25px;
            background: linear-gradient(to right, #38bdf8, #34d399);
            border-radius: 3px;
        }

        /* ===== SUMMARY BOX ===== */
        .summary-box {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 10px;
            padding: 12px 18px;
            color: #065f46;
            margin-bottom: 25px;
            font-weight: 500;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        }

        .summary-box div {
            flex: 1;
            min-width: 180px;
            padding: 4px 0;
        }

        .summary-box strong {
            color: #047857;
        }

        /* ===== EXPENSE CARD ===== */
        .expense-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 15px 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            page-break-inside: avoid;
        }

        .expense-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }

        .expense-header h3 {
            font-size: 15px;
            margin: 0;
            color: #1d4ed8;
        }

        .expense-header span {
            background: #dbeafe;
            color: #1e3a8a;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 11px;
        }

        /* ===== TABLES ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            border: 1px solid #e5e7eb;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background: #f1f5f9;
            color: #1e293b;
            font-weight: 600;
            font-size: 12px;
        }

        td {
            font-size: 12px;
            color: #334155;
        }

        tr:nth-child(even) td {
            background: #f9fafb;
        }

        .no-data {
            text-align: center;
            color: #9ca3af;
            font-style: italic;
            padding: 5px 0;
        }

        .footer {
            text-align: right;
            font-size: 11px;
            color: #6b7280;
            margin-top: 30px;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
        }
    </style>
</head>
<body>
    <div class="report-header">
        <h1>Expenses Report</h1>
        <div class="header-divider"></div>
        <p>
            From: {{ $fromDate ?? '-' }} &nbsp; to &nbsp; {{ $toDate ?? '-' }} |
            Search: {{ $search ?: '-' }} |
            Filter: {{ ucfirst($filterType ?? 'All') }}
        </p>
    </div>

    @php
        $totalAmt = $paidAmt = $balanceAmt = 0;
        foreach($expenses as $e) {
            $totalAmt += (float) preg_replace('/[^\d.]/', '', $e->total_amount ?? 0);
            $paidAmt += (float) preg_replace('/[^\d.]/', '', $e->paid_amount ?? 0);
            $balanceAmt += (float) preg_replace('/[^\d.]/', '', $e->balance_amount ?? 0);
        }
    @endphp

    <div class="summary-box">
        <div><strong>Total Entries:</strong> {{ count($expenses) }}</div>
        <div><strong>Total Amount:</strong> ₹{{ number_format($totalAmt, 2) }}</div>
        <div><strong>Total Paid:</strong> ₹{{ number_format($paidAmt, 2) }}</div>
        <div><strong>Total Balance:</strong> ₹{{ number_format($balanceAmt, 2) }}</div>
    </div>



    @forelse($expenses as $i => $e)
        <div class="expense-card">
            <div class="expense-header">
                <h3>Bill #{{ $e->bill_number ?? 'N/A' }}</h3>
                <span>{{ \Carbon\Carbon::parse($e->date)->format('d M Y') ?? '-' }}</span>
            </div>

            <table>
                <tr>
                    <th style="width:25%">Category</th>
                    <td style="width:25%">{{ $e->workshopCategory->title ?? '-' }}</td>

                    <td>{{ $e->workshopSupplier->business_first_name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td colspan="3">{{ $e->description ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>₹{{ number_format((float)($e->total_amount ?? 0), 2) }}</td>
                    <th>Paid</th>
                    <td>₹{{ number_format((float)($e->paid_amount ?? 0), 2) }}</td>
                </tr>
                <tr>
                    <th>Balance</th>
                    <td colspan="3">₹{{ number_format((float)($e->balance_amount ?? 0), 2) }}</td>
                </tr>

            </table>
        </div>
    @empty
        <p class="no-data">No expenses found.</p>
    @endforelse

    <div class="footer">
        Report generated on {{ now()->format('d M Y, h:i A') }}
    </div>
</body>
</html>
