<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antek123</title>

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
        // IMPORTANT: Use $sparePart from controller, not Auth
        // $sparePart is the vendor record passed from controller
        $vendor = $sparePart; // This is the SparePartVendor model instance
        $admin = App\Models\Admin::first();
        $isGst = ($vendor && $vendor->is_gst == 1);

        // Get logo image from vendor (using relationships)
        $logoImage = null;
        if ($vendor) {
            // Try to get image from relationship
            if (method_exists($vendor, 'profileImage') && $vendor->profileImage && !empty($vendor->profileImage->file)) {
                try {
                    $logoPath = public_path($vendor->profileImage->file);
                    if (file_exists($logoPath)) {
                        $logoImage = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
                    }
                } catch (\Exception $e) {
                    $logoImage = null;
                }
            }
            
            // If no profileImage, try Image relationship (for backward compatibility)
            if (!$logoImage && method_exists($vendor, 'Image') && $vendor->Image && !empty($vendor->Image->file)) {
                try {
                    $logoPath = public_path($vendor->Image->file);
                    if (file_exists($logoPath)) {
                        $logoImage = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
                    }
                } catch (\Exception $e) {
                    $logoImage = null;
                }
            }
        }

        // Get signature image from vendor
        $signImage = null;
        if ($vendor) {
            // Try to get signature from relationship
            if (method_exists($vendor, 'SignImage') && $vendor->SignImage && !empty($vendor->SignImage->file)) {
                try {
                    $signPath = public_path($vendor->SignImage->file);
                    if (file_exists($signPath)) {
                        $signImage = 'data:image/png;base64,' . base64_encode(file_get_contents($signPath));
                    }
                } catch (\Exception $e) {
                    $signImage = null;
                }
            }
        }

        // Get city, state, country names for vendor
        $vendorStateName = '';
        if(!empty($vendor->state_id)) {
            $state = \App\Models\State::find($vendor->state_id);
            $vendorStateName = $state->name ?? '';
        }
        
        $vendorCityName = '';
        if(!empty($vendor->city_id)) {
            $city = \App\Models\City::find($vendor->city_id);
            $vendorCityName = $city->name ?? '';
        }
        
        $vendorCountryName = '';
        if(!empty($vendor->country_id)) {
            $country = \App\Models\Country::find($vendor->country_id);
            $vendorCountryName = $country->name ?? '';
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
                                    {{ $vendor->company_name ?? $vendor->branch_name ?? $vendor->name ?? 'Spare Part Vendor' }}
                                </h2>
                                @if(!empty($vendor->tagline))
                                    <p style="font-size: 11px; margin: 3px 0 0 0; text-align: right; color: #7f8c8d;">
                                        {{ $vendor->tagline }}
                                    </p>
                                @endif
                            </div>
                            
                            {{-- Contact Information --}}
                            <div style="text-align: right;">
                                {{-- Email and Phone --}}
                                <div style="margin-bottom: 5px; font-size: 11px;">
                                    <span class="fw-600">Email:</span> 
                                    {{ $vendor->branch_email ?? $vendor->email ?? 'N/A' }}
                                    &nbsp;&nbsp;|&nbsp;&nbsp;
                                    <span class="fw-600">Phone:</span> 
                                    {{ $vendor->branch_number ?? $vendor->mobile_no ?? 'N/A' }}
                                </div>
                                
                                {{-- Address Line 1 --}}
                                @if(!empty($vendor->address))
                                    <div style="margin-bottom: 3px; font-size: 11px;">
                                        <span class="fw-600">Address:</span> 
                                        {{ $vendor->address }}
                                    </div>
                                @endif
                                
                                {{-- City, State, Country --}}
                                @if(!empty($vendorCityName) || !empty($vendorStateName) || !empty($vendorCountryName))
                                    <div style="margin-bottom: 3px; font-size: 11px;">
                                        <span class="fw-600">Location:</span> 
                                        {{ $vendorCityName }}
                                        {{ !empty($vendorCityName) && !empty($vendorStateName) ? ',' : '' }}
                                        {{ $vendorStateName }}
                                        {{ (!empty($vendorCityName) || !empty($vendorStateName)) && !empty($vendorCountryName) ? ',' : '' }}
                                        {{ $vendorCountryName }}
                                    </div>
                                @endif
                                
                                {{-- Pincode --}}
                                @if(!empty($vendor->pincode))
                                    <div style="margin-bottom: 3px; font-size: 11px;">
                                        <span class="fw-600">Pincode:</span> 
                                        {{ $vendor->pincode }}
                                    </div>
                                @endif
                                
                                {{-- GST --}}
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

            {{-- Customer Info | Invoice Details --}}
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
                            <p class="m-0 mb-2"><strong>Name:-</strong> {{ ucwords($admin->name ?? 'Admin') }}</p>
                            <p class="m-0 mb-2"><strong>Email:-</strong> {{ $admin->email ?? 'NA' }}</p>
                            @if (!empty($admin->mobile_no))
                                <p class="m-0 mb-2"><strong>Mobile No:-</strong> {{ $admin->mobile_no }}</p>
                            @endif
                            @if (!empty($admin->address))
                                <p class="m-0 mb-2"><strong>Address:-</strong> {{ $admin->address }}</p>
                            @endif
                            @if ($isGst && !empty($admin->gst_number))
                                <p class="m-0 mb-2"><strong>GST No:-</strong> {{ $admin->gst_number }}</p>
                            @endif
                        </td>
                        <td class="align-top" style="width: 50%;">
                            <p class="m-0 mb-2"><strong>
                                @if ($order->payment_status == 1)
                                    Invoice Number:-
                                @else
                                    Order Number:-
                                @endif
                            </strong> {{ $order->spare_invoice_number ?? $order->invoice_number ?? $order->id }}</p>
                            <p class="m-0 mb-2"><strong>Date:-</strong> {{ $order->order_date ?? \Carbon\Carbon::now()->format('M d Y, h:i A') }}</p>
                            <p class="m-0 mb-2"><strong>Total Items:-</strong> {{ count($order->orderItem) }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            @if (count($order->orderItem) > 0)
                <div class="my-3"><strong>Order Details</strong></div>

                {{-- Order Items Table --}}
                <table class="table" style="border-collapse: collapse; width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 4%;">#</th>
                            <th class="text-center" style="width: 22%;">Spare Part</th>
                            <th class="text-center" style="width: 10%;">HSN Number</th>
                            <th class="text-center" style="width: 6%;">QTY</th>
                            <th class="text-center" style="width: 11%;">Unit Price (Rs.)</th>
                            @if ($isGst)
                                <th class="text-center" style="width: 11%;">Tax (Rs.)</th>
                            @endif
                            <th class="text-center" style="width: 10%;">Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $partsTotal = 0;
                            $totalTaxableAmount = 0;
                            $totalQuantity = 0;
                            $cgstPartsTotal = 0;
                            $sgstPartsTotal = 0;
                            $gstSummary = [];
                        @endphp
                        @foreach ($order->orderItem as $item)
                            @php
                                $hsn = $item->SpareParts->hsn_code ?? '-';
                                $qty = (float) $item->quantity;
                                $taxRate = $isGst ? (float) (($item->spare_tax > 0) ? $item->spare_tax : ($item->SpareParts->tax_percentage ?? 0)) : 0.0;
                                $taxType = $isGst ? (!empty($item->spare_tax_type) ? $item->spare_tax_type : ($item->SpareParts->tax_type ?? 'exclude')) : 'exclude';

                                $commission = function_exists('getCommission') ? getCommission($item->category) : 0;
                                $originalTotalIncl = (float) $item->total_amount;
                                $totalIncl = $originalTotalIncl - ($originalTotalIncl * $commission / 100);

                                $totalExcl = $totalIncl / (1 + $taxRate / 100);
                                $unitPriceExcl = $totalExcl / $qty;
                                $totalTax = $totalIncl - $totalExcl;

                                $partsTotal += $totalIncl;
                                $totalTaxableAmount += $totalExcl;
                                $totalQuantity += $qty;
                                $cgstPartsTotal += $totalTax / 2;
                                $sgstPartsTotal += $totalTax / 2;

                                if (!isset($gstSummary[$hsn])) {
                                    $gstSummary[$hsn] = ['taxable' => 0.0, 'rate' => $taxRate];
                                }
                                $gstSummary[$hsn]['taxable'] += $totalExcl;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->SpareParts?->label?->title ?? '-' }}</td>
                                <td class="text-center">{{ $hsn }}</td>
                                <td class="text-center">{{ $qty }}</td>
                                <td class="text-end">{{ number_format($unitPriceExcl, 2) }}</td>
                                @if ($isGst)
                                    <td class="text-center">
                                        @if ($taxRate > 0)
                                            {{ $taxRate }}% ({{ $taxType == 'include' ? 'Inc' : 'Exc' }})
                                            @if ($taxType == 'include')
                                                <span class="text-danger">(- {{ number_format($totalTax, 2) }})</span>
                                            @else
                                                <span class="text-success">(+ {{ number_format($totalTax, 2) }})</span>
                                            @endif
                                        @else
                                            0.00
                                        @endif
                                    </td>
                                @endif
                                <td class="text-end">{{ number_format($totalExcl, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                    @php
                        $grossParts = $partsTotal;
                        $roundedGrossParts = round($grossParts);
                        $roundOffParts = round($roundedGrossParts - $grossParts, 2);
                    @endphp

                    {{-- Totals Section --}}
                    @if ($isGst)
                        {{-- With GST: 7 columns: #, Spare Part, HSN, QTY, Unit Price, Tax, Amount --}}
                        <tr>
                            <td colspan="6" class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Sub Total</strong></td>
                            <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($totalTaxableAmount, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-end" style="padding: 5px 8px; border: 1px solid black;">OUTPUT CGST</td>
                            <td class="text-end" style="padding: 5px 8px; border: 1px solid black;">{{ number_format($cgstPartsTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-end" style="padding: 5px 8px; border: 1px solid black;">OUTPUT SGST</td>
                            <td class="text-end" style="padding: 5px 8px; border: 1px solid black;">{{ number_format($sgstPartsTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-end" style="padding: 5px 8px; border: 1px solid black;">ROUND OFF</td>
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
                                <td colspan="4" class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Total</strong></td>
                                <td class="text-center" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($totalQuantity) }} Qty</strong></td>
                                <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Total (Rs.)</strong></td>
                                <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($grossParts, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    @else
                        {{-- Without GST: 6 columns: #, Spare Part, HSN, QTY, Unit Price, Amount --}}
                        <tr>
                            <td colspan="5" class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Sub Total</strong></td>
                            <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($totalTaxableAmount, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end" style="padding: 5px 8px; border: 1px solid black;">ROUND OFF</td>
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
                                <td colspan="3" class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Total</strong></td>
                                <td class="text-center" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($totalQuantity) }} Qty</strong></td>
                                <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>Total (Rs.)</strong></td>
                                <td class="text-end" style="padding: 5px 8px; border: 1px solid black;"><strong>{{ number_format($grossParts, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>

                {{-- CGST/SGST Summary --}}
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
                            @php
                                $sumTaxable = 0;
                                $sumCgst = 0;
                                $sumSgst = 0;
                                $sumTax = 0;
                            @endphp
                            @foreach ($gstSummary as $hsn => $row)
                                @php
                                    $taxable = $row['taxable'];
                                    $halfRate = $row['rate'] / 2;
                                    $cgst = ($taxable * $halfRate) / 100;
                                    $sgst = ($taxable * $halfRate) / 100;
                                    $rowTax = $cgst + $sgst;
                                    
                                    $sumTaxable += $taxable;
                                    $sumCgst += $cgst;
                                    $sumSgst += $sgst;
                                    $sumTax += $rowTax;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $hsn }}</td>
                                    <td class="text-end">{{ number_format($taxable, 2) }}</td>
                                    <td class="text-center">{{ number_format($halfRate, 1) }}%</td>
                                    <td class="text-end">{{ number_format($cgst, 2) }}</td>
                                    <td class="text-center">{{ number_format($halfRate, 1) }}%</td>
                                    <td class="text-end">{{ number_format($sgst, 2) }}</td>
                                    <td class="text-end">{{ number_format($rowTax, 2) }}</td>
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
                            <p class="text-end m-0"><strong>Paid Amount</strong></p>
                            <p class="text-end m-0"><strong>Remaining Balance</strong></p>
                        </td>
                        <td class="w-120">
                            <p class="text-end m-0"><strong>
                                @if ($order->payment_status == 1)
                                    Paid
                                @else
                                    Unpaid
                                @endif
                            </strong></p>
                            <p class="text-end m-0"><strong>{{ number_format($partsTotal, 2) }}</strong></p>
                            <p class="text-end m-0">
                                <strong>{{ number_format($order->discount ?? 0, 2) }}</strong>
                            </p>
                            <p class="text-end m-0">
                                <strong>{{ number_format($order->paid_amount ?? 0, 2) }}</strong>
                            </p>
                            <p class="text-end m-0">
                                <strong>{{ number_format($order->balance_amount ?? $partsTotal, 2) }}</strong>
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
                                                $amount = $order->paid_amount ?? $partsTotal;
                                                echo ucfirst(getAmountInWords($amount)) . ' Rupees Only';
                                            @endphp
                                        </td>
                                        <td class="w-250 align-bottom position-relative" style="height:80px;">
                                            <div class="signature-container">
                                                @if ($signImage)
                                                    <img src="{{ $signImage }}" alt="Signature" class="signature-img">
                                                @endif
                                            </div>
                                            @if ($order->payment_status == 1)
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
                                    <td>{{ $order->note ?? '' }}</td>
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