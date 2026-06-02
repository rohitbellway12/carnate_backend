<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Job Cards Report</title>
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

        /* ===== JOBCARD BOX ===== */
        .jobcard {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 15px 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            page-break-inside: avoid;
        }

        .jobcard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }

        .jobcard-header h3 {
            font-size: 15px;
            margin: 0;
            color: #1d4ed8;
        }

        .jobcard-header span {
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

        th,
        td {
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

        .section-title {
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            margin: 12px 0 6px;
            border-left: 4px solid #3b82f6;
            padding-left: 8px;
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
        <h1>Job Cards Report</h1>
        <div class="header-divider"></div>
        <p>Generated on {{ now()->format('d M Y, h:i A') }}</p>
    </div>

    <div class="summary-box">
        <div><strong>Total:</strong> {{ $totals['total'] }}</div>
        <div><strong>Open:</strong> {{ $totals['open'] }}</div>
        <div><strong>Confirmed:</strong> {{ $totals['confirmed'] }}</div>
        <div><strong>Completed:</strong> {{ $totals['completed'] }}</div>
        <div><strong>Closed:</strong> {{ $totals['closed'] }}</div>
        {{-- <div><strong>Total Amount:</strong> ₹{{ number_format($totals['amount'], 2) }}</div> --}}
        <div><strong>Total Amount:</strong> ₹ {{ number_format($totals['amount'], 2) }}</div>

    </div>

    @foreach ($jobcards as $i => $j)
        <div class="jobcard">
            <div class="jobcard-header">
                <h3>Job Card #{{ $j->jobcard_number }}</h3>
                <span>@php($s = ['Open', 'Confirmed', 'Completed', 'Closed'][$j->status ?? 0] ?? '-') {{ $s }}</span>
            </div>

            <table>
                <tr>
                    <th style="width:20%">Customer</th>
                    <td style="width:30%">{{ $j->customer_name ?? '-' }}</td>
                    <th style="width:20%">Date</th>
                    <td>{{ optional($j->created_at)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Vehicle</th>
                    <td>{{ $j->vehical ?? '-' }}</td>
                    <th>Number Plate</th>
                    <td>{{ $j->vehical_number ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>₹{{ number_format($j->final_amount ?? ($j->amount ?? 0), 2) }}</td>
                    <th>Status</th>
                    <td>{{ $s }}</td>
                </tr>
            </table>

            <div class="section-title">Vehicle Details</div>
            @if ($j->vehicle)
                <table>
                    <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Model</th>
                            {{-- <th>Type</th> --}}
                            <th>Number Plate</th>
                            <th>Chassis No</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $j->vehicle->brand->vehicle_brand ?? ($j->vehicle->brand ?? '-') }}</td>
                            <td>{{ $j->vehical ?? '-' }}</td>
                            {{-- <td>{{ $j->vehicle->vehicletype->name ?? ($j->vehicle->vehicletype ?? '-') }}</td> --}}
                            <td>{{ $j->vehicle->number_plate ?? ($j->vehical_number ?? '-') }}</td>
                            <td>{{ $j->vehicle->chassis_no ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p class="no-data">No vehicle details found.</p>
            @endif

            <div class="section-title">Spare Parts Used</div>
            @if ($j->jobCardSpareParts->count())
                <table>
                    <thead>
                        <tr>
                            <th>Spare Part</th>
                            <th>Qty</th>
                            <th>Price</th>
                            {{-- <th>Discount</th> --}}
                            <th>Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($j->jobCardSpareParts as $sp)
                            <tr>
                                <td>{{ $sp->stock_label_name }}</td>
                                <td>{{ $sp->quantity }}</td>
                                <td>₹{{ number_format($sp->price, 2) }}</td>
                                {{-- <td>₹{{ number_format($sp->discount, 2) }}</td> --}}
                                <td>₹{{ number_format($sp->final_amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="no-data">No spare parts added.</p>
            @endif

            <div class="section-title">Labour Details</div>
            @if ($j->labours && $j->labours->count())
                <table>
                    <thead>
                        <tr>
                            <th>Mechanic</th>
                            {{-- <th>Charge Title</th> --}}
                            <th>Amount</th>
                            {{-- <th>Discount</th> --}}
                            {{-- <th>Final</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($j->labours as $l)
                            <tr>
                                <td>{{ $l->mechanic_name ?? '-' }}</td>
                                {{-- <td>{{ $l->title ?? '-' }}</td> --}}
                                <td>₹{{ number_format($l->amount ?? 0, 2) }}</td>
                                {{-- <td>₹{{ number_format($l->discount ?? 0, 2) }}</td> --}}
                                {{-- <td>₹{{ number_format($l->final_amount ?? 0, 2) }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="no-data">No labour charges found.</p>
            @endif


        </div>
    @endforeach

    <div class="footer">
        Report generated automatically on {{ now()->format('d M Y, h:i A') }}
    </div>
</body>

</html>
