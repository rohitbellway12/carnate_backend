<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Salary Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #2f3e46; margin: 25px; }
        h2 { text-align: center; margin-bottom: 5px; font-size: 20px; }
        h2 small { display: block; font-size: 12px; font-weight: normal; color: #7d8c8f; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #dfe6e9; padding: 8px 10px; text-align: right; }
        th:first-child, td:first-child { text-align: left; }
        th { background: #e9f5f5; }
        tr:nth-child(even) { background: #f8fdfd; }
        .small { font-size: 10px; color: #95c9d4; margin-top: 25px; text-align: right; }
    </style>
</head>
<body>
    <h2>Salary Report
        <small>
            @if($from && $to)
                {{ $from }} to {{ $to }}
            @else
                All Time
            @endif
        </small>
    </h2>
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
