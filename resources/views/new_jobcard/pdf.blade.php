<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnet</title>

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
            background-color: #E3F2FD;
            /* Professional light blue for Invoice */
        }

        @if ($pdfTitle == 'ESTIMATE')
            .table th {
                background-color: #B2DFDB !important;
                /* Professional teal for Estimate */
            }
        @endif

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
   
    <div class="container">
        <div class="inner-container header">
            {{-- <div class="text-center" style="margin-bottom: 10px;">INVOICE</div> --}}
            <div class="text-center" style="margin-bottom: 10px; padding: 5px 0;">
                @if ($pdfTitle == 'ESTIMATE')
                    <span style="color: #00695C; font-weight: bold; font-size: 24px;">ESTIMATION</span>
                @elseif (isset($logo) && $logo->is_gst == 1)
                    <span style="color: #000000; font-weight: bold; font-size: 24px;">TAX INVOICE</span>
                @else
                    <span style="color: #388E3C; font-weight: bold; font-size: 24px;">CASH INVOICE</span>
                @endif
            </div>

            <table class="table my-3">
              <tbody>
    <tr>
        <td class="p-0 border-0" style="width: 30%; vertical-align: top; padding-right: 15px;">
            <img src="{{ file_exists(public_path($logo->Image->file)) ? 'data:image/png;base64,' . base64_encode(file_get_contents(public_path($logo->Image->file))) : 'path/to/default/image.png' }}"
                alt="Logo" class="logo" style="max-width: 160px; border-radius: 8px;">
        </td>
        
        <td class="p-0 border-0" style="width: 70%; vertical-align: top;">
            @php 
                $workshop = (Auth::guard('workshop')->check() ? Auth::guard('workshop')->user() : null) ?? ($logo ?? \App\Models\WorkShopVendor::find($newjobcard->user_id ?? 0));
                
                $stateName = '';
                if(!empty($workshop->state_id)) {
                    $state = \App\Models\State::find($workshop->state_id);
                    $stateName = $state->name ?? '';
                }
                
                $cityName = '';
                if(!empty($workshop->city_id)) {
                    $city = \App\Models\City::find($workshop->city_id);
                    $cityName = $city->name ?? '';
                }
                
                $countryName = '';
                if(!empty($workshop->country_id)) {
                    $country = \App\Models\Country::find($workshop->country_id);
                    $countryName = $country->name ?? '';
                }
            @endphp
            
            {{-- Header Section --}}
            <div style="border-bottom: 2px solid #2c3e50; margin-bottom: 10px; padding-bottom: 5px;">
                <h2 style="font-size: 22px; margin: 0; text-align: right; color: #2c3e50;">
                    {{ $logo->branch_name }}
                </h2>
                @if(!empty($logo->tagline))
                    <p style="font-size: 11px; margin: 3px 0 0 0; text-align: right; color: #7f8c8d;">
                        {{ $logo->tagline }}
                    </p>
                @endif
            </div>
            
            {{-- Contact Information - Without Icons --}}
            <div style="text-align: right;">
                {{-- Email and Phone --}}
                <div style="margin-bottom: 5px; font-size: 11px;">
                    <span style="font-weight: 600;">Email:</span> 
                    {{ $workshop->email ?? 'N/A' }}
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <span style="font-weight: 600;">Phone:</span> 
                    {{ $workshop->mobile_no ?? 'N/A' }}
                </div>
                
                {{-- Address Line 1 --}}
                @if(!empty($workshop->address))
                    <div style="margin-bottom: 3px; font-size: 11px;">
                        <span style="font-weight: 600;">Address:</span> 
                        {{ $workshop->address }}
                    </div>
                @endif
                
                {{-- City, State, Country --}}
                @if(!empty($cityName) || !empty($stateName) || !empty($countryName))
                    <div style="margin-bottom: 3px; font-size: 11px;">
                        <span style="font-weight: 600;">Location:</span> 
                        {{ $cityName }}
                        {{ !empty($cityName) && !empty($stateName) ? ',' : '' }}
                        {{ $stateName }}
                        {{ (!empty($cityName) || !empty($stateName)) && !empty($countryName) ? ',' : '' }}
                        {{ $countryName }}
                    </div>
                @endif
                
                {{-- Pincode --}}
                @if(!empty($workshop->pincode))
                    <div style="margin-bottom: 3px; font-size: 11px;">
                        <span style="font-weight: 600;">Pincode:</span> 
                        {{ $workshop->pincode }}
                    </div>
                @endif
                
                {{-- GST --}}
                @if($logo->is_gst == 1 && !empty($workshop->gst))
                    <div style="margin-top: 5px; font-size: 11px;">
                        <span style="font-weight: 600;">GST No.:</span> 
                        {{ $workshop->gst }}
                    </div>
                @endif
            </div>
        </td>
    </tr>
