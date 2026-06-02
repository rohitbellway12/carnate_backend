<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Report</title>
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

        /* ===== STAFF CARD ===== */
        .staff-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 15px 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            page-break-inside: avoid;
        }
        .staff-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        .staff-header h3 {
            font-size: 15px;
            margin: 0;
            color: #1d4ed8;
        }
        .staff-header span {
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

        /* ===== SUB SECTION TITLE ===== */
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

        /* ===== FOOTER ===== */
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
        <h1>Workshop Staff Report</h1>
        <div class="header-divider"></div>
        <p>Filters: {{ $fromDate ?? '-' }} to {{ $toDate ?? '-' }} | Search: {{ $search ?: '-' }}</p>
    </div>

    {{-- <div class="summary-box">
        <div><strong>Total Staff:</strong> {{ count($staff) }}</div>
        <div>
            <strong>Total Labour Amount:</strong> ₹ {{ number_format(
                $staff->flatMap(fn($s) => $s->labours ?? [])->sum(fn($l) => ($l->amount ?? 0) * ($l->qty ?? 1)),
                2
            ) }}
        </div>
    </div> --}}

    <div class="summary-box">
        <div><strong>Total Staff:</strong> {{ count($staff) }}</div>
        <div>
            <strong>Total Labour Amount:</strong> ₹ {{
                number_format($staff->sum(fn($s) => $staffLabourTotals[$s->id] ?? 0), 2)
            }}
        </div>
    </div>


    @foreach($staff as $index => $s)
        <div class="staff-card">
            <div class="staff-header">
                <h3>{{ $index + 1 }}. {{ $s->name }} {{ $s->lastname }}</h3>
                <span>{{ $s->Role->name ?? 'N/A' }}</span>
            </div>

            <table>
                <tr>
                    <th>Email</th>
                    <td>{{ $s->email ?? '-' }}</td>
                    <th>Mobile</th>
                    <td>{{ $s->mobile_no ?? '-' }}</td>
                    <th>Status</th>
                    <td>{{ $s->is_login ? 'Active' : 'Inactive' }}</td>
                    <th>Created</th>
                    <td>{{ \Carbon\Carbon::parse($s->created_at)->format('d-M-Y') }}</td>
                </tr>
            </table>

            @php
                $labours = \DB::table('job_card_extra_charges as l')
                    ->join('job_cards as jc', 'jc.id', '=', 'l.jobcard_id')
                    ->where('jc.user_id', $s->parent_id)
                    ->where('l.machanic_id', $s->id)
                    ->select('l.*', 'jc.jobcard_number', 'jc.customer_name', 'jc.vehical_number', 'jc.created_at')
                    ->orderBy('jc.created_at', 'desc')
                    ->get();
            @endphp

            <div class="section-title">Labour Details</div>
            @if($labours->count())
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jobcard No</th>
                            <th>Customer</th>
                            <th>Vehicle</th>
                            <th>Charge</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($labours as $i => $l)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $l->jobcard_number }}</td>
                                <td>{{ $l->customer_name }}</td>
                                <td>{{ $l->vehical_number }}</td>
                                <td>₹{{ number_format($l->amount, 2) }}</td>
                                <td>{{ $l->qty ?? 1 }}</td>
                                <td>₹{{ number_format(($l->amount ?? 0) * ($l->qty ?? 1), 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($l->created_at)->format('d-M-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="no-data">No labour details found for this staff.</p>
            @endif
        </div>
    @endforeach

    <div class="footer">
        Report generated automatically on {{ now()->format('d M Y, h:i A') }}
    </div>
</body>
</html>
