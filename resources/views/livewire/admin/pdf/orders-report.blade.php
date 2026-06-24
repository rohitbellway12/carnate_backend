<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders Report</title>
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
        .status-pending { color: #dc2626; }
        .status-accepted { color: #16a34a; }
        .status-handover { color: #2563eb; }
        .status-received { color: #059669; }
        .status-declined { color: #b91c1c; }
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
        <h2>Orders Report</h2>
        <p>Comprehensive overview of workshop orders, total quantities, and payment statuses</p>
    </div>

    <div class="divider"></div>

    <div class="summary-box">
        <table>
            <tr>
                <td><strong>Total Orders:</strong> {{ $totals['total'] }}</td>
                <td><strong>Awaiting Action:</strong> {{ $totals['pending'] }}</td>
                <td><strong>In-Flight:</strong> {{ $totals['accepted'] + $totals['handover'] }}</td>
                <td><strong>Fully Received:</strong> {{ $totals['received'] }}</td>
                <td><strong>Declined:</strong> {{ $totals['declined'] }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Total Ordered Amount:</strong> ₹{{ number_format((float)$totals['total_amount'], 2) }}</td>
                <td colspan="2"><strong>Fully Paid Amount:</strong> ₹{{ number_format((float)$totals['paid_amount'], 2) }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 15%;">Invoice Number</th>
                <th style="width: 25%;">Workshop Vendor</th>
                <th style="width: 15%;">Order Date</th>
                <th style="width: 10%; text-align: center;">Qty / Item</th>
                <th style="width: 12%;" class="text-right">Total Amount (₹)</th>
                <th style="width: 11%; text-align: center;">Payment Status</th>
                <th style="width: 12%; text-align: center;">Order Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $index => $o)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ getWorkshopInvoiceNumber($o) }}</strong></td>
                    <td>{{ $o->workShopVendor->company_name ?? ($o->workShopVendor ? $o->workShopVendor->name.' '.$o->workShopVendor->lastname : 'N/A') }}</td>
                    <td>{{ $o->order_date ? \Carbon\Carbon::parse($o->order_date)->format('d M Y, h:i A') : 'N/A' }}</td>
                    <td class="text-center">{{ $o->total_quantity }} ({{ $o->total_item }})</td>
                    <td class="text-right" style="font-weight: bold;">{{ number_format((float)$o->total_amount, 2) }}</td>
                    <td class="text-center">
                        @switch($o->payment_status)
                            @case(0) <span class="status-badge status-pending">Pending</span> @break
                            @case(1) <span class="status-badge status-accepted">Success</span> @break
                            @case(2) <span class="status-badge status-handover">Partial</span> @break
                            @default <span class="status-badge">Unknown</span>
                        @endswitch
                    </td>
                    <td class="text-center">
                        @switch($o->order_status)
                            @case(0) <span class="status-badge status-pending">Pending</span> @break
                            @case(1) <span class="status-badge status-accepted">Accepted</span> @break
                            @case(2) <span class="status-badge status-declined">Declined</span> @break
                            @case(3) <span class="status-badge status-handover">Handover</span> @break
                            @case(4) <span class="status-badge status-received">Received</span> @break
                            @default <span class="status-badge">Pending</span>
                        @endswitch
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer-note">
        Report generated via Admin Portal on {{ now()->format('d M Y, h:i A') }}
    </p>
</body>
</html>
