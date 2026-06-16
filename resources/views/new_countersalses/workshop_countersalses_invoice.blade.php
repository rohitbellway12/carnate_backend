<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::guard('workshop')->user()?->display_name ?? 'Invoice' }}</title>

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
        // Prioritize logo passed from controller (which is fetched from record owner)
        // Fallback to Auth only if needed (for previews/legacy)
        if (!isset($logo) || !$logo) {
            $workshopUser = Auth::guard('workshop')->user();
            if ($workshopUser) {
                $logo = App\Models\WorkShopVendor::with(['Image', 'SignImage'])->where('id', $workshopUser->id)->first();
            }
        }
        
        $logoImage = null;
        if ($logo && $logo->Image && !empty($logo->Image->file)) {
            try {
                $logoPath = public_path($logo->Image->file);
                if (file_exists($logoPath)) {
                    $logoImage = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
                }
            } catch (\Exception $e) {
                $logoImage = null;
            }
        }

        $signImage = null;
        if ($logo && $logo->SignImage && !empty($logo->SignImage->file)) {
            try {
                $signPath = public_path($logo->SignImage->file);
                if (file_exists($signPath)) {
                    $signImage = 'data:image/png;base64,' . base64_encode(file_get_contents($signPath));
                }
            } catch (\Exception $e) {
                $signImage = null;
            }
        }
    @endphp

    <div class="container">
        <div class="inner-container header">

            @if (($countersales->is_gst ?? ($logo->is_gst ?? 0)) == 1)
                <div class="text-center" style="margin-bottom: 10px;">TAX INVOICE</div>
            @else
                <div class="text-center" style="margin-bottom: 10px;">CASH INVOICE</div>
            @endif

        {{-- Top Header Section --}}
      <table width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
    <tr>

        <!-- Logo -->
        <td width="20%" valign="middle" align="left" style="padding:10px 0;">
            @if($logoImage)
                <img src="{{ $logoImage }}"
                     style="max-width:120px; height:auto;">
            @endif
        </td>

        <!-- Gap -->
        <td width="5%"></td>

        <!-- Company Details -->
        <td width="75%" align="right" valign="top" style="padding:10px 0;">

            @php
                $vendor = Auth::guard('workshop')->user();
            @endphp

            <div style="
    font-size:16px;
    font-weight:bold;
    color:#2c3e50;
    margin-bottom:2px;">
    {{ $logo->branch_name ?? 'Workshop' }}
</div>

@if(!empty($logo->tagline))
    <div style="
        font-size:12px;
        color:#777;
        font-style:italic;
        margin-bottom:5px;">
        {{ $logo->tagline }}
    </div>
@endif

<!-- Line yaha -->
<div style="
    border-bottom:1px solid #000;
    margin:5px 0 8px 0;
"></div>

<div style="font-size:12px; line-height:18px;">
    <strong>Phone:</strong> {{ $logo->mobile_no ?? 'NA' }}
</div>

<div style="font-size:12px; line-height:18px;">
    <strong>Email:</strong> {{ $logo->email ?? 'NA' }}
</div>

            <div style="font-size:12px; line-height:18px;">
                <strong>Address:</strong>
                {{ $vendor->address ?? '-' }},
                {{ $vendor->cityName?->name ?? '-' }},
                {{ $vendor->stateName?->name ?? '-' }},
                {{ $vendor->countryName?->name ?? '-' }}
                {{ $vendor->pincode ?? '-' }}
            </div>

            @if (($countersales->is_gst ?? ($logo->is_gst ?? 0)) == 1 && !empty($logo->gst))
                <div style="font-size:12px; line-height:18px;">
                    <strong>GSTIN:</strong>
                    {{ $logo->gst }}
                </div>
            @endif

        </td>
    </tr>

    <!-- Horizontal Line -->
    {{-- <tr>
        <td></td>
            <td colspan="2">
                <div style="
                    border-bottom:1px solid #000;
                    margin-top:5px;
                    width:100%;
                "></div>
            </td>
    </tr> --}}
