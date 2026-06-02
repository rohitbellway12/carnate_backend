<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Workshops Report</title>
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
        .status-subscribed { color: #16a34a; }
        .status-trial { color: #d97706; }
        .status-inactive { color: #dc2626; }
        .footer-note {
            font-size: 9.5px;
            text-align: right;
            color: #94a3b8;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <div class="report-header">
        <h2>Workshops Report</h2>
        <p>Comprehensive summary of registered workshops and vendors status</p>
    </div>

    <div class="divider"></div>

    <div class="summary-box">
        <table>
            <tr>
                <td><strong>Total Registered:</strong> {{ $totals['total'] }}</td>
                <td><strong>Active Subscribed:</strong> {{ $totals['subscribed'] }}</td>
                <td><strong>Trial Period:</strong> {{ $totals['trial'] }}</td>
                <td><strong>Inactive:</strong> {{ $totals['inactive'] }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 25%;">Vendor Name</th>
                <th style="width: 25%;">Company Name</th>
                <th style="width: 20%;">Email</th>
                <th style="width: 13%;">Mobile</th>
                <th style="width: 12%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($workshops as $index => $w)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $w->name }} {{ $w->lastname }}</strong></td>
                    <td>{{ $w->company_name ?? 'N/A' }}</td>
                    <td>{{ $w->email }}</td>
                    <td>{{ $w->mobile_no }}</td>
                    <td>
                        @if($w->is_subscribe)
                            <span class="status-badge status-subscribed">Subscribed</span>
                        @elseif($w->is_trial)
                            <span class="status-badge status-trial">Trial</span>
                        @else
                            <span class="status-badge status-inactive">Inactive</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No registered workshops found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer-note">
        Report generated via Admin Portal on {{ now()->format('d M Y, h:i A') }}
    </p>
</body>
</html>
