<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spare Part Stock Report</title>
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
            background: #3b82f6;
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
            padding: 5px 7px;
            text-align: left;
        }
        table.data-table th {
            background: #f1f5f9;
            color: #0f172a;
            font-weight: 600;
            font-size: 9.5px;
            text-transform: uppercase;
        }
        table.data-table td {
            color: #334155;
            font-size: 9px;
        }
        table.data-table tr:nth-child(even) td {
            background: #f8fafc;
        }
        .status-badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8.5px;
        }
        .status-in  { color: #16a34a; }
        .status-low { color: #d97706; }
        .status-out { color: #dc2626; }
        .cat-badge {
            font-size: 8px;
            font-weight: bold;
            padding: 2px 5px;
            border-radius: 3px;
        }
        .cat-1 { background: #dbeafe; color: #1e40af; }
        .cat-2 { background: #fef3c7; color: #92400e; }
        .cat-3 { background: #ede9fe; color: #5b21b6; }
        .cat-4 { background: #d1fae5; color: #065f46; }
        .footer-note {
            font-size: 9.5px;
            text-align: right;
            color: #94a3b8;
            margin-top: 25px;
        }
        .text-right  { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="report-header">
        <h2>Spare Part Stock Report</h2>
        <p>Current inventory across all categories — Accessory, Parts, Tools &amp; Lubricants</p>
    </div>

    <div class="divider"></div>

    @php
        $catLabels = [1 => 'Accessory', 2 => 'Parts', 3 => 'Tools', 4 => 'Lubricants'];
    @endphp

    <div class="summary-box">
        <table>
            <tr>
                <td><strong>Total Products:</strong> {{ $totals['total_entries'] }}</td>
                <td><strong>Total Quantity:</strong> {{ number_format($totals['total_quantity']) }}</td>
                <td><strong>Low Stock:</strong> {{ $totals['low_stock'] }}</td>
                <td><strong>Out of Stock:</strong> {{ $totals['out_of_stock'] }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Total Stock Value (Selling):</strong> <span style="font-weight: bold; color: #2563eb;">₹{{ number_format((float)$totals['total_value'], 2) }}</span></td>
                <td colspan="2">
                    @foreach($totals['by_category'] as $typeId => $count)
                        <strong>{{ $catLabels[$typeId] ?? '' }}:</strong> {{ $count }}&nbsp;&nbsp;
                    @endforeach
                </td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 4%;">#</th>
                <th style="width: 12%;">Category</th>
                <th style="width: 25%;">Part Name</th>
                <th style="width: 13%;">Part Number</th>
                <th style="width: 15%;">Brand</th>
                <th style="width: 8%; text-align: center;">Rack No</th>
                <th style="width: 8%; text-align: center;">Stock Qty</th>
                <th style="width: 13%; text-align: right;">Selling Price (₹)</th>
                <th style="width: 12%; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stocks as $index => $s)
                @php
                    $stockQty = (int) $s->stock;
                    $typeId   = $s->spare_part_type;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><span class="cat-badge cat-{{ $typeId }}">{{ $catLabels[$typeId] ?? 'Other' }}</span></td>
                    <td><strong>{{ $s->label->title ?? '-' }}</strong></td>
                    <td>{{ $s->part_number ?: '-' }}</td>
                    <td>{{ $s->brand ?: '-' }}</td>
                    <td class="text-center">{{ $s->rack_no ?: '-' }}</td>
                    <td class="text-center">{{ $stockQty }} {{ $s->unit->name ?? 'pcs' }}</td>
                    <td class="text-right" style="font-weight: bold;">{{ number_format((float)$s->price, 2) }}</td>
                    <td class="text-center">
                        @if($stockQty <= 0)
                            <span class="status-badge status-out">Out of Stock</span>
                        @elseif($stockQty <= 5)
                            <span class="status-badge status-low">Low Stock</span>
                        @else
                            <span class="status-badge status-in">In Stock</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">No stock items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer-note">
        Report generated via Spare Part Portal on {{ now()->format('d M Y, h:i A') }}
    </p>
</body>
</html>