</table>

        {{-- Bill From / Bill To Section --}}
        <table class="table" style="margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="width: 50%; background-color: #B6CDEF; color: #000; font-weight: bold;">Customer Details</th>
                    <th style="width: 50%; background-color: #B6CDEF; color: #000; font-weight: bold;">Invoice Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                    <td style="vertical-align: top; padding: 10px;">
                      
                        <div style="font-size: 11px; line-height: 1.4; margin-top: 8px;">
                              <p style="margin: 2px 0;"><strong>Name:</strong> {{ $countersales->Customer?->name }} {{ $countersales->Customer?->lastname }}</p>
                            <p style="margin: 2px 0;"><strong>Mobile:</strong> {{ $countersales->Customer?->mobile_no ?? 'NA' }}</p>
                            <p style="margin: 2px 0;"><strong>Email:</strong> {{ $countersales->Customer?->email ?? 'NA' }}</p>
                            <p style="margin: 2px 0;"><strong>Address:</strong> {{ $countersales->Customer?->address ?? 'NA' }}</p>
                            @if (($countersales->is_gst ?? ($logo->is_gst ?? 0)) == 1 && !empty($countersales->Customer?->gst_number))
                                <p style="margin: 2px 0;"><strong>GSTIN:</strong> {{ $countersales->Customer?->gst_number }}</p>
                            @endif
                            
                        </div>
                    </td>
                    <td style="vertical-align: top; padding: 10px;">
                        <div style="font-size: 11px; line-height: 1.4;">
                               <p style="margin: 0 0 5px 0; font-size: 12px; color: #000;">
                        <strong>Invoice No:</strong> {{ $countersales->countersale_number }}
                    </p>
                    <p style="margin: 5px 0; font-size: 12px;">
                        <strong>Date:-</strong> {{ \Carbon\Carbon::parse($countersales->created_at)->format('d-m-Y h:i A') }}
                    </p>
                    <p style="margin: 2px 0; font-size: 12px;">
                        <strong>Total Items:-</strong> {{ count($countersales->counterSalesSpareParts) }}
                    </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

            @if (count($countersales->counterSalesSpareParts) > 0)
                <!--<div class="partCharges my-3"><strong>Parts Charges</strong></div>-->

                <table class="table my-3">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th colspan="4" class="text-center">Particulars</th>
                            @if (($countersales->is_gst ?? ($logo->is_gst ?? 0)) == 1)
                                <th class="text-center">HSN Number</th>
                            @endif
                            <th class="text-center">QTY</th>
                            <th class="text-center">unit</th>
                            <th class="text-center">Unit Price (Rs.)</th>
                            @if (($countersales->is_gst ?? $logo->is_gst) == 1)
                                <th class="text-center">Tax</th>
                            @endif
                            <th class="text-center">Discount(Rs.)</th>
                            <th class="text-center">Amount(Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $partsTotal = 0; // This will store the sum of final_amount (Inclusive)
                            $totalTaxableAmount = 0;
                            $totalquentity = 0;
                        @endphp
                        @foreach ($countersales->counterSalesSpareParts as $counterSparePart)
                            @php
                                $__sp = \App\Models\ProductStock::find($counterSparePart->stock_label_id);
                                $__hsn = $__sp->hsn_code ?? '-';
                                $__unitTitle = $__sp?->unit?->title ?? '-';
                                $__taxPercentage = (float)($__sp->tax_percentage ?? 0);
                                $__taxType = $__sp->tax_type ?? 'exclude';
                                
                                $finalRowAmount = (float)$counterSparePart->final_amount;
                                $__quantity = (float)($counterSparePart->quantity ?? 1);
                                $__price = (float)($counterSparePart->price ?? 0);
                                
                                if ($__taxPercentage > 0) {
                                    if ($__taxType == 'include') {
                                        $__taxablePrice = round($__price / (1 + $__taxPercentage / 100), 2);
                                        $__taxAmt = round(($__taxablePrice * $__taxPercentage) / 100, 2) * $__quantity;
                                    } else {
                                        $__taxAmt = round(($__price * $__taxPercentage) / 100, 2) * $__quantity;
                                    }
                                } else {
                                    $__taxAmt = 0;
                                }

                                // Back-calculate taxable amount for the row
                                if (($countersales->is_gst ?? ($logo->is_gst ?? 0)) == 1 && $__taxPercentage > 0) {
                                    $rowTaxable = round($finalRowAmount / (1 + ($__taxPercentage / 100)), 2);
                                } else {
                                    $rowTaxable = $finalRowAmount;
                                }
                                
                                $partsTotal += $finalRowAmount;
                                $totalTaxableAmount += $rowTaxable;
                                $totalquentity += $__quantity;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>

                                <td colspan="4">{{ $counterSparePart->stock_label_name }}</td>
                                
                                @if (($countersales->is_gst ?? ($logo->is_gst ?? 0)) == 1)
                                    <td class="text-center" style="width:50px !important;">{{ $__hsn }}</td>
                                @endif
                                <td class="text-center" style="width:60px !important;">
                                    {{ $counterSparePart->quantity }}</td>
                                <td class="text-center" style="width:60px !important;">{{ $__unitTitle }}</td>

                                <td class="text-start" style="width:60px !important;">
                                    {{ number_format($counterSparePart->price, 2) }}
                                </td>
                                @if (($countersales->is_gst ?? ($logo->is_gst ?? 0)) == 1)
                                    <td class="text-center" style="width:80px !important;">
                                        @if ($__taxPercentage > 0)
                                            {{ $__taxPercentage }}% {{ $__taxType == 'include' ? '(Inc)' : '(Exc)' }}<br>
                                            @if ($__taxType == 'include')
                                                <span style="color:#c0392b;">(- {{ number_format($__taxAmt, 2) }})</span>
                                            @else
                                                <span style="color:#27ae60;">(+ {{ number_format($__taxAmt, 2) }})</span>
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
                                    {{ number_format($rowTaxable, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    @php
                        $cgstPartsTotal = 0;
                        $sgstPartsTotal = 0;

                        foreach ($countersales->counterSalesSpareParts as $__rowSum) {
                            $__sp = \App\Models\ProductStock::find($__rowSum->stock_label_id);
                            $rate = (float) ($__sp->tax_percentage ?? 0);
                            $final = (float) ($__rowSum->final_amount ?? 0);
                            
                            if ($rate > 0) {
                                $taxable = $final / (1 + $rate / 100);
                                $gstAmt = $final - $taxable;
                                $cgstPartsTotal += $gstAmt / 2;
                                $sgstPartsTotal += $gstAmt / 2;
                            }
                        }

                        $grossParts = $partsTotal; // partsTotal is already sum of final_amount (Inclusive)
                        $roundedGrossParts = round($grossParts);
                        $roundOffParts = round($roundedGrossParts - $grossParts, 2);
                    @endphp

                    @php
                        $colsCount = ($countersales->is_gst ?? ($logo->is_gst ?? 0)) == 1 ? 11 : 9;
                    @endphp
                    <tr>
                        <td colspan="{{ $colsCount }}" class="text-end"><strong>Sub Total</strong></td>
                        <td class="text-end"><strong>{{ number_format($totalTaxableAmount, 2) }}</strong></td>
                    </tr>

                    @if (($countersales->is_gst ?? ($logo->is_gst ?? 0)) == 1)
                        <tr>
                            <td colspan="{{ $colsCount }}" class="text-end">OUTPUT CGST</td>
                            <td class="text-end">{{ number_format($cgstPartsTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="{{ $colsCount }}" class="text-end">OUTPUT SGST</td>
                            <td class="text-end">{{ number_format($sgstPartsTotal, 2) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="{{ $colsCount }}" class="text-end">ROUND OFF</td>
                        <td class="text-end">
                            {{ $roundOffParts > 0 ? '' : '(-)' }}{{ number_format(abs($roundOffParts), 2) }}</td>
                    </tr>
                    <tfoot>
                        <tr>
                            <td colspan="{{ $colsCount - 2 }}" class="text-end"><strong>Total</strong></td>
                            <td class="text-center"><strong>{{ number_format($totalquentity) }} Qty</strong></td>
                            <td class="text-end"><strong>Total(Rs.)</strong></td>
                            <td class="text-end"><strong>{{ number_format($grossParts, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            @endif

            {{-- cgst sgst starts --}}

            @php
                $gstSummary = [];
                foreach ($countersales->counterSalesSpareParts ?? [] as $counterSparePart) {
                    $__sp = \App\Models\ProductStock::find($counterSparePart->stock_label_id);
                    $hsn = $__sp->hsn_code ?? '-';

                    $totalGstRate = (float) ($__sp->tax_percentage ?? 0);
                    $taxable = (float) ($counterSparePart->final_amount ?? 0);

                    if (!isset($gstSummary[$hsn])) {
                        $gstSummary[$hsn] = [
                            'taxable' => 0.0,
                            'total_rate' => $totalGstRate,
                        ];
                    }

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

            @if (!empty($gstSummary) && ($countersales->is_gst ?? ($logo->is_gst ?? 0)) == 1)
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
                                $taxable = (float) $row['taxable'];
                                $totalRate = max(0, (float) $row['total_rate']);
                                
                                // Correct back-calculation for summary as well
                                if ($totalRate > 0) {
                                    $taxableValue = $taxable / (1 + ($totalRate / 100));
                                } else {
                                    $taxableValue = $taxable;
                                }
                                $totalTax = $taxable - $taxableValue;
                                
                                $cgst = $totalTax / 2.0;
                                $sgst = $totalTax / 2.0;

                                $sumTaxable += $taxableValue;
                                $sumCgst += $cgst;
                                $sumSgst += $sgst;
                                $sumTax += $totalTax;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $hsn }}</td>
                                <td class="text-end">{{ number_format($taxableValue, 2) }}</td>
                                <td class="text-center">{{ rtrim(rtrim(number_format($totalRate / 2, 2), '0'), '.') }}%
                                </td>
                                <td class="text-end">{{ number_format($cgst, 2) }}</td>
                                <td class="text-center">{{ rtrim(rtrim(number_format($totalRate / 2, 2), '0'), '.') }}%
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
                            <p class="text-end m-0"><strong>{{ number_format($roundedGrossParts, 2) }}</strong></p>
                            @php
                                $totalDiscountSum = 0;
                                foreach ($countersales->counterSalesSpareParts as $row) {
                                    $totalDiscountSum += (float)($row->discount ?? 0);
                                }
                            @endphp
                            <p class="text-end m-0">
                                <strong>{{ number_format($totalDiscountSum, 2) }}</strong>
                            </p>
                            <p class="text-end m-0">
                                <strong>{{ number_format((float) ($countersales->partial_amount ?? 0), 2) }}</strong>
                            </p>
                            <p class="text-end m-0">
                                <strong>{{ number_format(max(0, $roundedGrossParts - ($countersales->partial_amount ?? 0)), 2) }}</strong>
                            </p>
                            <p class="text-end m-0">
                                <strong>
                                    @if ($countersales->payment_type == 'total')
                                        {{ number_format($roundedGrossParts, 2) }}
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
                                                $amount =
                                                    $countersales->payment_type == 'total'
                                                        ? $countersales->subtotal
                                                        : $countersales->partial_amount;

                                                echo ucfirst(getAmountInWords($amount)) . ' Rupees Only';
                                            @endphp

                                        </td>
                                        <td
                                            style="width:250px !important;vertical-align: bottom;height:80px;position:relative;">
                                            <div style="display:inline-block; padding:10px; margin-top:40px;">
                                                @if($signImage)
                                                    <img src="{{ $signImage }}"
                                                        alt="Signature" class="logo"
                                                        style="display:block; max-width: 150px;">
                                                @endif
                                            </div>
                                            @if (!empty($countersales->payment_type) && $countersales->payment_type == 'total')
                                                <div style="position:absolute;bottom:0;right:20px; top:20px;">
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/jobcard_img/paid_stamp.png'))) }}"
                                                        alt="Logo" width="120">
                                                </div>
                                            @else
                                                <!--<div style="position:absolute;bottom:0;right:20px; top:20px;">-->
                                                <!--    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/jobcard_img/partial_paid.png'))) }}"-->
                                                <!--        alt="Logo" width="120">-->
                                                <!--</div>-->
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
