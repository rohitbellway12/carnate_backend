<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12.5px;
            color: #1e293b;
            margin: 30px;
            background-color: #f8fafc;
        }


    .report-header {
        text-align: center;
        margin-bottom: 25px;
    }
    .report-header h2 {
        font-size: 22px;
        color: #0f172a;
        margin-bottom: 5px;
        letter-spacing: 0.4px;
    }
    .report-header p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .divider {
        height: 4px;
        width: 100%;
        background: linear-gradient(to right, #38bdf8, #a7f3d0);
        border-radius: 4px;
        margin: 20px 0;
    }

    .summary-box {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        color: #0f766e;
        font-weight: 500;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .summary-box span {
        margin-right: 15px;
        flex: 1;
        min-width: 180px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    th, td {
        border: 1px solid #e2e8f0;
        padding: 8px 10px;
    }
    th {
        background: #f0fdfa;
        color: #0f172a;
        font-weight: 600;
        text-align: left;
        font-size: 13px;
    }
    td {
        font-size: 12.5px;
        color: #334155;
    }
    tr:nth-child(even) td {
        background: #f9fafb;
    }
    tr:hover td {
        background: #f0f9ff;
    }

    .vehicle-table {
        width: 96%;
        margin: 8px auto 12px;
        border-collapse: collapse;
        font-size: 11.5px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
    }
    .vehicle-table th {
        background: #e0f2fe;
        color: #075985;
        font-weight: 600;
        padding: 6px;
    }
    .vehicle-table td {
        border: 1px solid #e5e7eb;
        padding: 6px;
    }
    .no-vehicle {
        font-style: italic;
        color: #9ca3af;
        padding: 5px 15px;
    }

    .footer-note {
        font-size: 10.5px;
        text-align: right;
        color: #6b7280;
        margin-top: 25px;
    }
</style>


</head>

<body>
    <div class="report-header">
        <h2>Customers Report</h2>
        <p>Comprehensive summary of customer details with vehicle information</p>
    </div>


<div class="divider"></div>

<div class="summary-box">
    <span><strong>Total Customers:</strong> {{ $totals['total_customers'] }}</span>
    <span><strong>With Vehicles:</strong> {{ $totals['with_vehicle'] }}</span>
    <span><strong>Without Vehicles:</strong> {{ $totals['without_vehicle'] }}</span>
    <span><strong>Total Vehicles:</strong> {{ $totals['total_vehicles'] }}</span>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $i => $c)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $c->name }} {{ $c->lastname }}</td>
                <td>{{ $c->email ?? '-' }}</td>
                <td>{{ $c->mobile_no ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($c->created_at)->format('d-m-Y') }}</td>
            </tr>

            @if($c->vehicles->count() > 0)
                <tr>
                    <td colspan="5">
                        <table class="vehicle-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Brand</th>

                                    <th>Model</th>
                                    <th>Registration No</th>
                                    <th>Chassis No</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($c->vehicles as $j => $v)
                                    <tr>
                                        <td>{{ $j + 1 }}</td>
                                        <td>{{ optional($v->brand)->vehicle_brand ?? ($v->brand ?? '-') }}</td>
                                            <td>{{ $v->modelname ?? $v->modification ?? '-' }}</td>
                                            <td>{{ $v->number_plate ?? '-' }}</td>
                                            <td>{{ $v->chassis_no ?? '-' }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @else
                <tr>
                    <td colspan="5" class="no-vehicle">No vehicle records found for this customer.</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>

<p class="footer-note">
    Report generated on {{ now()->format('d M Y, h:i A') }}
</p>
```

</body>
</html>
