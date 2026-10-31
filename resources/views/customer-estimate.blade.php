<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Card Estimate</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .thank-you-container {
            width: 90%;
            max-width: 540px;
            padding: 35px 25px;
            text-align: center;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
        }

        .thank-you-container img {
            width: 90px;
            margin-bottom: 20px;
        }

        .thank-you-text {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .thank-you-subtext {
            font-size: 15px;
            color: #64748b;
            line-height: 1.5;
        }
    </style>
</head>

@php
    $decodedType = is_numeric($type) ? (int)$type : (int)base64_decode($type);
    $decodedId = is_numeric($id) ? (int)$id : (int)base64_decode($id);
    $targetUrl = $decodedType == 1 
        ? route('download.invoice', ['id' => $decodedId, 'type' => 0]) 
        : route('download.estimate.invoice', ['id' => $decodedId, 'type' => 0]);
@endphp

<body>
    <div class="thank-you-container">
        <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Check" />
        <div class="thank-you-text">Job Card Estimate</div>
        <div class="thank-you-subtext">Thank you for choosing Carnate Workshop. Your estimate sheet has been prepared.</div>
        <div class="thank-you-subtext mt-2 text-muted" style="font-size: 13px;">Your download will begin automatically.</div>
        <div class="mt-4">
            <a href="{{ $targetUrl }}" class="btn btn-danger px-4 py-2" style="border-radius: 8px; font-weight: 600;">
                Download / View Estimate PDF
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.onload = function () {
            let url = "{{ $targetUrl }}";
            setTimeout(function() {
                window.location.href = url;
            }, 600);
        };
    </script>
</body>

</html>
