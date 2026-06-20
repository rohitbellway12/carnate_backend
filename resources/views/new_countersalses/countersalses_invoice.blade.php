<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::guard('sparepart')->user()?->display_name ?? 'Invoice' }}</title>

    <style>
        /* ============================================
           BASE STYLES
           ============================================ */
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

        /* ============================================
           TABLE STYLES
           ============================================ */
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            color: #333;
        }

        .table th,
        .table td {
            padding: 5px 8px;
            font-size: 12px;
            border: 1px solid black;
            text-align: left;
            color: black;
        }

        .table th {
            background-color: #E3F2FD;
        }

        /* ============================================
           TEXT ALIGNMENT UTILITIES
           ============================================ */
        .text-center {
            text-align: center !important;
        }

        .text-end {
            text-align: right !important;
        }

        .text-start {
            text-align: left !important;
        }

        /* ============================================
           TEXT COLOR UTILITIES
           ============================================ */
        .text-success {
            color: #27ae60;
        }

        .text-danger {
            color: #c0392b;
        }

        /* ============================================
           PADDING UTILITIES
           ============================================ */
        .p-0 {
            padding: 0px !important;
        }

        .p-5 {
            padding: 5px !important;
        }

        /* ============================================
           MARGIN UTILITIES
           ============================================ */
        .m-0 {
            margin: 0px !important;
        }

        .mb-2 {
            margin-bottom: 2px !important;
        }

        .mb-5 {
            margin-bottom: 5px !important;
        }

        .my-3 {
            margin: 10px 0 !important;
        }

        .mt-30 {
            margin-top: 30px !important;
        }

        /* ============================================
           BORDER UTILITIES
           ============================================ */
        .border-0 {
            border: 0px !important;
        }

        .border-bottom-2 {
            border-bottom: 2px solid #2c3e50;
        }

        /* ============================================
           FONT SIZE UTILITIES
           ============================================ */
        .fs-11 {
            font-size: 11px;
        }

        .fs-24 {
            font-size: 24px;
        }

        /* ============================================
           FONT WEIGHT UTILITIES
           ============================================ */
        .fw-bold {
            font-weight: bold;
        }

        .fw-600 {
            font-weight: 600;
        }

        /* ============================================
           WIDTH UTILITIES
           ============================================ */
        .w-50 {
            width: 50% !important;
        }

        .w-120 {
            width: 120px !important;
        }

        .w-250 {
            width: 250px !important;
        }

        /* ============================================
           VERTICAL ALIGN UTILITIES
           ============================================ */
        .align-top {
            vertical-align: top;
        }

        .align-bottom {
            vertical-align: bottom;
        }

        /* ============================================
           POSITION UTILITIES
           ============================================ */
        .position-relative {
            position: relative;
        }

        /* ============================================
           SIGNATURE STYLES
           ============================================ */
        .signature-container {
            display: inline-block;
            padding: 10px;
            margin-top: 40px;
        }

        .signature-img {
            display: block;
            max-width: 150px;
        }

        /* ============================================
           PAID STAMP STYLES
           ============================================ */
        .paid-stamp {
            position: absolute;
            bottom: 0;
            right: 20px;
            top: 20px;
        }

        .paid-stamp img {
            width: 120px;
        }

        /* ============================================
           PRINT STYLES
           ============================================ */
        @media print {
            body {
                background-color: #ffffff;
            }
            
            .table th {
                background-color: #E3F2FD !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
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
        $isGst = $logo && $logo->is_gst == 1;

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

        // Get city, state, country names
        $stateName = '';
        if(!empty($vendor->state_id)) {
            $state = \App\Models\State::find($vendor->state_id);
            $stateName = $state->name ?? '';
        }
        
        $cityName = '';
        if(!empty($vendor->city_id)) {
            $city = \App\Models\City::find($vendor->city_id);
            $cityName = $city->name ?? '';
        }
        
        $countryName = '';
        if(!empty($vendor->country_id)) {
            $country = \App\Models\Country::find($vendor->country_id);
            $countryName = $country->name ?? '';
        }
    @endphp

    <div class="container">
        <div class="inner-container">

            {{-- Invoice Type Header --}}
            <div class="text-center mb-5 fw-bold fs-24">
                @if ($isGst)
                    <span style="color: #000000; font-weight: bold; font-size: 24px;">TAX INVOICE</span>
                @else
                    <span style="color: #388E3C; font-weight: bold; font-size: 24px;">CASH INVOICE</span>
                @endif
            </div>

            {{-- Header Section with Logo and Company Details --}}
            <table class="table my-3" style="border: none;">
                <tbody>
                    <tr>
                        {{-- Logo Column --}}
                        <td class="p-0 border-0" style="width: 30%; vertical-align: top; padding-right: 15px; border: none;">
                            @if ($logoImage)
                                <img src="{{ $logoImage }}" alt="Logo" style="max-width: 160px; border-radius: 8px;">
                            @endif
                        </td>
                        
                        {{-- Company Details Column --}}
                        <td class="p-0 border-0" style="width: 70%; vertical-align: top; border: none;">
                            {{-- Header Section --}}
                            <div class="border-bottom-2" style="margin-bottom: 10px; padding-bottom: 5px;">
                                <h2 style="font-size: 22px; margin: 0; text-align: right; color: #2c3e50;">
                                    {{ $logo->branch_name ?? ($vendor->company_name ?? $vendor->name ?? 'Spare Part Vendor') }}
                                </h2>
                                @if(!empty($logo->tagline))
                                    <p style="font-size: 11px; margin: 3px 0 0 0; text-align: right; color: #7f8c8d;">
                                        {{ $logo->tagline }}
                                    </p>
                                @endif
                            </div>
                            
                            {{-- Contact Information --}}
                            <div style="text-align: right;">
                                <div style="margin-bottom: 5px; font-size: 11px;">
                                    <span class="fw-600">Email:</span> 
                                    {{ $vendor->email ?? 'N/A' }}
                                    &nbsp;&nbsp;|&nbsp;&nbsp;
                                    <span class="fw-600">Phone:</span> 
                                    {{ $vendor->mobile_no ?? 'N/A' }}
                                </div>
                                
                                @if(!empty($vendor->address))
                                    <div style="margin-bottom: 3px; font-size: 11px;">
                                        <span class="fw-600">Address:</span> 
                                        {{ $vendor->address }}
                                    </div>
                                @endif
                                
                                @if(!empty($cityName) || !empty($stateName) || !empty($countryName))
                                    <div style="margin-bottom: 3px; font-size: 11px;">
                                        <span class="fw-600">Location:</span> 
                                        {{ $cityName }}
                                        {{ !empty($cityName) && !empty($stateName) ? ',' : '' }}
                                        {{ $stateName }}
                                        {{ (!empty($cityName) || !empty($stateName)) && !empty($countryName) ? ',' : '' }}
                                        {{ $countryName }}
                                    </div>
                                @endif
                                
                                @if(!empty($vendor->pincode))
                                    <div style="margin-bottom: 3px; font-size: 11px;">
                                        <span class="fw-600">Pincode:</span> 
                                        {{ $vendor->pincode }}
                                    </div>
                                @endif
                                
                                @if($isGst && !empty($vendor->gst_number))
                                    <div style="margin-top: 5px; font-size: 11px;">
                                        <span class="fw-600">GST No.:</span> 
                                        {{ $vendor->gst_number }}
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- Customer Info | Invoice Details - Equal width with fixed size --}}
            <table class="table my-3">
                <thead>
                    <tr>
                        <th style="width: 50%;">Customer Info</th>
                        <th style="width: 50%;">Invoice Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-top" style="width: 50%;">
                            <p class="m-0 mb-2"><strong>Name:-</strong> {{ $countersales->Customer?->name }} {{ $countersales->Customer?->lastname }}</p>
                            @if (!empty($countersales->Customer?->mobile_no))
                                <p class="m-0 mb-2"><strong>Mobile No:-</strong> {{ $countersales->Customer?->mobile_no ?? 'NA' }}</p>
                            @endif
                            @if (!empty($countersales->Customer?->email))
                                <p class="m-0 mb-2"><strong>Email:-</strong> {{ $countersales->Customer?->email ?? 'NA' }}</p>
                            @endif
                            @if (!empty($countersales->Customer?->address))
                                <p class="m-0 mb-2"><strong>Address:-</strong> {{ $countersales->Customer?->address ?? 'NA' }}</p>
                            @endif
                            @if ($isGst && !empty($countersales->Customer?->gst_number))
                                <p class="m-0 mb-2"><strong>GST No:-</strong> {{ $countersales->Customer?->gst_number ?? 'NA' }}</p>
                            @endif
                        </td>
                        <td class="align-top" style="width: 50%;">
                            <p class="m-0 mb-2"><strong>Invoice Number:-</strong> {{ $countersales->countersale_number }}</p>
                            <p class="m-0 mb-2"><strong>Date:-</strong> {{ \Carbon\Carbon::parse($countersales->created_at)->format('M d Y, h:i A') }}</p>
                            <p class="m-0 mb-2"><strong>Total Items:-</strong> {{ count($countersales->counterSalesSpareParts) }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            @if (count($countersales->counterSalesSpareParts) > 0)
                <div class="my-3"><strong>Parts Charges</strong></div>

                {{-- Parts table with proper structure --}}
                <table class="table" style="border-collapse: collapse; width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 4%;">#</th>
                            <th class="text-center" style="width: 22%;">Particulars</th>
                            @if ($isGst)
                                <th class="text-center" style="width: 10%;">HSN Number</th>
                            @endif
                            <th class="text-center" style="width: 6%;">QTY</th>
                            <th class="text-center" style="width: 7%;">Unit</th>
                            <th class="text-center" style="width: 11%;">Unit Price (Rs.)</th>
                            @if ($isGst)
                                <th class="text-center" style="width: 11%;">Tax (Rs.)</th>
                            @endif
                            <th class="text-center" style="width: 9%;">Discount (Rs.)</th>
                            <th class="text-center" style="width: 10%;">Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $partsTotal = 0;
                            $totalTaxableAmount = 0;
                            $totalQuantity = 0;
                            $totalDiscountSum = 0;
                        @endphp
                        @foreach ($countersales->counterSalesSpareParts as $counterSparePart)
                            @php
                                $__sp = \App\Models\SparePart::find($counterSparePart->stock_label_id);
                                $__hsn = $__sp->hsn_code ?? '-';
                                $__unitTitle = $__sp?->unit?->title ?? '-';
                                $__taxPercentage = (float) ($__sp->tax_percentage ?? 0);
                                $__taxType = $__sp->tax_type ?? 'exclude';
                                $__discount = (float) ($counterSparePart->discount ?? 0);

                                $finalRowAmount = (float) $counterSparePart->final_amount;
                                $__quantity = (float) ($counterSparePart->quantity ?? 1);
                                $__price = (float) ($counterSparePart->price ?? 0);

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

                                if ($isGst && $__taxPercentage > 0) {
                                    $rowTaxable = round($finalRowAmount / (1 + $__taxPercentage / 100), 2);
                                } else {
                                    $rowTaxable = $finalRowAmount;
                                }

                                $partsTotal += $finalRowAmount;
                                $totalTaxableAmount += $rowTaxable;
                                $totalQuantity += $__quantity;
                                $totalDiscountSum += $__discount;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $counterSparePart->stock_label_name }}</td>
                                @if ($isGst)
                                    <td class="text-center">{{ $__hsn }}</td>
                                @endif
                                <td class="text-center">{{ $counterSparePart->quantity }}</td>
                                <td class="text-center">{{ $__unitTitle }}</td>
                                <td class="text-end">{{ number_format($counterSparePart->price, 2) }}</td>
                                @if ($isGst)
                                    <td class="text-center">
                                        @if ($__taxPercentage > 0)
                                            {{ $__taxPercentage }}% {{ $__taxType == 'include' ? '(Inc)' : '(Exc)' }}<br>
                                            @if ($__taxType == 'include')
                                                <span class="text-danger">(- {{ number_format($__taxAmt, 2) }})</span>
                                            @else
                                                <span class="text-success">(+ {{ number_format($__taxAmt, 2) }})</span>
                                            @endif
                                        @else
                                            0.00
                                        @endif
                                    </td>
                                @endif
                                <td class="text-end">{{ number_format($__discount, 2) }}</td>
                                <td class="text-end">{{ number_format($rowTaxable, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                    @php
                        $cgstPartsTotal = 0;
                        $sgstPartsTotal = 0;

                        foreach ($countersales->counterSalesSpareParts as $__rowSum) {
                            $__sp = \App\Models\SparePart::find($__rowSum->stock_label_id);
                            $rate = (float) ($__sp->tax_percentage ?? 0);
                            $final = (float) ($__rowSum->final_amount ?? 0);

                            if ($rate > 0) {
                                $taxable = $final / (1 + $rate / 100);
                                $gstAmt = $final - $taxable;
                                $cgstPartsTotal += $gstAmt / 2;
                                $sgstPartsTotal += $gstAmt / 2;
                            }
                        }

                        $grossParts = $partsTotal;
                        $roundedGrossParts = round($grossParts);
                        $roundOffParts = round($roundedGrossParts - $grossParts, 2);
                    @endphp

                    {{-- Totals Section --}}
                    @if ($isGst)
                        {{-- With GST: 9 columns: #, Particulars, HSN, QTY, Unit, Unit Price, Tax, Discount, Amount --}}
                        <tr>
                            <td colspan="8" class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Sub Total</strong></td>
                            <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($totalTaxableAmount, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-end" style="padding: 5px 8px; border: 1px solid black;">OUTPUT CGST</td>
                            <td class="text-end" style="padding: 5px 8px; border: 1px solid black;">{{ number_format($cgstPartsTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-end" style="padding: 5px 8px; border: 1px solid black;">OUTPUT SGST</td>
                            <td class="text-end" style="padding: 5px 8px; border: 1px solid black;">{{ number_format($sgstPartsTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-end" style="padding: 5px 8px; border: 1px solid black;">ROUND OFF</td>
                            <td class="text-end" style="padding: 5px 8px; border: 1px solid black;">
                                @if ($roundOffParts > 0)
                                    {{ number_format($roundOffParts, 2) }}
                                @elseif ($roundOffParts < 0)
                                    (-{{ number_format(abs($roundOffParts), 2) }})
                                @else
                                    0.00
                                @endif
                            </td>
                        </tr>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Total</strong></td>
                                <td class="text-center" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($totalQuantity) }} Qty</strong></td>
                                <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Total (Rs.)</strong></td>
                                <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($grossParts, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    @else
                        {{-- Without GST: 8 columns: #, Particulars, QTY, Unit, Unit Price, Discount, Amount --}}
                        <tr>
                            <td colspan="7" class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Sub Total</strong></td>
                            <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($totalTaxableAmount, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-end" style="padding: 5px 8px; border: 1px solid black;">ROUND OFF</td>
                            <td class="text-end" style="padding: 5px 8px; border: 1px solid black;">
                                @if ($roundOffParts > 0)
                                    {{ number_format($roundOffParts, 2) }}
                                @elseif ($roundOffParts < 0)
                                    (-{{ number_format(abs($roundOffParts), 2) }})
                                @else
                                    0.00
                                @endif
                            </td>
                        </tr>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Total</strong></td>
                                <td class="text-center" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($totalQuantity) }} Qty</strong></td>
                                <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Total (Rs.)</strong></td>
                                <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($grossParts, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            @endif

            {{-- Extra Charges Table --}}
            @if (isset($countersales->extraCharges) && count($countersales->extraCharges) > 0)
                <div class="my-3"><strong>Extra Charges</strong></div>
                <table class="table my-3">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:5%;">#</th>
                            <th style="width:40%;">Label</th>
                            @if ($isGst)
                                <th class="text-center" style="width:15%;">GST Type</th>
                                <th class="text-center" style="width:10%;">GST %</th>
                            @endif
                            <th class="text-end" style="width:15%;">Charge Price (Rs.)</th>
                            <th class="text-end" style="width:15%;">Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $chargeTotal = 0; @endphp
                        @foreach ($countersales->extraCharges as $extraCharge)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $extraCharge->label }}</td>
                                @if ($isGst)
                                    <td class="text-center">{{ $extraCharge->gst_type ?? '-' }}</td>
                                    <td class="text-center">{{ $extraCharge->gst ?? '-' }}</td>
                                @endif
                                <td class="text-end">{{ number_format((float) $extraCharge->amount, 2) }}</td>
                                <td class="text-end">{{ number_format((float) $extraCharge->charges, 2) }}</td>
                            </tr>
                            @php $chargeTotal += (float)$extraCharge->charges; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            @php $extraCols = $isGst ? 4 : 3; @endphp
                            <td colspan="{{ $extraCols }}" class="text-end"><strong>Total (Rs.)</strong></td>
                            <td class="text-end"><strong>{{ number_format($chargeTotal, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            @endif

            {{-- CGST/SGST Summary Section --}}
            @php
                $gstSummary = [];
                foreach ($countersales->counterSalesSpareParts ?? [] as $counterSparePart) {
                    $__sp = \App\Models\SparePart::find($counterSparePart->stock_label_id);
                    $hsn = $__sp->hsn_code ?? '-';

                    $totalGstRate = (float) ($__sp->tax_percentage ?? 0);
                    $final = (float) ($counterSparePart->final_amount ?? 0);
                    $taxable = $totalGstRate > 0 ? $final / (1 + $totalGstRate / 100) : $final;

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

            @if (!empty($gstSummary) && $isGst)
                <div class="my-3"><strong>CGST/SGST Summary</strong></div>
                <table class="table my-3">
                    <thead>
                        <tr>
                            <th class="text-center">HSN/SAC</th>
                            <th class="text-end">Taxable Value (Rs.)</th>
                            <th class="text-center">CGST %</th>
                            <th class="text-end">Amount (Rs.)</th>
                            <th class="text-center">SGST/UTGST %</th>
                            <th class="text-end">Amount (Rs.)</th>
                            <th class="text-end">Total Tax Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gstSummary as $hsn => $row)
                            @php
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
                                <td class="text-center">{{ rtrim(rtrim(number_format($halfRate, 2), '0'), '.') }}%</td>
                                <td class="text-end">{{ number_format($cgst, 2) }}</td>
                                <td class="text-center">{{ rtrim(rtrim(number_format($halfRate, 2), '0'), '.') }}%</td>
                                <td class="text-end">{{ number_format($sgst, 2) }}</td>
                                <td class="text-end">{{ number_format($totalTax, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-center"><strong>Total</strong></td>
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

            {{-- Payment Details Section --}}
            <table class="table mt-30">
                <tbody>
                    <tr>
                        <th></th>
                        <th colspan="2">Bill Amount Details:</th>
                    </tr>

                    <tr>
                        <td></td>
                        <td class="w-120">
                            <p class="text-end m-0"><strong>Payment Type</strong></p>
                            <p class="text-end m-0"><strong>Total Amount (Rs.)</strong></p>
                            <p class="text-end m-0"><strong>Discount (Rs.)</strong></p>
                            <p class="text-end m-0"><strong>Partial Amount</strong></p>
                            <p class="text-end m-0"><strong>Remaining Balance</strong></p>
                            <p class="text-end m-0"><strong>Total Paid</strong></p>
                        </td>
                        <td class="w-120">
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

                    {{-- Amount in Words & Signature --}}
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
                                        <td class="align-top">
                                            @php
                                                $amount = $countersales->payment_type == 'total'
                                                    ? $countersales->subtotal
                                                    : $countersales->partial_amount;

                                                echo ucfirst(getAmountInWords($amount)) . ' Rupees Only';
                                            @endphp
                                        </td>
                                        <td class="w-250 align-bottom position-relative" style="height:80px;">
                                            <div class="signature-container">
                                                @if ($signImage)
                                                    <img src="{{ $signImage }}" alt="Signature" class="signature-img">
                                                @endif
                                            </div>
                                            @if (!empty($countersales->payment_type) && $countersales->payment_type == 'total')
                                                <div class="paid-stamp">
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/jobcard_img/paid_stamp.png'))) }}"
                                                        alt="Paid" width="120">
                                                </div>
                                            @else
                                                <div class="paid-stamp">
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/jobcard_img/partial_paid.png'))) }}"
                                                        alt="Partial Paid" width="120">
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    {{-- Notes Section --}}
                    <tr>
                        <td colspan="3" class="p-0 border-0">
                            <table class="table">
                                <tr>
                                    <th><strong>Note</strong></th>
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