</tbody>
            </table>

            <table class="table my-3">
                <thead>
                    <tr>
                        <th>Customer Info</th>
                        <th>Vehicle Details</th>
                        {{-- <th>Invoice Details</th> --}}
                        <th>
                            @if ($pdfTitle == 'ESTIMATE')
                                Estimation Details
                            @else
                                Invoice Details
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- sgjsdgs --}}
                    <tr>
                        <td style="vertical-align: top; width: 30%;">
                            {{-- Add this temporarily to see all customer data --}}

                            <p class="p-0 m-0">
                                Name:-
                                @if ($customer->cust_type == 1)
                                    {{ $customer->company_name ? 'M/S ' . $customer->company_name : $customer?->name . ' ' . $customer?->lastname }}
                                @else
                                    {{ $customer?->name }} {{ $customer?->lastname }}
                                @endif
                            </p>
                            @if (!empty($customer?->mobile_no))
                                <p class="p-0 m-0">
                                    Mobile No:- {{ $customer?->mobile_no ?? 'NA' }}
                                </p>
                            @endif
                            @if (!empty($customer?->email))
                                <p class="p-0 m-0">
                                    Email:- {{ $customer?->email ?? 'NA' }}
                                </p>
                            @endif
                            @if (!empty($customer?->address))
                                <p class="p-0 m-0">
                                    Address:- {{ $customer?->address ?? 'NA' }}
                                </p>
                            @endif
                            @if (!empty($customer?->gst_number))
                                <p class="p-0 m-0">
                                    GST No:- {{ $customer?->gst_number ?? 'NA' }}
                                </p>
                            @endif
                        </td>
                        <td style="vertical-align: top">
                            <p class="m-0">
                                Vehicle Number:- {{ $vehicles->number_plate ?? 'NA' }}
                            </p>
                            <p class="m-0">
                                Chassis Number:- {{ $vehicles->chassis_no ?? 'NA' }}
                            </p>
                            <p class="m-0">
                                @php
                                    $modelname = array_filter([
                                        $vehicles->brand ?? '',
                                        $vehicles->variant ?? '',
                                        $vehicles->year ?? '',
                                        $vehicles->modification ?? '',
                                    ]);
                                @endphp
                                Brand :- {{ implode(' ', $modelname) }}
                                {{-- {{ dd($modelname) }} --}}
                            </p>
                            <p class="m-0">
                                In KM Reading:- {{ $newjobcard->km_runing ?? 0 }}
                            </p>
                            <p class="m-0">
                                In Time:-
                                {{ \Carbon\Carbon::parse($newjobcard->entry_date)->format('M d Y, h:i A') ?? '-' }}
                            </p>
                        </td>
                        <td style="vertical-align: top">
                            <p class="m-0">
                                Job Card Number :- {{ $newjobcard->jobcard_number }}
                            </p>
                            @if ($pdfTitle != 'ESTIMATE')
                                <p class="m-0">
                                    Invoice Number:- {{ $newjobcard->shared_serial ?? '-' }}
                                </p>
                            @endif
                            {{-- <p class="p-0 m-0">
                                Address:- {{ $customer?->address ?? 'NA' }}
                            </p> --}}
                            <p class="m-0">
                                Date:- {{ \Carbon\Carbon::now()->format('M d Y, h:i A') ?? '-' }}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>

            @if (count($jobCardSpareParts) > 0)
                <div class="partCharges my-3"><strong>Parts Charges</strong></div>

                <table class="table my-3">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th colspan="4" class="text-center">Parts</th>
                            {{-- @if ($type == 0)
                                <th class="text-center">HSN Number</th>
                            @endif --}}
                            {{-- <th class="text-center">Part Number</th> --}}
                            <th class="text-center">QTY</th>
                            <th class="text-center">unit</th>
                            <th class="text-end">Unit Price (Rs.)</th>
                            {{-- <th class="text-center">Tax Type</th> --}}
                            @if ($logo->is_gst == 1)
                                <th class="text-center">Tax (Rs.)</th>
                            @endif
                            <th class="text-center">Amount(Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $partsTotal = 0;
                            $totalquentity = 0;
                        @endphp
                        @foreach ($jobCardSpareParts as $jobCardSparePart)
                            <tr>
                                {{-- <td class="text-center" style="width:20px !important;">
                                        {{ $loop->iteration }}</td> --}}
                                <td class="text-center">
                                    {{ $loop->iteration }}</td>


                                <td colspan="4">
                                    {{ $jobCardSparePart->stock_label_name }}</td>
                                @php
                                    $__workshopId = Auth::guard('workshop')->id() ?? ($newjobcard->user_id ?? null);
                                    
                                    $__sp = null;
                                    if ($__workshopId) {
                                        $__sp = \App\Models\SparePart::where('label_id', $jobCardSparePart->stock_label_id)
                                            ->where('user_id', $__workshopId)
                                            ->first();
                                    }
                                    if (!$__sp) {
                                        $__sp = \App\Models\SparePart::where('label_id', $jobCardSparePart->stock_label_id)->first();
                                    }

                                    $__hsn = $__sp ? ($__sp->hsn_code ?? '-') : '-';
                                    $__partno = $__sp ? ($__sp->part_number ?? '-') : '-';
                                    $__unitTitle = $__sp?->unit?->title ?? '-';

                                    if (empty($__unitTitle) || $__unitTitle === '-') {
                                        $__ps = null;
                                        if ($__workshopId) {
                                            $__ps = \App\Models\ProductStock::where('label_id', $jobCardSparePart->stock_label_id)
                                                ->where('user_id', $__workshopId)
                                                ->first();
                                        }
                                        if (!$__ps) {
                                            $__ps = \App\Models\ProductStock::where('label_id', $jobCardSparePart->stock_label_id)->first();
                                        }

                                        if ($__ps) {
                                            if ($__hsn === '-') {
                                                $__hsn = $__ps->hsn_code ?? '-';
                                            }
                                            if ($__partno === '-') {
                                                $__partno = $__ps->part_number ?? '-';
                                            }
                                            $__unitTitle = $__ps->unit?->title ?? '-';
                                        }
                                    }
                                @endphp
                                {{-- @if ($type == 0)
                                    <td class="text-center" style="width:50px !important;">{{ $__hsn }}</td>
                                @endif --}}
                                {{-- <td class="text-start " style="width:70px !important;">{{ $__partno }}</td> --}}
                                <td class="text-center" style="width:60px !important;">
                                    {{ $jobCardSparePart->quantity }}</td>
                                <td class="text-center" style="width:60px !important;">{{ $__unitTitle }}</td>

                                <td class="text-end" style="width:70px !important;">
                                    {{ number_format($jobCardSparePart->price, 2) }}
                                </td>
                                {{-- <td>{{ ucfirst($jobCardSparePart->productStock?->tax_type) ?? '-' }}</td> --}}
                                {{-- <td>{{ ucfirst($jobCardSparePart->tax_type) ?? '-' }}</td> --}}
                                {{-- <td>{{ $jobCardSparePart->productStock?->tax_percentage ?? '-' }}</td> --}}
                                {{-- <td class="text-start" style="width:60px !important;">{{ $jobCardSparePart->tax_percentage ?? '-' }}</td> --}}
                                @if ($logo->is_gst == 1)
                                    <td class="text-center" style="width:80px !important;">
                                        @php
                                            // Try to get tax data from jobCardSparePart first, then from productStock
                                            $__rate = (float) ($jobCardSparePart->tax_percentage ?? 0);
                                            $__price = (float) ($jobCardSparePart->price ?? 0);
                                            $__quantity = (float) ($jobCardSparePart->quantity ?? 1);
                                            $__taxType = $jobCardSparePart->tax_type ?? 'exclude';

                                            if ($__rate > 0) {
                                                if ($__taxType == 'include') {
                                                    // Tax is included in price - calculate from unit price
                                                    $__taxablePrice = round($__price / (1 + $__rate / 100), 2);
                                                    $__taxAmt =
                                                        round(($__taxablePrice * $__rate) / 100, 2) * $__quantity;
                                                } else {
                                                    // Tax is excluded from price
                                                    $__taxAmt = round(($__price * $__rate) / 100, 2) * $__quantity;
                                                }
                                            } else {
                                                $__taxAmt = 0;
                                            }
                                        @endphp
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

                                <td class="text-end" style="width:80px !important;">
                                    @php
                                        $__dispRate = (float) ($jobCardSparePart->tax_percentage ?? 0);
                                        $__dispFinal = (float) ($jobCardSparePart->final_amount ?? 0);
                                        $__dispTaxable =
                                            $__dispRate > 0 && isset($logo) && $logo->is_gst == 1
                                                ? round($__dispFinal / (1 + $__dispRate / 100), 2)
                                                : $__dispFinal;
                                    @endphp
                                    {{ number_format($__dispTaxable, 2) }}
                                </td>

                            </tr>
                            @php
                                $partsTotal += $jobCardSparePart->final_amount;
                                $totalquentity += (float) $jobCardSparePart->quantity;
                            @endphp
                        @endforeach
                    </tbody>
                    @php
                        // Calculate Output CGST/SGST and Round Off for PARTS section
                        $taxablePartsTotal = 0;
                        $cgstPartsTotal = 0;
                        $sgstPartsTotal = 0;
                        $partsSubTotal = 0; // actual amount customer pays (sum of Amount column)

                        foreach ($jobCardSpareParts as $__rowSum) {
                            $rate = (float) ($__rowSum->tax_percentage ?? 0);
                            $final = (float) ($__rowSum->final_amount ?? 0);
                            $taxType = $__rowSum->tax_type ?? 'exclude';

                            $partsSubTotal += $final; // always add the actual amount customer pays

                            if ($rate > 0 && isset($logo) && $logo->is_gst == 1) {
                                // final_amount always represents the gross amount paid by the customer.
                                // We reverse-calculate taxable amount.
                                $taxable = round($final / (1 + $rate / 100), 2);
                                $gstAmt = round($final - $taxable, 2);
                            } else {
                                $taxable = $final;
                                $gstAmt = 0;
                            }
                            $taxablePartsTotal += $taxable;
                            $cgstPartsTotal += round($gstAmt / 2, 2);
                            $sgstPartsTotal += round($gstAmt / 2, 2);
                        }
                        $grossParts = $taxablePartsTotal + $cgstPartsTotal + $sgstPartsTotal;
                        $roundedGrossParts = round($grossParts, 0);
                        $roundOffParts = round($roundedGrossParts - $grossParts, 2);
                    @endphp
                    <tr>
                        <td colspan="{{ $logo->is_gst == 1 ? 9 : 8 }}" class="text-end"><strong>Sub Total</strong></td>
                        <td class="text-end"><strong>{{ number_format($taxablePartsTotal, 2) }}</strong></td>
                    </tr>

                    @if ($logo->is_gst == 1)
                        <tr>
                            <td colspan="{{ $logo->is_gst == 1 ? 9 : 8 }}" class="text-end">OUTPUT CGST</td>
                            <td class="text-end">{{ number_format($cgstPartsTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="{{ $logo->is_gst == 1 ? 9 : 8 }}" class="text-end">OUTPUT SGST</td>
                            <td class="text-end">{{ number_format($sgstPartsTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="{{ $logo->is_gst == 1 ? 9 : 8 }}" class="text-end">ROUND OFF</td>
                            <td class="text-end">
                                {{ $roundOffParts > 0 ? '' : '(-)' }}{{ number_format(abs($roundOffParts), 2) }}</td>
                        </tr>
                    @endif

                    {{-- CGST/SGST breakdown also shown in CGST/SGST Summary table below --}}
                    <tfoot>
                        <tr>
                            <td colspan="{{ $logo->is_gst == 1 ? 7 : 6 }}" class="text-end"><strong>Total</strong></td>
                            <td class="text-center"><strong>{{ number_format($totalquentity) }} Qty</strong></td>
                            <td class="text-end"><strong>Total(Rs.)</strong></td>
                            <td class="text-end"><strong>{{ number_format($grossParts, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
                <!-- <b style="vertical-align:top;">
                    @php
                        echo ucfirst(getAmountInWords($grossParts)) . ' Rupees Only';
                    @endphp
                </b> -->
            @endif
            {{-- Labour Charges Section - shown for both Invoice and Mechanical Copy --}}
            @if (count($jobCardExtraCharges) > 0)
                <div class="partCharges my-3"><strong>Labour Charges</strong></div>

                <table class="table my-3">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Title</th>
                            <th class="text-center">Type</th>
                            @if ($logo->is_gst == 1)
                                <th class="text-center">GST Type</th>
                                <th class="text-center">GST %</th>
                            @endif
                            <th class="text-end">Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $labourTotal = 0; @endphp
                        @foreach ($jobCardExtraCharges as $extraCharge)
                            <tr>
                                <td class="text-center" style="width:20px !important;">{{ $loop->iteration }}</td>
                                <td>{{ $extraCharge->label }}</td>
                                <td class="text-center">
                                    {{ isset($extraCharge->labour_type) && $extraCharge->labour_type !== ''
                                        ? ucfirst($extraCharge->labour_type)
                                        : (($extraCharge->charge_type ?? 1) == 2
                                            ? 'Outsource'
                                            : 'Inhouse') }}
                                </td>
                                <!-- Mechanic column removed as per requirement -->
                                @if ($logo->is_gst == 1)
                                    <td class="text-center">{{ $extraCharge->gst_type ?? '-' }}</td>
                                    <td class="text-center">
                                        {{ $extraCharge->gst ? $extraCharge->gst . '%' : '-' }}
                                    </td>
                                @endif
                                <td class="text-end" style="width:100px !important;">
                                    {{ number_format((float) $extraCharge->charges, 2) }}
                                </td>
                            </tr>
                            @php $labourTotal += (float) $extraCharge->charges; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                                <td class="text-end" colspan="{{ $logo->is_gst == 1 ? 5 : 3 }}"><strong>Total Labour
                                    (Rs.)</strong></td>
                            <td class="text-end"><strong>{{ number_format($labourTotal, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            @endif

            {{-- Extra Charges (GST breakdown) - removed as per user request --}}
            {{-- @if ($type == 0)
                @if (count($jobCardExtraCharges) > 0 && $logo->is_gst == 1 && $newjobcard->status != 2)
                    <div class="extraCharges my-3"><strong>Extra Charges</strong></div>

                    <table class="table my-3">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Label</th>
                                <th>GST Type</th>
                                <th>GST %</th>
                                <th class="text-center">Charge Price(Rs.)</th>
                                <th class="text-center">Amount(Rs.)</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php $chargeTotal = 0; @endphp
                            @foreach ($jobCardExtraCharges as $jobCardExtraCharge)
                                <tr>
                                    <td class="text-center" style="width:20px !important;">{{ $loop->iteration }}
                                    </td>
                                    <td>{{ $jobCardExtraCharge->label }}</td>
                                    <td>{{ $jobCardExtraCharge->gst_type }}</td>
                                    <td>{{ $jobCardExtraCharge->gst }}</td>
                                    <td class="text-end" style="width:120px !important;">
                                        {{ number_format((float) $jobCardExtraCharge->amount, 2) }}</td>
                                    <td class="text-end" style="width:120px !important;">
                                        {{ number_format((float) $jobCardExtraCharge->charges, 2) }}</td>
                                </tr>
                                @php $chargeTotal += (float)$jobCardExtraCharge->charges; @endphp
                            @endforeach

                        </tbody>

                        <tfoot>
                            <tr>
                                <td class="text-end" colspan="5"><strong>Total(Rs.)</strong></td>
                                <td class="text-end"><strong>{{ number_format($chargeTotal, 2) }}</strong></td>
                            </tr>
                        </tfoot>

                    </table>
                    <b style="vertical-align:top;">
                        {{-- @php
                            echo ucfirst(getAmountInWords($chargeTotal)) . ' Rupees Only';
                        @endphp --}}
            </b>
            {{-- @endif --}}
            {{-- @endif --}}

            {{-- CGST/SGST Summary Section --}}
            @if ($logo->is_gst == 1)
                @php
                    $gstSummary = [];

                    // Aggregate Spare Parts
                    foreach ($jobCardSpareParts as $part) {
                        $hsn = '-';
                        $__sp = \App\Models\SparePart::where('label_id', $part->stock_label_id)->first();
                        if ($__sp && $__sp->hsn_code && $__sp->hsn_code !== '-') {
                            $hsn = $__sp->hsn_code;
                        } else {
                            $__ps = \App\Models\ProductStock::where('label_id', $part->stock_label_id)->first();
                            if ($__ps && $__ps->hsn_code && $__ps->hsn_code !== '-') {
                                $hsn = $__ps->hsn_code;
                            }
                        }

                        $rate = (float) ($part->tax_percentage ?? 0);
                        if ($rate > 0) {
                            $final = (float) ($part->final_amount ?? 0);
                            $taxType = $part->tax_type ?? 'exclude';

                            // final_amount always represents the gross amount paid by the customer.
                            // We reverse-calculate taxable amount.
                            $taxable = round($final / (1 + $rate / 100), 2);
                            $taxAmt = $final - $taxable;

                            $key = $hsn . '_' . $rate;
                            if (!isset($gstSummary[$key])) {
                                $gstSummary[$key] = [
                                    'hsn' => $hsn,
                                    'taxable' => 0,
                                    'rate' => $rate,
                                    'tax_amt' => 0,
                                ];
                            }
                            $gstSummary[$key]['taxable'] += $taxable;
                            $gstSummary[$key]['tax_amt'] += $taxAmt;
                        }
                    }

                    // Aggregate Labour Charges
                    foreach ($jobCardExtraCharges as $charge) {
                        $sac = '9987'; // Default SAC for repair services
                        $rate = (float) ($charge->gst ?? 0);
                        if ($rate > 0) {
                            $final = (float) ($charge->charges ?? 0);
                            $taxType = $charge->gst_type ?? 'exclude';

                            // For labour, the controller logic (recalculateExtraCharges) adds tax to final_amount if exclude.
                            // So final_amount for labour always includes tax if rate > 0.
                            $taxable = round($final / (1 + $rate / 100), 2);
                            $taxAmt = $final - $taxable;

                            $key = $sac . '_' . $rate;
                            if (!isset($gstSummary[$key])) {
                                $gstSummary[$key] = [
                                    'hsn' => $sac,
                                    'taxable' => 0,
                                    'rate' => $rate,
                                    'tax_amt' => 0,
                                ];
                            }
                            $gstSummary[$key]['taxable'] += $taxable;
                            $gstSummary[$key]['tax_amt'] += $taxAmt;
                        }
                    }

                    $totalTaxableSummary = 0;
                    $totalCgstSummary = 0;
                    $totalSgstSummary = 0;
                    $totalTaxSummary = 0;
                @endphp

                @if (count($gstSummary) > 0)
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
                            @foreach ($gstSummary as $row)
                                @php
                                    $cgst = round($row['tax_amt'] / 2, 2);
                                    $sgst = round($row['tax_amt'] / 2, 2);
                                    $rowTotalTax = $cgst + $sgst;

                                    $totalTaxableSummary += $row['taxable'];
                                    $totalCgstSummary += $cgst;
                                    $totalSgstSummary += $sgst;
                                    $totalTaxSummary += $rowTotalTax;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $row['hsn'] }}</td>
                                    <td class="text-end">{{ number_format($row['taxable'], 2) }}</td>
                                    <td class="text-center">{{ $row['rate'] / 2 }}%</td>
                                    <td class="text-end">{{ number_format($cgst, 2) }}</td>
                                    <td class="text-center">{{ $row['rate'] / 2 }}%</td>
                                    <td class="text-end">{{ number_format($sgst, 2) }}</td>
                                    <td class="text-end">{{ number_format($rowTotalTax, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-center"><strong>Total</strong></td>
                                <td class="text-end"><strong>{{ number_format($totalTaxableSummary, 2) }}</strong>
                                </td>
                                <td></td>
                                <td class="text-end"><strong>{{ number_format($totalCgstSummary, 2) }}</strong></td>
                                <td></td>
                                <td class="text-end"><strong>{{ number_format($totalSgstSummary, 2) }}</strong></td>
                                <td class="text-end"><strong>{{ number_format($totalTaxSummary, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                @endif
            @endif

            {{-- @endif --}}
            <table class="table" style="margin-top: 10px;">
                <tbody>
                    <tr>
                        <th></th>
                        <th colspan="2">Bill Amount Details:</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 120px !important;">
                            <p class="text-end m-0"><strong>Total Amount(Rs.)</strong></p>
                            <p class="text-end m-0"><strong>
                                    @if (!empty($newjobcard->final_discount))
                                        *
                                    @endif Discount(Rs.)
                                </strong></p>
                            <p class="text-end m-0"><strong>Payable(Rs.)</strong></p>
                            <p class="text-end m-0"><strong>Advance(Rs.)</strong></p>
                            @if (!empty($newjobcard->balance_amount))
                                <p class="text-end m-0"><strong>Balance(Rs.)</strong></p>
                            @endif
                            @if (!empty($newjobcard->final_paid))
                                <p class="text-end m-0"><strong>Received(Rs.)</strong></p>
                            @endif
                        </td>
                        <td style="width: 120px !important;">
                            <p class="text-end m-0">
                                <strong>{{ number_format($newjobcard->amount, 2) }}</strong>
                            </p>
                            <p class="text-end m-0">
                                <strong>{{ number_format($newjobcard->discount + $newjobcard->final_discount, 2) }}</strong>
                            </p>
                            <p class="text-end m-0">
                                <strong>{{ number_format($newjobcard->final_amount, 2) }}</strong>
                            </p>
                            <p class="text-end m-0">
                                <strong>{{ number_format((float) ($newjobcard->advance ?? 0), 2) }}</strong>
                            </p>
                            @if (!empty($newjobcard->balance_amount))
                                <p class="text-end m-0">
                                    <strong>{{ number_format($newjobcard->balance_amount, 2) }}</strong>
                                </p>
                            @endif
                            @if (!empty($newjobcard->final_paid))
                                <p class="text-end m-0">
                                    <strong>{{ number_format($newjobcard->final_paid, 2) }}</strong>
                                </p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="p-0  border-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            @if ($pdfTitle == 'ESTIMATE')
                                                Estimate
                                            @else
                                                Invoice
                                            @endif Amount In Words
                                        </th>
                                        <th>Authorised Signature and Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            @php
                                                echo ucfirst(getAmountInWords($newjobcard->final_amount)) .
                                                    ' Rupees Only';
                                            @endphp
                                        </td>
                                        <td
                                            style="width:250px !important;vertical-align: bottom;height:70px;position:relative; ">

                                            {{-- <img src="{{ file_exists(public_path($logo->SignImage->file)) ? 'data:image/png;base64,' . base64_encode(file_get_contents(public_path($logo->SignImage->file))) : 'path/to/default/image.png' }}"
                                                alt="Logo" class="logo"> --}}
                                            <div display:inline-block; padding:10px; margin-top:60px;">
                                                <img src="{{ file_exists(public_path($logo->SignImage->file))
                                                    ? 'data:image/png;base64,' . base64_encode(file_get_contents(public_path($logo->SignImage->file)))
                                                    : 'path/to/default/image.png' }}"
                                                    alt="Logo" class="logo" style="display:block;">
                                            </div>

                                            {{-- @if (!empty($newjobcard->final_paid))
                                                <div
                                                    style="position:absolute;bottom:0;right:20px; top:50%; background-color: #bcec62">
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/jobcard_img/paid_stamp.png'))) }}"
                                                        alt="Logo" class="" width="120">
                                                </div>
                                            @else
                                                <div
                                                    style="position:absolute;bottom:0;right:20px top:20px; background-color: #bcec62;">
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/jobcard_img/partial_paid.png'))) }}"
                                                        alt="Logo" class="" width="120">

                                                </div>
                                            @endif --}}
                                            {{-- Show payment seals for TAX INVOICE and CASH INVOICE when job card is completed and fully paid --}}
                                            @if (
                                                $pdfTitle != 'ESTIMATE' &&
                                                    ($newjobcard->status == 2 || $newjobcard->status == 3) &&
                                                    $newjobcard->balance_amount == 0)
                                                {{-- Show Paid stamp only when payment is fully done --}}
                                                <div style="position:absolute;bottom:0;right:20px; top:20px; ">
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/jobcard_img/paid_stamp.png'))) }}"
                                                        alt="Paid" class="" width="120">
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="">
                            @if (!empty($newjobcard->final_discount))
                                <p>
                                    *An additional discount of <strong>(Rs.
                                        {{ $newjobcard->final_discount }})</strong> has been applied to the
                                    <strong>Discount</strong> section.
                                </p>
                            @endif
                            <p>
                                {{-- Thank You! Service Regularly and ride safely. And Visit Again --}}
                                @if ($pdfTitle == 'ESTIMATE')
                                    "In advance, you have made the payment of 70%."
                                @else
                                    Parking charges will be applied if the vehicle is not collected within 3
                                    days after completion of repairs.
                                @endif
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="p-0 border-0">
                            <table class="table">
                                @if ($pdfTitle != 'ESTIMATE')
                                    <tr>
                                        <th><strong>Note</strong></th>
                                    </tr>
                                    <tr>
                                        <td>{{ !empty($newjobcard->notes) ? $newjobcard->notes : ($exitNote?->note ?? '') }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <th><strong>Customer Voice</strong></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            @foreach ($jobCardCustomerVoice as $customerVoice)
                                                {{ !$loop->first ? ', ' : '' }}{{ $loop->iteration . '. ' . $customerVoice->customer_voice }}
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                                @if ($pdfTitle == 'ESTIMATE')
                                    <tr>
                                        <th colspan="2"><strong>Work Notes</strong></th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="height:40px;">
                                            @foreach ($jobCardAccessories as $workNot)
                                                {{ !$loop->first ? ', ' : '' }}{{ $loop->iteration . '. ' . $workNot->customer_voice }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    @if (!empty($newjobcard->notes) || !empty($exitNote?->note))
                                        <tr>
                                            <th colspan="2"><strong>Note</strong></th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                {{ !empty($newjobcard->notes) ? $newjobcard->notes : ($exitNote?->note ?? '') }}
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="text-center" style="margin-top:10px;font-size:12px;">**BENZ / AUDI / BMW / MINI /
                VOLKSWAGON / SKODA / LANDROVER / JAGUAR / PORSCHE / VOLVO**</div>
        </div>
    </div>
</body>

</html>
