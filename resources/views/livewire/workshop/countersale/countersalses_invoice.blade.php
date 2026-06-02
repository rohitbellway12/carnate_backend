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
        // Get company information from authenticated sparepart user
        $sparepartUser = Auth::guard('sparepart')->user();
        $logoImage = null;
        $logo = null;

        if ($sparepartUser) {
            try {
                $logo = App\Models\SparePartVendor::with(['profileImage', 'SignImage'])
                    ->where('id', $sparepartUser->id)
                    ->first();

                if ($logo && $logo->profileImage && !empty($logo->profileImage->file)) {
                    $logoPath = public_path($logo->profileImage->file);
                    if (file_exists($logoPath)) {
                        $logoImage = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
                    }
                }
            } catch (\Exception $e) {
                // Silently handle errors if logo cannot be loaded
                $logoImage = null;
            }
        }

        // Ensure $logo is set even if no image
        if (!$logo && $sparepartUser) {
            $logo = App\Models\SparePartVendor::where('id', $sparepartUser->id)->first();
        }

    @endphp

    <div class="container">
        <div class="inner-container header">
            <div class="text-center" style="margin-bottom: 10px;">INVOICE</div>

            <table class="table my-3">
                <tbody>
                    <tr>
                        <td class="p-0 border-0">
                            @if ($logoImage)
                                <img src="{{ $logoImage }}" alt="Logo" class="logo">
                            @endif
                        </td>

                        <td class="p-0 border-0" style="vertical-align: top; width: 40%; ">
                            <table class="table my-3">
                                <tbody>
                                    <tr>
                                        <td class="p-0 border-0">
                                            <h3 class="text-end m-0" style="font-size:25px;">
                                                {{ $logo?->branch_name ?? Auth::guard('sparepart')->user()?->display_name }}
                                            </h3>

                                            <p class="text-end mb-2" style="margin-top:0;">
                                                {{ \Illuminate\Support\Str::limit($logo?->tagline ?? (Auth::guard('sparepart')->user()?->tagline ?? ''), 500) }}
                                            </p>

                                            <p class="text-end m-0 ">
                                                Email:- {{ Auth::guard('sparepart')->user()?->email }}
                                            </p>

                                            <p class="text-end m-0">
                                                Phone:- {{ Auth::guard('sparepart')->user()?->mobile_no }}
                                            </p>

                                            <p
                                                style="
                                    width: 250px;
                                    white-space: normal;
                                    word-wrap: break-word;
                                    text-align: right;
                                    margin-left: auto;
                                    margin-right: 0;
                                    margin-top: 0;
                                    margin-bottom: 0;
                                ">
                                                {{ Auth::guard('sparepart')->user()->address }}
                                            </p>

                                            <p class="text-end m-0">
                                                @if ($logo?->is_gst == 0)
                                                    GST No. {{ Auth::guard('sparepart')->user()->gst_number ?? '-' }}
                                                @endif
                                            </p>

                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </td>

                    </tr>
                </tbody>
            </table>

            <table class="table my-3">
                <thead>
                    <tr>
                        <th>Bill To</th>
                        <th>Invoice Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: top">
                            <p class="p-0 m-0">
                                Name:- {{ $countersales->Customer?->name }} {{ $countersales->Customer?->lastname }}
                            </p>
                            @if (!empty($countersales->Customer?->mobile_no))
                                <p class="p-0 m-0">
                                    Mobile No:- {{ $countersales->Customer?->mobile_no ?? 'NA' }}
                                </p>
                            @endif
                            @if (!empty($countersales->Customer?->email))
                                <p class="p-0 m-0">
                                    Email:- {{ $countersales->Customer?->email ?? 'NA' }}
                                </p>
                            @endif
                            @if (!empty($countersales->Customer?->address))
                                <p class="p-0 m-0">
                                    Address:- {{ $countersales->Customer?->address ?? 'NA' }}
                                </p>
                            @endif
                            @if (!empty($countersales->Customer?->gst_number))
                                <p class="p-0 m-0">
                                    GST:- {{ $countersales->Customer?->gst_number ?? 'NA' }}
                                </p>
                            @endif
                        </td>
                        <td style="vertical-align: top">
                            <p class="m-0">
                                Invoice Number:- {{ $countersales->countersale_number }}
                            </p>
                            <p class="m-0">
                                Date:- {{ \Carbon\Carbon::now()->format('M d Y, h:i A') ?? '-' }}
                            </p>
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
                            <th class="text-center">HSN Number</th>
                            <th class="text-center">QTY</th>
                            <th class="text-center">unit</th>
                            <th class="text-center">Unit Price (Rs.)</th>
                            <th class="text-center">Tax</th>
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
                                <td class="text-center" style="width:50px !important;">{{ $__hsn }}</td>
                                <td class="text-center" style="width:60px !important;">
                                    {{ $counterSparePart->quantity }}</td>
                                <td class="text-center" style="width:60px !important;">{{ $__unitTitle }}</td>

                                <td class="text-start" style="width:60px !important;">
                                    {{ number_format($counterSparePart->price, 2) }}
                                </td>
                                <td class="text-center" style="width:30px !important;">
                                    {{ $__taxPercentage ? $__taxPercentage . '%' : '-' }}
                                </td>

                                <td class="text-end" style="width:10px !important;">
                                    {{ number_format($counterSparePart->discount, 2) }}
                                </td>
                                <td class="text-end" style="width:10px !important;">
                                    {{ number_format($counterSparePart->final_amount, 2) }}
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
                                // IMPORTANT → No round here
                                $taxable = $final / (1 + $rate / 100);
                                $gstAmt = $final - $taxable;
                                $cgst = $gstAmt / 2;
                                $sgst = $gstAmt / 2;
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


                    <tr>
                        <td colspan="11" class="text-end"><strong>Sub Total</strong></td>
                        <td class="text-end"><strong>{{ number_format($partsTotal, 2) }}</strong></td>
                    </tr>

                    <tr>
                        <td colspan="11" class="text-end">OUTPUT CGST</td>
                        <td class="text-end">{{ number_format($cgstPartsTotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="11" class="text-end">OUTPUT SGST</td>
                        <td class="text-end">{{ number_format($sgstPartsTotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="11" class="text-end">ROUND OFF</td>
                        <td class="text-end">
                            {{ $roundOffParts > 0 ? '' : '(-)' }}{{ number_format(abs($roundOffParts), 2) }}</td>
                    </tr>
                    <tfoot>
                        <tr>
                            <td colspan="9" class="text-end"><strong>Total</strong></td>
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
                    $__sp = \App\Models\SparePart::find($counterSparePart->stock_label_id);
                    $hsn = $__sp->hsn_code ?? '-';

                    $totalGstRate = (float) ($__sp->tax_percentage ?? 0);
                    // Use the Amount from upper table (final_amount) as the base to subtotal per HSN
                    $taxable = (float) ($counterSparePart->final_amount ?? 0);

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
                            <th>GST Type</th>
                            <th>GST %</th>
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
                                <td>{{ $extraCharge->gst_type }}</td>
                                <td>{{ $extraCharge->gst }}</td>
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
                            <td class="text-end" colspan="5"><strong>Total(Rs.)</strong></td>
                            <td class="text-end"><strong>{{ number_format($chargeTotal, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
                <b style="vertical-align:top;">
                    @php
                        echo ucfirst(getAmountInWords($chargeTotal)) . ' Rupees Only';
                    @endphp
                </b>
            @endif

            @if (!empty($gstSummary) && !empty(Auth::guard('sparepart')->user()->gst_number))
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
                <b style="vertical-align:top;">
                    @php
                        echo ucfirst(getAmountInWords($sumTax)) . ' Rupees Only';
                    @endphp
                </b>
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
