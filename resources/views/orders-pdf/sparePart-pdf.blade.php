<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antek123</title>

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
    $vendor = Auth::guard('sparepart')->user();

    $logoImage = null;

    if ($vendor && $vendor->profileImage && !empty($vendor->profileImage->file)) {

        $logoPath = public_path($vendor->profileImage->file);

        if (file_exists($logoPath)) {
            $logoImage = 'data:image/png;base64,' .
                base64_encode(file_get_contents($logoPath));
        }
    }
@endphp
    <div class="container">
        <div class="inner-container header">
            <div class="text-center" style="margin-bottom: 10px; color:#663399;font-size:20px;">
                {{ ($sparePart && $sparePart->is_gst == 1) ? 'TAX INVOICE' : 'CASH INVOICE' }}
            </div>

            <table class="table my-3">
                <tbody>
                    <tr>
                        <td class="p-0 border-0">
                       @if($logoImage)
                        <img src="{{ $logoImage }}" alt="Logo" style="max-width:150px;">
                          @endif
                        </td>
                        <td class="p-0 border-0">
                            <div class="info-box">
                                <h4 class="text-end m-0" style="color:black; font-size:16px;">
                                    @if ($order->payment_status == 1)
                                        <b>Invoice Number:-</b> {{ $order->spare_invoice_number ?? $order->invoice_number ?? $order->id }}
                                    @else
                                        <b>Order Number:-</b> {{ $order->id }}
                                    @endif
                                </h4>
                                <p class="text-end m-0">
                                    <b> Order Date:- </b> {{ $order->order_date }}
                                </p>
                                {{-- <p class="text-end m-0">
                                    <b> Total Amount:- </b> {{  $order->total_amount }}
                                </p> --}}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table my-3">
                <thead>
                    <tr>
                        <th>Bill From (Seller)</th>
                        <th>Bill To (Buyer)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: top">
                            <p class="p-0 m-0">
                                <b> Company Name:- </b> {{ $sparePart->company_name ?? $sparePart->branch_name ?? $sparePart->name }}
                            </p>
                            @php $vendorMobile = $sparePart->branch_number ?? $sparePart->mobile_no; @endphp
                            @if (!empty($vendorMobile))
                                <p class="p-0 m-0">
                                    <b> Mobile No:- </b> {{ $vendorMobile }}
                                </p>
                            @endif
                            @php $vendorEmail = $sparePart->branch_email ?? $sparePart->email; @endphp
                            @if (!empty($vendorEmail))
                                <p class="p-0 m-0">
                                    <b> Email:- </b> {{ $vendorEmail }}
                                </p>
                            @endif
                            @if (!empty($sparePart->address))
                                <p class="p-0 m-0">
                                    <b> Address:- </b> {{ $sparePart->address }}
                                </p>
                            @endif
                            @if (!empty($sparePart->gst_number))
                                <p class="p-0 m-0">
                                    <b> GST Number:- </b> {{ $sparePart->gst_number }}
                                </p>
                            @endif
                        </td>
                        <td style="vertical-align: top">
                            <p class="m-0">
                                <b> Company Name:- </b> {{ ucwords($admin->name) }}
                            </p>
                            <p class=" m-0">
                                <b> Email:- </b> {{ $admin->email }}
                            </p>
                            @if ($admin->mobile_no)
                                <p class=" m-0">
                                    <b> Mobile No:- </b> {{ $admin->mobile_no }}
                                </p>
                            @endif
                            @if ($admin->address)
                                <p class=" m-0">
                                    <b> Address:- </b> {{ $admin->address }}
                                </p>
                            @endif
                            @if ($admin->gst_number)
                                <p class="m-0">
                                    <b> GST Number:- </b> {{ $admin->gst_number }}
                                </p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            @if (count($order->orderItem) > 0)
                <div class="extraCharges my-3"><strong>Order Details</strong></div>

                <table class="table my-3">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th colspan="4" class="text-center">Spare Part</th>
                            <th class="text-center">HSN Number</th>
                            <th class="text-center">QTY</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Tax</th>
                            <th class="text-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $partsTotal = 0;
                            $totalQuantity = 0;
                            $taxablePartsTotal = 0;
                            $cgstPartsTotal = 0;
                            $sgstPartsTotal = 0;
                            $gstSummary = [];
                        @endphp
                        @foreach ($order->orderItem as $item)
                            @php
                                $hsn = $item->SpareParts->hsn_code ?? '-';
                                $qty = (float) $item->quantity;
                                $isGst = ($sparePart && $sparePart->is_gst == 1);
                                $taxRate = $isGst ? (float) (($item->spare_tax > 0) ? $item->spare_tax : ($item->SpareParts->tax_percentage ?? 0)) : 0.0;
                                $taxType = $isGst ? (!empty($item->spare_tax_type) ? $item->spare_tax_type : ($item->SpareParts->tax_type ?? 'exclude')) : 'exclude';

                                $commission = function_exists('getCommission') ? getCommission($item->category) : 0;
                                $originalTotalIncl = (float) $item->total_amount;
                                $totalIncl = $originalTotalIncl - ($originalTotalIncl * $commission / 100);

                                $qty = (float) $item->quantity;
                                $taxRate = $isGst ? (float) (($item->spare_tax > 0) ? $item->spare_tax : ($item->SpareParts->tax_percentage ?? 0)) : 0.0;
                                
                                $totalExcl = $totalIncl / (1 + $taxRate / 100);
                                $unitPriceExcl = $totalExcl / $qty;

                                $totalTax = $totalIncl - $totalExcl;

                                $partsTotal += $totalIncl;
                                $totalQuantity += $qty;
                                $taxablePartsTotal += $totalExcl;
                                $cgstPartsTotal += $totalTax / 2;
                                $sgstPartsTotal += $totalTax / 2;

                                if (!isset($gstSummary[$hsn])) {
                                    $gstSummary[$hsn] = ['taxable' => 0.0, 'rate' => $taxRate];
                                }
                                $gstSummary[$hsn]['taxable'] += $totalExcl;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td colspan="4">{{ $item->SpareParts?->label?->title }}</td>
                                <td class="text-center">{{ $hsn }}</td>
                                <td class="text-center">{{ $qty }}</td>
                                <td class="text-end">{{ number_format($unitPriceExcl, 2) }}</td>
                                <td class="text-center">{{ $taxRate }}% ({{ $taxType == 'include' ? 'Incl.' : 'Excl.' }})</td>
                                <td class="text-end">{{ number_format($totalIncl, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                             <td colspan="9" class="text-end"><strong>Sub Total</strong></td>
                            <td class="text-end"><strong>{{ number_format($taxablePartsTotal, 2) }}</strong></td>
                        </tr>
                        @if ($sparePart && $sparePart->is_gst == 1)
                        <tr>
                            <td colspan="9" class="text-end">OUTPUT CGST</td>
                            <td class="text-end">{{ number_format($cgstPartsTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-end">OUTPUT SGST</td>
                            <td class="text-end">{{ number_format($sgstPartsTotal, 2) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="7" class="text-end"><strong>Total</strong></td>
                            <td class="text-center"><strong>{{ number_format($totalQuantity) }} Qty</strong></td>
                             <td class="text-end"><strong>Total</strong></td>
                            <td class="text-end"><strong>{{ number_format($partsTotal, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>

                @if ($sparePart && $sparePart->is_gst == 1)
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
                            <th class="text-center">Total Tax Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gstSummary as $hsn => $row)
                            @php
                                $taxable = $row['taxable'];
                                $halfRate = $row['rate'] / 2;
                                $cgst = ($taxable * $halfRate) / 100;
                                $sgst = ($taxable * $halfRate) / 100;
                                $rowTax = $cgst + $sgst;
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
                </table>
                @endif
            @endif
        </div>
    </div>
</body>

</html>
