<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spare Part Vendor Profit & Loss Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10.5px;
            color: #1e293b;
            margin: 0;
            padding: 16px;
        }
        .header {
            border-bottom: 2px solid #e53935;
            padding-bottom: 14px;
            margin-bottom: 18px;
        }
        .brand-title {
            font-size: 20px;
            font-weight: bold;
            color: #0f172a;
            margin: 0 0 4px;
        }
        .report-subtitle {
            font-size: 11px;
            color: #64748b;
            margin: 0;
        }
        .meta-text {
            font-size: 10px;
            color: #475569;
            margin-top: 4px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }
        .table th {
            padding: 8px 10px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .5px;
            border: 1px solid #cbd5e1;
            text-align: left;
        }
        .table td {
            padding: 8px 10px;
            border: 1px solid #e2e8f0;
            font-size: 10.5px;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .profit-banner {
            background: #0f172a;
            color: #ffffff;
            padding: 14px 18px;
            border-radius: 8px;
            margin-top: 14px;
        }
    </style>
</head>
<body>

    <div class="header">
        <table style="width: 100%;">
            <tr>
                <td style="width: 60%;">
                    <div class="brand-title">{{ $vendor->business_first_name ?? $vendor->name ?? 'Spare Part Vendor' }}</div>
                    <div class="report-subtitle">Profit & Loss Financial Statement</div>
                    <div class="meta-text">
                        Period: <strong>{{ $fromDate ? date('d M Y', strtotime($fromDate)) : 'All Time' }}</strong> to <strong>{{ $toDate ? date('d M Y', strtotime($toDate)) : 'All Time' }}</strong>
                    </div>
                </td>
                <td class="text-right" style="width: 40%;">
                    <div class="meta-text">Generated: <strong>{{ date('d M Y, h:i A') }}</strong></div>
                    <div class="meta-text">Net Margin: <strong style="color:{{ $f['isProfitable'] ? '#16a34a' : '#dc2626' }};">{{ $f['marginPercentage'] }}%</strong></div>
                </td>
            </tr>
        </table>
    </div>

    {{-- Formula Summary Table --}}
    <table class="table">
        <thead>
            <tr>
                <th colspan="2" style="background:#ecfdf5;color:#065f46;font-size:11px;">1) Sales / Revenue Breakdown</th>
                <th colspan="2" style="background:#fff5f5;color:#991b1b;font-size:11px;">2) Purchases, Commission & Expenses (Less)</th>
            </tr>
            <tr>
                <th style="background:#f8fafc;width:30%;">Income Item</th>
                <th class="text-right" style="background:#f8fafc;width:20%;">Amount (₹)</th>
                <th style="background:#f8fafc;width:30%;">Cost / Expense Item</th>
                <th class="text-right" style="background:#f8fafc;width:20%;">Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Counter sale ({{ $f['counterSaleCount'] }} Invoices)</td>
                <td class="text-right fw-bold" style="color:#059669;">{{ number_format($f['counterSale'], 2) }}</td>
                <td>Parts purchase (Category 2)</td>
                <td class="text-right fw-bold" style="color:#dc2626;">{{ number_format($f['partsPurchase'], 2) }}</td>
            </tr>
            <tr>
                <td>Online sale ({{ $f['onlineOrdersCount'] }} Orders)</td>
                <td class="text-right fw-bold" style="color:#059669;">{{ number_format($f['onlineSale'], 2) }}</td>
                <td>Lubes purchase (Category 4)</td>
                <td class="text-right fw-bold" style="color:#dc2626;">{{ number_format($f['lubesPurchase'], 2) }}</td>
            </tr>
            <tr>
                <td style="color:#94a3b8;">—</td>
                <td class="text-right" style="color:#94a3b8;">—</td>
                <td>Accessory purchase (Category 1)</td>
                <td class="text-right fw-bold" style="color:#dc2626;">{{ number_format($f['accessoryPurchase'], 2) }}</td>
            </tr>
            <tr>
                <td style="color:#94a3b8;">—</td>
                <td class="text-right" style="color:#94a3b8;">—</td>
                <td>Tools purchase (Category 3)</td>
                <td class="text-right fw-bold" style="color:#dc2626;">{{ number_format($f['toolsPurchase'], 2) }}</td>
            </tr>
            <tr>
                <td style="color:#94a3b8;">—</td>
                <td class="text-right" style="color:#94a3b8;">—</td>
                <td>Platform charges (Commission)</td>
                <td class="text-right fw-bold" style="color:#dc2626;">{{ number_format($f['platformCharges'], 2) }}</td>
            </tr>
            <tr>
                <td style="color:#94a3b8;">—</td>
                <td class="text-right" style="color:#94a3b8;">—</td>
                <td>Shop Expenses ({{ $f['expensesCount'] }} entries)</td>
                <td class="text-right fw-bold" style="color:#dc2626;">{{ number_format($f['expenses'], 2) }}</td>
            </tr>
            <tr style="background:#f8fafc;">
                <td class="fw-bold" style="background:#ecfdf5;color:#065f46;font-size:11px;">1) Total Sales</td>
                <td class="text-right fw-bold" style="background:#ecfdf5;color:#065f46;font-size:11px;">₹{{ number_format($f['totalSales'], 2) }}</td>
                <td class="fw-bold" style="background:#fff5f5;color:#991b1b;font-size:11px;">2) Purchases & Commission Total</td>
                <td class="text-right fw-bold" style="background:#fff5f5;color:#991b1b;font-size:11px;">₹{{ number_format($f['totalCosts'], 2) }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Net Profit Calculation Box --}}
    <div class="profit-banner">
        <table style="width: 100%; color: #ffffff;">
            <tr>
                <td>
                    <div style="font-size: 13px; font-weight: bold; text-transform: uppercase;">
                        Final Statement {{ $f['isProfitable'] ? 'Net Profit' : 'Net Loss' }}
                    </div>
                    <div style="font-size: 10px; color: #94a3b8; margin-top: 4px;">
                        Formula: 1 Total (Sales) — 2 Total (Purchases & Commission) = Profit — Expenses = Net Profit
                    </div>
                </td>
                <td class="text-right">
                    <div style="font-size: 10px; color: #94a3b8; text-transform: uppercase; font-weight: bold;">
                        {{ $f['isProfitable'] ? 'NET PROFIT' : 'NET LOSS' }}
                    </div>
                    <div style="font-size: 22px; font-weight: bold; color: {{ $f['isProfitable'] ? '#34d399' : '#f87171' }};">
                        ₹{{ number_format($f['netProfit'], 2) }}
                    </div>
                    <div style="font-size: 10px; color: #cbd5e1;">Margin: {{ $f['marginPercentage'] }}%</div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>

