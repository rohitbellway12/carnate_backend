<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers Report</title>
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
            background: #0ea5e9;
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
        .vehicle-subtable {
            width: 95%;
            margin: 5px auto;
            border-collapse: collapse;
        }
        .vehicle-subtable th {
            background: #e0f2fe;
            color: #0369a1;
            font-size: 10px;
            padding: 4px 6px;
        }
        .vehicle-subtable td {
            font-size: 9.5px;
            padding: 4px 6px;
        }
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
        <h2>Customers Report</h2>
        <p>Comprehensive list of platform customers and linked vehicle details</p>
    </div>

    <div class="divider"></div>

    <div class="summary-box">
        <table>
            <tr>
                <td><strong>Total Customers:</strong> {{ $totals['total_customers'] }}</td>
                <td><strong>With Vehicles:</strong> {{ $totals['with_vehicle'] }}</td>
                <td><strong>Without Vehicles:</strong> {{ $totals['without_vehicle'] }}</td>
                <td><strong>Total Vehicles:</strong> {{ $totals['total_vehicles'] }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 25%;">Customer Name</th>
                <th style="width: 20%;">Email</th>
                <th style="width: 15%;">Mobile</th>
                <th style="width: 20%;">Registered By</th>
                <th style="width: 15%;">Join Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $index => $c)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $c->name }} {{ $c->lastname }}</strong></td>
                    <td>{{ $c->email ?? '-' }}</td>
                    <td>{{ $c->mobile_no ?? '-' }}</td>
                    <td>{{ $c->user ? ($c->user->company_name ?? ($c->user->name . ' ' . $c->user->lastname)) : 'Admin' }}</td>
                    <td>{{ \Carbon\Carbon::parse($c->created_at)->format('d M Y') }}</td>
                </tr>
                @if($c->vehicles->count() > 0)
                    <tr>
                        <td colspan="6" style="background-color: #fafafa; padding-left: 20px;">
                            <table class="vehicle-subtable">
                                <thead>
                                    <tr>
                                        <th>Brand</th>
                                        <th>Variant</th>
                                        <th>Plate No.</th>
                                        <th>Chassis No.</th>
                                        <th>Engine No.</th>
                                        <th>Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($c->vehicles as $v)
                                        <tr>
                                            <td>{{ $v->brand ?? '-' }}</td>
                                            <td>{{ $v->variant ?? '-' }}</td>
                                            <td>{{ $v->number_plate ?? '-' }}</td>
                                            <td>{{ $v->chassis_no ?? '-' }}</td>
                                            <td>{{ $v->engineno ?? '-' }}</td>
                                            <td>{{ $v->year ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No registered customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer-note">
        Report generated via Admin Portal on {{ now()->format('d M Y, h:i A') }}
    </p>
</body>
</html>
