<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Salary Report ({{ $from }} - {{ $to }})</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #2f3e46;
            margin: 25px;
            background-color: #fafafa;
        }
        h2 {
            text-align: center;
            margin-bottom: 5px;
            font-size: 20px;
            color: #354f52;
        }
        h2 small {
            display: block;
            font-size: 12px;
            font-weight: normal;
            color: #7d8c8f;
        }
        .header-line {
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, #a8dadc, #f1faee);
            margin-bottom: 20px;
            border-radius: 2px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 6px rgba(0,0,0,0.04);
        }
        th, td {
            border: 1px solid #dfe6e9;
            padding: 8px 10px;
            text-align: right;
        }
        th:first-child, td:first-child {
            text-align: left;
        }
        th {
            background: #e9f5f5;
            color: #2d3436;
            font-weight: 600;
            font-size: 12px;
        }
        tr:nth-child(even) {
            background: #f8fdfd;
        }
        tr:hover {
            background: #edf6f9;
        }
        td {
            font-size: 12px;
        }
        tfoot th {
            background: #dff3f3;
            font-weight: bold;
        }
        .summary {
            margin-top: 20px;
            text-align: right;
            font-size: 13px;
            color: #3a4a4f;
            font-weight: 600;
        }
        .small {
            font-size: 10px;
            color: #95c9d4;
            margin-top: 25px;
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>Salary Report <small>{{ $from }} to {{ $to }}</small></h2>
    <div class="header-line"></div>
<table>

    <thead>
        <tr>
            <th>Employee</th>
            <th>Base Salary</th>
            <th>Monthly Target</th>
            <th>Completed Target</th>
            <th>Over Target</th>
            <th>Incentive</th>
            <th>Total Salary</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row)
            <tr>
                <td>{{ $row['name'] }}</td>
                <td>{{ number_format($row['base_salary'], 2) }}</td>
                <td>{{ number_format($row['monthly_target'], 2) }}</td>
                <td>{{ number_format($row['completed_target'], 2) }}</td>
                <td>{{ number_format($row['over_target'], 2) }}</td>
                <td>{{ number_format($row['incentive'], 2) }}</td>
                <td><strong>{{ number_format($row['total_salary'], 2) }}</strong></td>
            </tr>
        @endforeach
    </tbody>
</table>

<p class="small">Report generated on {{ now()->format('d M Y, h:i A') }}</p>


</body>
</html>
