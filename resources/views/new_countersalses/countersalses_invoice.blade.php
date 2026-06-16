<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::guard('sparepart')->user()?->display_name ?? 'Invoice' }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: black;
        }

        .rupee {
            font-family: 'DejaVu Sans', Arial, sans-serif;
        }

        .container {
            width: 100%;
            background-color: #ffffff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .logo {
            max-width: 150px;
            height: auto;
        }

        .company-info {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .company-logo {
            max-width: 120px;
            height: auto;
            flex-shrink: 0;
        }

        .company-details {
            flex: 1;
        }

        .company-name {
            margin: 0;
            font-size: 20px;
            color: #663399;
            font-weight: bold;
        }

        .company-tagline {
            margin: 5px 0 0 0;
            font-size: 12px;
            color: #666;
            font-style: italic;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-bottom: 20px;
        }

        .info-box {
            width: 100%;
        }

        .info-box p {
            margin: 5px 0;
            font-size: 12px;
        }

        .contact-info {
            text-align: right;
        }

        .contact-info p {
            margin: 3px 0;
            font-size: 12px;
        }

        .status {
            font-size: 12px;
            font-weight: bold;
        }

        .status.open {
            color: #ffffff;
            background-color: #d9534f;
            padding: 2px 8px;
            border-radius: 3px;
        }

        .table-container {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            color: #333;
        }

        .table th,
        .table td {
            padding: 5px;
            font-size: 12px;
            border: 1px solid black;
            text-align: left;
            color: black;
        }

        .table th {
            background-color: #B6CDEF;
        }

        .phoneIMG,
        .userIMG,
        .phoneIMGdd {
            max-width: 15px;
            height: auto;
        }

        .text-center {
            text-align: center !important;
        }

        .text-end {
            text-align: right !important;
        }

        .p-0 {
            padding: 0px !important;
        }

        .m-0 {
            margin: 0px !important;
        }

        .border-0 {
            border: 0px !important;
        }

        .border-bottom-0 {
            border-bottom: 0px !important;
        }

        .my-3 {
            margin: 10px 0 !important;
        }
    </style>
</head>

<body>
    @php
        // Try to get vendor from the CounterSale record first
        $vendor = null;
        if (isset($countersales->sparepart_id) && $countersales->sparepart_id) {
            $vendor = App\Models\SparePartVendor::with(['profileImage', 'SignImage'])->find(
                $countersales->sparepart_id,
            );
        } elseif (isset($countersales->workshop_id) && $countersales->workshop_id) {
            $vendor = App\Models\WorkShopVendor::with(['profileImage', 'SignImage'])->find($countersales->workshop_id);
        }

        // Fallback to Auth only if record has no owner
        if (!$vendor) {
            $vendor = Auth::guard('sparepart')->user() ?? Auth::guard('workshop')->user();
        }

        $logo = $vendor;
        $logoImage = null;

        if ($logo && $logo->profileImage && !empty($logo->profileImage->file)) {
            try {
                $logoPath = public_path($logo->profileImage->file);
                if (file_exists($logoPath)) {
                    $logoImage = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
                }
            } catch (\Exception $e) {
                $logoImage = null;
            }
        }
    @endphp

    <div class="container">
        <div class="inner-container header">
            {{-- Top Header Section --}}
            <table style="width: 100%; border: none; margin-bottom: 20px;">
                <tr>
                    <td style="width: 30%; border: none; vertical-align: top;">
                        @if ($logoImage)
                            <img src="{{ $logoImage }}" alt="Logo" style="max-width: 150px; height: auto;">
                        @endif
                    </td>
                    <td style="width: 40%; border: none; vertical-align: top; text-align: center;">
                        <div
                            style="font-size: 16px; font-weight: bold; background-color: #B6CDEF; color: #000; padding: 8px 15px; border: 1px solid #000; display: inline-block; text-transform: uppercase;">
                            {{ $logo && $logo->is_gst == 1 ? 'TAX INVOICE' : 'CASH INVOICE' }}
                        </div>
                    </td>
                    <td style="width: 30%; border: none; vertical-align: top; text-align: right;">
                        <p style="margin: 0 0 5px 0; font-size: 12px; color: #000;">
                            <strong>Invoice Number:-</strong> {{ $countersales->countersale_number }}
                        </p>
                        <p style="margin: 5px 0; font-size: 12px;">
                            <strong>Date:-</strong> {{ date('d-m-Y h:i A', strtotime($countersales->created_at)) }}
                        </p>
                        <p style="margin: 2px 0; font-size: 12px;">
                            <strong>Total Items:-</strong> {{ count($countersales->counterSalesSpareParts) }}
                        </p>
                    </td>
                </tr>
            </table>

            {{-- Bill From / Bill To Section --}}
            <table class="table"
                style="width:100%; border-collapse: collapse; margin-bottom: 20px; border:1px solid #000;">

                <thead>
                    <tr>
                        <th
                            style="width:50%; background:#B6CDEF; padding:10px; text-align:left; border:1px solid #000;">
                            Bill From (Seller)
                        </th>
                        <th
                            style="width:50%; background:#B6CDEF; padding:10px; text-align:left; border:1px solid #000;">
                            Bill To (Buyer)
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr>

                        {{-- ================= BILL FROM ================= --}}
                        <td
                            style="vertical-align: top; padding:12px; font-size:11px; line-height:1.6; border:1px solid #000;">

                            @php
                                $vendor = Auth::guard('sparepart')->user();
                            @endphp

                            <div style="font-size:13px; font-weight:bold; color:#663399; margin-bottom:5px;">
                                {{ $logo?->branch_name ?? ($vendor->company_name ?? $vendor->name) }}
                            </div>

                            <div style="margin-bottom:4px;">
                                <strong>Company Name:-</strong>
                                {{ $logo?->branch_name ?? ($vendor->company_name ?? $vendor->name) }}
                            </div>

                            <div style="margin-bottom:4px;">
                                <strong>Email:-</strong> {{ $vendor->email ?? '-' }}
                            </div>

                            <div style="margin-bottom:4px;">
                                <strong>Address:-</strong>
                                {{ $vendor->address ?? '-' }}

                                {{ $vendor->cityName?->name ?? '-' }},<br>
                                {{ $vendor->stateName?->name ?? '-' }}, {{ $vendor->pincode ?? '-' }}
                                {{ $vendor->countryName?->name ?? '-' }}
                            </div>

                            @if ($logo && $logo->is_gst == 1 && !empty($logo->gst_number))
                                <div style="margin-bottom:4px;">
                                    <strong>GST Number:-</strong> {{ $logo->gst_number }}
                                </div>
                            @endif

                        </td>

                        {{-- ================= BILL TO ================= --}}
                        <td
                            style="vertical-align: top; padding:12px; font-size:11px; line-height:1.6; border:1px solid #000;">

                            <div style="font-size:13px; font-weight:bold; margin-bottom:5px;">
                                {{ $countersales->Customer?->name }} {{ $countersales->Customer?->lastname }}
                            </div>

                            <div style="margin-bottom:4px;">
                                <strong>Mobile:-</strong> {{ $countersales->Customer?->mobile_no ?? 'NA' }}
                            </div>

                            <div style="margin-bottom:4px;">
                                <strong>Email:-</strong> {{ $countersales->Customer?->email ?? 'NA' }}
                            </div>

                            <div style="margin-bottom:4px;">
                                <strong>Address:-</strong>
                                {{ $countersales->Customer?->address ?? 'NA' }}
                            </div>

                            <div style="margin-bottom:4px;">
                                <strong>GST Number:-</strong>
                                {{ $countersales->Customer?->gst_number ?? 'NA' }}
                            </div>

                        </td>

                    </tr>
                </tbody>
            </table>

            @if (count($countersales->counterSalesSpareParts) > 0)
                <div class="partCharges my-3"><strong>Parts Charges</strong></div>

                <table class="table my-3">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th colspan="4" class="text-center">Parts</th>
                            @if ($logo->is_gst == 1)
                                <th class="text-center">HSN Number</th>
                            @endif
                            <th class="text-center">QTY</th>
                            <th class="text-center">unit</th>
                            <th class="text-center">Unit Price (Rs.)</th>
                            @if ($logo->is_gst == 1)
                                <th class="text-center">Tax</th>
                            @endif
                            <th class="text-center">Discount(Rs.)</th>
                            <th class="text-center">Amount(Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $partsTotal = 0;
                            $totalquentity = 0;
                        @endphp
                        @foreach ($countersales->counterSalesSpareParts as $counterSparePart)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}</td>

                                <td colspan="4">
                                    {{ $counterSparePart->stock_label_name }}</td>
                                @php
                                    // Use find() because stock_label_id is the SparePart ID in Counter Sale
                                    $__sp = \App\Models\SparePart::find($counterSparePart->stock_label_id);
                                    $__hsn = $__sp->hsn_code ?? '-';
                                    $__unitTitle = $__sp?->unit?->title ?? '-';
                                    $__taxPercentage = $__sp->tax_percentage ?? 0;
                                @endphp
                                @if ($logo->is_gst == 1)
                                    <td class="text-center" style="width:50px !important;">{{ $__hsn }}</td>
                                @endif
                                <td class="text-center" style="width:60px !important;">
                                    {{ $counterSparePart->quantity }}</td>
                                <td class="text-center" style="width:60px !important;">{{ $__unitTitle }}</td>

                                @php
                                    $__rate = (float) ($__sp->tax_percentage ?? 0);
                                    $__taxType = $__sp->tax_type ?? 'exclude';
                                    $__price = (float) ($counterSparePart->price ?? 0);
                                    $__quantity = (float) ($counterSparePart->quantity ?? 1);

                                    // Unit Price is the base price shown
                                    $exclusiveUnitPrice = $__price;

                                    if ($__rate > 0) {
                                        if ($__taxType == 'include') {
                                            $__taxablePrice = round($__price / (1 + $__rate / 100), 2);
                                            $__taxAmt = round(($__taxablePrice * $__rate) / 100, 2) * $__quantity;
                                        } else {
                                            $__taxAmt = round(($__price * $__rate) / 100, 2) * $__quantity;
                                        }
                                    } else {
                                        $__taxAmt = 0;
                                    }
                                @endphp
                                <td class="text-start" style="width:60px !important;">
                                    {{ number_format($exclusiveUnitPrice, 2) }}
                                </td>
                                @if ($logo->is_gst == 1)
                                    <td class="text-center" style="width:80px !important;">
                                        @if ($__rate > 0)
                                            {{ $__rate }}% {{ $__taxType == 'include' ? '(Inc)' : '(Exc)' }}<br>
                                            @if ($__taxType == 'include')
                                                <span style="color:#c0392b;">(-
                                                    {{ number_format($__taxAmt, 2) }})</span>
                                            @else
                                                <span style="color:#27ae60;">(+
                                                    {{ number_format($__taxAmt, 2) }})</span>
                                            @endif
                                        @else
                                            0.00
                                        @endif
                                    </td>
                                @endif

                                <td class="text-end" style="width:10px !important;">
                                    {{ number_format($counterSparePart->discount, 2) }}
                                </td>
                                <td class="text-end" style="width:10px !important;">
                                    @php
                                        $__dispFinal = (float) ($counterSparePart->final_amount ?? 0);
                                        $__dispTaxable =
                                            $__rate > 0 ? round($__dispFinal / (1 + $__rate / 100), 2) : $__dispFinal;
                                    @endphp
                                    {{ number_format($__dispTaxable, 2) }}
                                </td>

                            </tr>
                            @php
                                $partsTotal += $counterSparePart->final_amount;
                                $totalquentity += (float) $counterSparePart->quantity;
                            @endphp
                        @endforeach
                    </tbody>

                    @php
                        $taxablePartsTotal = 0;
                        $cgstPartsTotal = 0;
                        $sgstPartsTotal = 0;

                        foreach ($countersales->counterSalesSpareParts as $__rowSum) {
                            $__sp = \App\Models\SparePart::find($__rowSum->stock_label_id);
                            $rate = (float) ($__sp->tax_percentage ?? 0);
                            $final = (float) ($__rowSum->final_amount ?? 0);

                            if ($rate > 0) {
                                $taxable = round($final / (1 + $rate / 100), 2);
                                $gstAmt = round($final - $taxable, 2);
                                $cgst = round($gstAmt / 2, 2);
                                $sgst = round($gstAmt / 2, 2);
                            } else {
                                $taxable = $final;
                                $cgst = 0;
                                $sgst = 0;
                            }

                            $taxablePartsTotal += $taxable;
                            $cgstPartsTotal += $cgst;
                            $sgstPartsTotal += $sgst;
                        }

                        $taxablePartsTotal = round($taxablePartsTotal, 2);
                        $cgstPartsTotal = round($cgstPartsTotal, 2);
                        $sgstPartsTotal = round($sgstPartsTotal, 2);

                        $grossParts = $partsTotal + $cgstPartsTotal + $sgstPartsTotal;

                        $roundedGrossParts = round($grossParts);
                        $roundOffParts = round($roundedGrossParts - $grossParts, 2);
                    @endphp


                    @php
                        $colsCount = $logo && $logo->is_gst == 1 ? 11 : 9;
                    @endphp
                    <tr>
                        <td colspan="{{ $colsCount }}" class="text-end"><strong>Sub Total (Excl. Tax)</strong></td>
                        <td class="text-end"><strong>{{ number_format($taxablePartsTotal, 2) }}</strong></td>
                    </tr>

                    @if ($logo && $logo->is_gst == 1)
                        <tr>
                            <td colspan="{{ $colsCount }}" class="text-end">OUTPUT CGST</td>
                            <td class="text-end">{{ number_format($cgstPartsTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="{{ $colsCount }}" class="text-end">OUTPUT SGST</td>
                            <td class="text-end">{{ number_format($sgstPartsTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="{{ $colsCount }}" class="text-end">ROUND OFF</td>
                            <td class="text-end">
                                {{ $roundOffParts > 0 ? '' : '(-)' }}{{ number_format(abs($roundOffParts), 2) }}</td>
                        </tr>
                    @endif
                    <tfoot>
                        <tr>
                            <td colspan="{{ $colsCount - 2 }}" class="text-end"><strong>Total</strong></td>
                            <td class="text-center"><strong>{{ number_format($totalquentity) }} Qty</strong></td>
                            <td class="text-end"><strong>Total (Incl. Tax)</strong></td>
                            <td class="text-end"><strong>{{ number_format($partsTotal, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            @endif

            {{-- cgst sgst starts --}}

            @php
                $gstSummary = [];
                foreach ($countersales->counterSalesSpareParts ?? [] as $counterSparePart) {
                    $__sp = \App\Models\SparePart::find($counterSparePart->stock_label_id);
                    $hsn = $__sp->hsn_code ?? '-';

                    $totalGstRate = (float) ($__sp->tax_percentage ?? 0);
                    $final = (float) ($counterSparePart->final_amount ?? 0);
                    // Calculate exclusive taxable amount from inclusive final amount
                    $taxable = $totalGstRate > 0 ? $final / (1 + $totalGstRate / 100) : $final;

                    if (!isset($gstSummary[$hsn])) {
                        $gstSummary[$hsn] = [
                            'taxable' => 0.0,
                            'total_rate' => $totalGstRate,
                        ];
                    }

                    // If same HSN has mixed rates, keep the max (or latest) non-zero rate
                    if ($totalGstRate > 0) {
                        $gstSummary[$hsn]['total_rate'] = $totalGstRate;
                    }

                    $gstSummary[$hsn]['taxable'] += $taxable;
                }

                $sumTaxable = 0.0;
                $sumCgst = 0.0;
                $sumSgst = 0.0;
                $sumTax = 0.0;
            @endphp

            {{-- Extra Charges Table --}}
            @if (isset($countersales->extraCharges) && count($countersales->extraCharges) > 0)
                <div class="extraCharges my-3"><strong>Extra Charges</strong></div>
                <table class="table my-3">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Label</th>
                            @if ($logo->is_gst == 1)
                                <th>GST Type</th>
                                <th>GST %</th>
                            @endif
                            <th class="text-center">Charge Price(Rs.)</th>
                            <th class="text-center">Amount(Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $chargeTotal = 0; @endphp
                        @foreach ($countersales->extraCharges as $extraCharge)
                            <tr>
                                <td class="text-center" style="width:20px !important;">{{ $loop->iteration }}</td>
                                <td>{{ $extraCharge->label }}</td>
                                @if ($logo->is_gst == 1)
                                    <td>{{ $extraCharge->gst_type }}</td>
                                    <td>{{ $extraCharge->gst }}</td>
                                @endif
                                <td class="text-end" style="width:120px !important;">
                                    {{ number_format((float) $extraCharge->amount, 2) }}</td>
                                <td class="text-end" style="width:120px !important;">
                                    {{ number_format((float) $extraCharge->charges, 2) }}</td>
                            </tr>
                            @php $chargeTotal += (float)$extraCharge->charges; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            @php $extraCols = ($logo && $logo->is_gst == 1) ? 5 : 3; @endphp
                            <td class="text-end" colspan="{{ $extraCols }}"><strong>Total(Rs.)</strong></td>
                            <td class="text-end"><strong>{{ number_format($chargeTotal, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
                {{-- Word amount removed from summary --}}
            @endif

            @if (!empty($gstSummary) && $logo->is_gst == 1)
                <div class="extraCharges my-3"><strong>CGST/SGST Summary</strong></div>
                <table class="table my-3">
                    <thead>
                        <tr>
                            <th class="text-center">HSN/SAC</th>
                            <th class="text-end">Taxable Value (Rs.)</th>
                            <th class="text-center">CGST</th>
                            <th class="text-end">Amount (Rs.)</th>
                            <th class="text-center">SGST/UTGST</th>
                            <th class="text-end">Amount (Rs.)</th>
                            <th class="text-end">Total Tax Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gstSummary as $hsn => $row)
                            @php
                                // Taxable is the subtotal of the "Amount" column for this HSN from the upper table
                                $taxable = (float) $row['taxable'];
                                $halfRate = max(0, (float) $row['total_rate']) / 2.0;
                                $cgst = ($taxable * $halfRate) / 100.0;
                                $sgst = ($taxable * $halfRate) / 100.0;
                                $totalTax = $cgst + $sgst;

                                $sumTaxable += $taxable;
                                $sumCgst += $cgst;
                                $sumSgst += $sgst;
                                $sumTax += $totalTax;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $hsn }}</td>
                                <td class="text-end">{{ number_format($taxable, 2) }}</td>
                                <td class="text-center">{{ rtrim(rtrim(number_format($halfRate, 2), '0'), '.') }}%
                                </td>
                                <td class="text-end">{{ number_format($cgst, 2) }}</td>
                                <td class="text-center">{{ rtrim(rtrim(number_format($halfRate, 2), '0'), '.') }}%
                                </td>
                                <td class="text-end">{{ number_format($sgst, 2) }}</td>
                                <td class="text-end">{{ number_format($totalTax, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-end"><strong>Total</strong></td>
                            <td class="text-end"><strong>{{ number_format($sumTaxable, 2) }}</strong></td>
                            <td></td>
                            <td class="text-end"><strong>{{ number_format($sumCgst, 2) }}</strong></td>
                            <td></td>
                            <td class="text-end"><strong>{{ number_format($sumSgst, 2) }}</strong></td>
                            <td class="text-end"><strong>{{ number_format($sumTax, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
                {{-- Word amount removed from summary --}}
            @endif

            <table class="table" style="margin-top: 30px;">
                <tbody>
                    <tr>
                        <th></th>
                        <th colspan="2">Bill Amount Details:</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 120px !important;">
                            <p class="text-end m-0"><strong>Payment Type</strong></p>
                            <p class="text-end m-0"><strong>Total Amount(Rs.)</strong></p>
                            <p class="text-end m-0"><strong>Discount(Rs.) </strong></p>
                            <p class="text-end m-0"><strong>Partial Amount</strong></p>
                            <p class="text-end m-0"><strong>Remaining Balance</strong></p>
                            <p class="text-end m-0"><strong>Total Paid</strong></p>
                        </td>
                        <td style="width: 120px !important;">
                            <p class="text-end m-0"><strong>{{ ucfirst($countersales->payment_type) }}</strong></p>
                            <p class="text-end m-0"><strong>{{ number_format($countersales->total, 2) }}</strong></p>
                            <p class="text-end m-0">
                                <strong>{{ number_format($countersales->total - $countersales->subtotal, 2) }}</strong>
                            </p>
                            <p class="text-end m-0">
                                <strong>{{ number_format((float) ($countersales->partial_amount ?? 0), 2) }}</strong>
                            </p>
                            <p class="text-end m-0">
                                <strong>{{ number_format($countersales->balance_amount, 2) }}</strong>
                            </p>
                            <p class="text-end m-0">
                                <strong>
                                    @if ($countersales->payment_type == 'total')
                                        {{ number_format($countersales->total, 2) }}
                                    @else
                                        {{ number_format((float) ($countersales->partial_amount ?? 0), 2) }}
                                    @endif
                                </strong>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="p-0 border-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Invoice Amount In Words</th>
                                        <th>Authorised Signature and Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            @php
                                                // ✅ Decide amount based on payment type
                                                $amount =
                                                    $countersales->payment_type == 'total'
                                                        ? $countersales->subtotal
                                                        : $countersales->partial_amount;

                                                echo ucfirst(getAmountInWords($amount)) . ' Rupees Only';
                                            @endphp

                                        </td>
                                        <td {{-- background-color:#78e4d2 --}}
                                            style="width:250px !important;vertical-align: bottom;height:80px;position:relative; ">

                                            <div style="display:inline-block; padding:10px; margin-top:60px;">
                                                <img src="{{ file_exists(public_path($logo?->SignImage?->file))
                                                    ? 'data:image/png;base64,' . base64_encode(file_get_contents(public_path($logo->SignImage->file)))
                                                    : 'path/to/default/image.png' }}"
                                                    alt="Logo" class="logo"
                                                    style="display:block; max-width: 150px;">
                                            </div>

                                            @if (!empty($countersales->payment_type) && $countersales->payment_type == 'total')
                                                <div style="position:absolute;bottom:0;right:40px;  top:10px; ">
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/jobcard_img/paid_stamp.png'))) }}"
                                                        alt="Logo" width="120">
                                                </div>
                                            @else
                                                <div style="position:absolute;bottom:0;right:70px; top:10px; ">
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/jobcard_img/partial_paid.png'))) }}"
                                                        alt="Logo" width="120">
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>



                    <tr>
                        <td colspan="3" class="p-0 border-0">
                            <table class="table">
                                <tr>
                                    <th><strong> Note</strong></th>
                                </tr>
                                <tr>
                                    <td>{{ $countersales?->note ?? '' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
