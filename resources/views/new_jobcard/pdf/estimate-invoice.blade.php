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
          }

          .container {
              width: 100%;
              background-color: #ffffff;
          }

          .inner-container {
              background-color: #ffffff;
              border: 1px solid #ddd;
              padding: 20px;
          }


          .header .logo {
              max-width: 200px;
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
              font-size: 14px;
          }

          .status {
              font-size: 14px;
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
              font-size: 14px;
              color: #333;
          }

          .table th,
          .table td {
              padding: 10px;
              border: none;
              text-align: left;
              border: 1px solid;
          }

          .table th {
              background-color: #ed8e8a5d;
              /* margin: 0px !important;
            padding: 0px !important; */
          }

          .phoneIMG,
          .userIMG,
          .phoneIMGdd {
              max-width: 15px;
              height: auto;
          }

          .bill-info,
          .vehicle-info {
              width: 49%;
              display: inline-block;
          }

          .text-end {
              text-align: right !important;
          }

          .footer {
              display: inline-block;
              width: 49%;
              vertical-align: baseline;
              text-align: center;
          }
      </style>
  </head>

  <body>
      @php
          use Illuminate\Support\Number;
      @endphp
      <div class="container">
          <div class="inner-container ">

              <table style="width: 100%; border-collapse: collapse; border: 1px solid; margin-bottom: 10px;">
                  <tr>
                      <!-- Left Column: Logo, Tagline & Contact Info -->
                      <td style="width: 50%; vertical-align: top;">
                          <table>
                              <tr>
                              {{--    <td>
                                      <img src="{{ file_exists(public_path($logo->Image->file)) ? 'data:image/png;base64,' . base64_encode(file_get_contents(public_path($logo->Image->file))) : 'path/to/default/image.png' }}"
                                          alt="Logo" style="height: 40px;">
                                  </td> --}}
                                           <td>
    <img src="{{ file_exists(public_path($logo->Image->file)) ? 'data:image/png;base64,' . base64_encode(file_get_contents(public_path($logo->Image->file))) : 'path/to/default/image.png' }}"
         alt="Logo" style="height: 20px; width: auto;">
</td>
                              </tr>
                           <tr>
    <td style="font-size: 15px; max-width: 250px; font-weight: bold;">
        {{ $logo->branch_name }}
    </td>
</tr>


                              <tr>
                                  <td style="font-size: 12px; max-width: 250px;">
                                      {{ Str::limit($logo->tagline, 500) }}
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <table style="font-size: 12px; margin-top: 5px;">
                                          <tr>
                                              <td style="padding-right: 5px; vertical-align: top;">
                                                  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/icons/Vector (15).png'))) }}"
                                                      alt="Email Icon" style="height: 14px;">
                                              </td>
                                              <td>{{ $logo->branch_email }}</td>
                                          </tr>
                                          <tr>
                                              <td style="padding-right: 5px; vertical-align: top;">
                                                  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/icons/phoneimg1.png'))) }}"
                                                      alt="Phone Icon" style="height: 14px;">
                                              </td>
                                              <td>{{ $logo->branch_number }}</td>
                                          </tr>
                                          <tr>
                                              <td style="padding-right: 5px; vertical-align: top;">
                                                  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/icons/Vector (14).png'))) }}"
                                                      alt="Address Icon" style="height: 14px;">
                                              </td>
                                              <td>{{ $logo->address }}</td>

                                          </tr>
                                           @if(Auth::guard('workshop')->user()->is_gst)
                                            <tr>
                                              <td style="padding-right: 5px; vertical-align: top;">
                                                 <p>GST</p>
                                              </td>
                                              <td>{{ $logo->gst }}</td>

                                          </tr>
                                           @endif
                                      </table>
                                  </td>
                              </tr>
                          </table>
                      </td>

                      <!-- Right Column: Estimate Info -->
                      <td style="width: 50%; vertical-align: top; border: 1px solid;">
                          <table style="font-size: 12px;">
                              <tr>
                                   <td colspan="2" style="text-align: center;">
                                       <h2 style="text-align: center; margin: 0;">{{ $pdfTitle ?? 'Estimate' }}</h2>
                                   </td>
                              </tr>
                              <tr>
                                  <td style="font-weight: bold;">Job-Card Number:</td>
                                  <td>{{ $newjobcard->jobcard_number ?? 'N/A' }}</td>
                              </tr>
                              <tr>
                                  <td style="font-weight: bold;">Date:</td>
                                  <td>{{ \Carbon\Carbon::parse($newjobcard->entry_date)->format('d-m-Y') ?? '-' }}</td>
                              </tr>
                              <tr>
                                  <td style="font-weight: bold;">Time:</td>
                                  <td>{{ \Carbon\Carbon::parse($newjobcard->entry_date)->format('h:i A') ?? '-' }}</td>
                              </tr>
                          </table>
                      </td>
                  </tr>
              </table>



              <table style="width:100%;">
                  <tbody>
                      <tr>
                          <td style="width:49%;vertical-align: top;">
                              <table class="table" style="font-size: 12px;">
                                  <thead>
                                      <tr>
                                          <th>BILL TO</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>
                                              @if ($customer->cust_type == 1)
                                                  {{ $customer->company_name ? 'M/S ' . $customer->company_name : $customer?->name . ' ' . $customer?->lastname }}
                                              @else
                                                  {{ $customer?->name }} {{ $customer?->lastname }}
                                              @endif
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>{{ $customer->mobile_no }}</td>
                                      </tr>
                                      <tr>
                                          <td>{{ $customer->email }}</td>
                                      </tr>
                                  </tbody>
                              </table>
                          </td>
                          <td style="width:49%;vertical-align: top;">
                              <table class="table" style="font-size: 12px;">
                                  <thead>
                                      <tr>
                                          <th>Vehicle Info</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td> <strong>Veh. No.</strong> {{ $vehicles->number_plate }}</td>
                                      </tr>
                                      <tr>
                                          @php
                                              $modelname = array_filter([
                                                  $vehicles->brand ?? '',
                                                  $vehicles->variant ?? '',
                                                  $vehicles->year ?? '',
                                                  $vehicles->modification ?? '',
                                              ]);
                                          @endphp
                                          <td><strong> Vehicle Name : </strong>{{ implode(' ', $modelname) }}</td>
                                      </tr>
                                      <tr>
                                          <td><strong>Engine No.</strong> {{ $vehicles->engineno }}</td>
                                      </tr>
                                      <tr>
                                          <td> <strong>Chassis No.</strong>{{ $vehicles->chassis_no }}</td>
                                      </tr>
                                      <tr>
                                          <td>Km Read. <strong>{{ $newjobcard->km_runing }}</strong>, Fuel Level :
                                              <strong>{{ $newjobcard->fual_level }}%</strong>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </td>
                      </tr>
                  </tbody>
              </table>
              @if (count($jobCardSpareParts->where('category', 1)) > 0)
                  <table class="table" style="margin-top: 10px; font-size: 12px;">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Accessory Items</th>

                              <th>HSN Number</th>
                              <th>Part Number</th>
                              <th>Qt.</th>
                            <th>unit</th>
                               <th>Rate</th>
                               @if($logo->is_gst)
                        <th>Tax Type</th>
                        <th>Tax</th>
                        @endif
                              <th style="text-align: right;">Disc.</th>
                              <th style="text-align: right;">Amount</th>
                              <th style="text-align: right;">Total Price</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($jobCardSpareParts->where('category', 1) as $jobCardSparePart)
                              @php
                                  $__sp = \App\Models\SparePart::where('label_id', $jobCardSparePart->stock_label_id)->first();
                                  $__ps = \App\Models\ProductStock::where('label_id', $jobCardSparePart->stock_label_id)->first();
                                  
                                  $__hsn = $__sp ? ($__sp->hsn_code ?? '-') : '-';
                                  $__partno = $__sp ? ($__sp->part_number ?? '-') : '-';
                                  $__unitTitle = $__sp?->unit?->title ?? '-';
                                  
                                  if (empty($__unitTitle) || $__unitTitle === '-') {
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
                                  
                                  $__taxType = $jobCardSparePart->tax_type ?: ($__sp->tax_type ?? ($__ps->tax_type ?? 'exclude'));
                                  $__taxPercentage = $jobCardSparePart->tax_percentage ?: ($__sp->tax_percentage ?? ($__ps->tax_percentage ?? '0'));
                              @endphp
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $jobCardSparePart->labels?->title ?? '-' }}</td>
                                  <td>{{ $__hsn }}</td>
                                  <td>{{ $__partno }}</td>
                                  <td>{{ $jobCardSparePart->quantity ?? 0 }}</td>
                                <td>{{ $__unitTitle }}</td>

                                  <td class="text-end">{{ number_format($jobCardSparePart->total_amount, 2) ?? 0 }}
                           @if($logo->is_gst)
                                  <td>{{ ucfirst($__taxType) ?? '-' }}</td>
                                  <td>{{ $__taxPercentage ?? '-' }}</td>
                                     @endif
                                  </td>
                                   <td class="text-end">{{ $jobCardSparePart->discount ?? 0 }}</td>
                                   <td class="text-end">{{ number_format($jobCardSparePart->final_amount, 2) ?? 0 }}
                                   </td>
                                   <td class="text-end">{{ number_format($jobCardSparePart->total_amount, 2) ?? 0 }}</td>
                               </tr>
                           @endforeach
                       </tbody>
                   </table>
               @endif
               @if (count($jobCardSpareParts->where('category', 2)) > 0)
                  <table class="table" style="margin-top: 10px; font-size: 12px;">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Spare Items</th>
                              <th>Spare Type</th>
                              <th>HSN Number</th>
                              <th>Qt.</th>
                               <th>unit</th>
                              <th>Rate</th>
                            @if($logo->is_gst)
                        <th>Tax Type</th>
                        <th>Tax</th>
                        @endif

                              <th style="text-align: right;">Disc.</th>
                              <th style="text-align: right;">Amount</th>
                              <th style="text-align: right;">Total Price</th>
                           </tr>
                       </thead>
                       <tbody>
                             @foreach ($jobCardSpareParts->where('category', 2) as $jobCardSparePart)
                              @php
                                  $__sp = \App\Models\SparePart::where('label_id', $jobCardSparePart->stock_label_id)->first();
                                  $__ps = \App\Models\ProductStock::where('label_id', $jobCardSparePart->stock_label_id)->first();
                                  
                                  $__hsn = $__sp ? ($__sp->hsn_code ?? '-') : '-';
                                  $__partno = $__sp ? ($__sp->part_number ?? '-') : '-';
                                  $__unitTitle = $__sp?->unit?->title ?? '-';
                                  
                                  if (empty($__unitTitle) || $__unitTitle === '-') {
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
                                  
                                  $__taxType = $jobCardSparePart->tax_type ?: ($__sp->tax_type ?? ($__ps->tax_type ?? 'exclude'));
                                  $__taxPercentage = $jobCardSparePart->tax_percentage ?: ($__sp->tax_percentage ?? ($__ps->tax_percentage ?? '0'));

                                  $spType = null;
                                  if ($__sp && isset($__sp->sp_type)) {
                                      $spType = $__sp->sp_type;
                                  } elseif ($__ps && isset($__ps->sp_type)) {
                                      $spType = $__ps->sp_type;
                                  }

                                  if ($spType !== null) {
                                      if ((int)$spType === 0) {
                                          $spTypeText = 'New';
                                      } elseif ((int)$spType === 1) {
                                          $spTypeText = 'Used';
                                      } else {
                                          $spTypeText = '-';
                                      }
                                  } else {
                                      $spTypeText = '-';
                                  }
                              @endphp
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $jobCardSparePart->labels?->title ?? '-' }}</td>
                                  <td>{{ $spTypeText }}</td>
                                  <td>{{ $__hsn }}</td>
                                  <td>{{ $jobCardSparePart->quantity ?? 0 }}</td>
                                   <td>{{ $__unitTitle }}</td>
                                  <td class="text-end">
    {{ number_format((float) $jobCardSparePart->price, 2) }}

</td>

                                @if($logo->is_gst)
                        <td>{{ ucfirst($__taxType) ?? '-' }}</td>
                        <td>{{ $__taxPercentage ?? '-' }}</td>
                        @endif
                           <td class="text-end">
   <span style="font-family: DejaVu Sans;">
     {{ $jobCardSparePart->discount ?? 0 }}
     @if($jobCardSparePart->discount_type === 'fixed')
         ₹
     @elseif($jobCardSparePart->discount_type === 'percent')
         %
     @endif
 </span>

 </td>

                                   <td class="text-end">{{ number_format($jobCardSparePart->final_amount, 2) ?? 0 }}
                                   </td>
                                   <td class="text-end">{{ number_format($jobCardSparePart->total_amount, 2) ?? 0 }}</td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif
              @if (count($jobCardSpareParts->where('category', 3)) > 0)
                  <table class="table" style="margin-top: 10px; font-size: 12px;">
                      <thead>
                           <tr>
                               <th style="width: 25px;">#</th>
                               <th style="width: 45%;">Tool Items</th>
                               <th>Qt.</th>
                               <th style="width: 100px; text-align: right;">Rate</th>
                               <th style="text-align: right;">Disc.</th>
                               <th style="width: 100px; text-align: right;">Amount</th>
                           </tr>
                      </thead>
                      <tbody>
                          @foreach ($jobCardSpareParts->where('category', 3) as $jobCardSparePart)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $jobCardSparePart->labels?->title ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->quantity ?? 0 }}</td>
                                   <td class="text-end">{{ number_format($jobCardSparePart->total_amount, 2) ?? 0 }}
                                   </td>
                                   <td class="text-end">{{ $jobCardSparePart->discount ?? 0 }}</td>
                                   <td class="text-end">{{ number_format($jobCardSparePart->final_amount, 2) ?? 0 }}
                                   </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif
              @if (count($jobCardSpareParts->where('category', 4)) > 0)
                  <table class="table" style="margin-top: 10px; font-size: 12px;">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Lube Items</th>
                              <th>HSN Number</th>
                              <th>Qt.</th>
                               <th>unit</th>
                              <th>Rate</th>
                                @if($logo->is_gst)
                        <th>Tax Type</th>
                        <th>Tax</th>
                        @endif
                              <th style="text-align: right;">Disc.</th>
                              <th style="text-align: right;">Amount</th>
                              <th style="text-align: right;">Total Price</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($jobCardSpareParts->where('category', 4) as $jobCardSparePart)
                              @php
                                  $__sp = \App\Models\SparePart::where('label_id', $jobCardSparePart->stock_label_id)->first();
                                  $__ps = \App\Models\ProductStock::where('label_id', $jobCardSparePart->stock_label_id)->first();
                                  
                                  $__hsn = $__sp ? ($__sp->hsn_code ?? '-') : '-';
                                  $__partno = $__sp ? ($__sp->part_number ?? '-') : '-';
                                  $__unitTitle = $__sp?->unit?->title ?? '-';
                                  
                                  if (empty($__unitTitle) || $__unitTitle === '-') {
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
                                  
                                  $__taxType = $jobCardSparePart->tax_type ?: ($__sp->tax_type ?? ($__ps->tax_type ?? 'exclude'));
                                  $__taxPercentage = $jobCardSparePart->tax_percentage ?: ($__sp->tax_percentage ?? ($__ps->tax_percentage ?? '0'));
                              @endphp
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $jobCardSparePart->labels?->title ?? '-' }}</td>
                                  <td>{{ $__hsn }}</td>
                                  <td>{{ $jobCardSparePart->quantity ?? 0 }}</td>
                                   <td>{{ $__unitTitle }}</td>
                                  <td class="text-end">{{ number_format($jobCardSparePart->total_amount, 2) ?? 0 }}
                                  </td>
                                  @if($logo->is_gst)
                        <td>{{ ucfirst($__taxType) ?? '-' }}</td>
                        <td>{{ $__taxPercentage ?? '-' }}</td>
                        @endif
                                   <td class="text-end">{{ $jobCardSparePart->discount ?? 0 }}</td>
                                   <td class="text-end">{{ number_format($jobCardSparePart->final_amount, 2) ?? 0 }}
                                   </td>
                                   <td class="text-end">{{ number_format($jobCardSparePart->total_amount, 2) ?? 0 }}</td>
                               </tr>
                           @endforeach
                       </tbody>
                   </table>
               @endif
 
               @if (count($jobCardExtraCharges) > 0)
                  <table class="table" style="margin-top: 10px; font-size: 12px;">
                      <thead>
                          <tr>
                              <th style="width: 25px;">#</th>
                              <th>Labour Items</th>
                              <th style="width: 100px;text-align:center;">Amount</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($jobCardExtraCharges as $jobCardExtraCharge)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $jobCardExtraCharge->label ?? '-' }}</td>
                                  {{--<td class="text-end">{{ number_format($jobCardExtraCharge->charges, 2) ?? 0 }}</td> --}}
                                  <td class="text-end">
    {{ number_format((float) ($jobCardExtraCharge->charges ?? 0), 2) }}
</td>

                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif
              <hr>
              <table class="table font-size: 13px;">
                  <tbody>
                      <tr>
                          <td style="text-align:right;"><b>Total Amount</b></td>
                          <td style="width: 2px;"><b>:</b></td>
                          <td style="width: 100px;text-align:right;">
                              <b>{{ number_format($newjobcard->final_amount, 2) }}</b>
                          </td>
                      </tr>
                      @php
    $totalDiscount = 0;
@endphp

@foreach ($jobCardSpareParts as $part)
    @php
        $price = floatval($part->total_amount ?? 0);
        $discount = floatval($part->discount ?? 0);
        $type = $part->discount_type ?? 'fixed';

        if ($type === 'fixed') {
            $totalDiscount += $discount;
        } elseif ($type === 'percent') {
            $totalDiscount += ($price * $discount / 100);
        }
    @endphp
@endforeach
                     @if($totalDiscount > 0)
<tr>
    <td style="text-align:right;"><b>Total Discount</b></td>
    <td style="width: 2px;"><b>:</b></td>
    <td style="width: 100px;text-align:right;">
        <b>{{ number_format($totalDiscount, 2) }}</b>
    </td>
</tr>
@endif
                      <tr>
                          <td style="text-align:right;"><b>Advance</b></td>
                          <td style="width: 2px;"><b>:</b></td>
                          <td style="width: 100px;text-align:right;">
                              <b>{{ number_format((float) ($newjobcard->advance ?? 0), 2) }}</b>
                          </td>
                      </tr>
                      <tr>
                          <td style="text-align:right;"><b>Balance</b></td>
                          <td style="width: 2px;"><b>:</b></td>
                          <td style="width: 100px;text-align:right;">
                              <b>{{ number_format($newjobcard->balance_amount, 2) }}</b>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
          <div class="inner-container" style="padding-bottom: 0px; font-size: 13px;">
              <p>BENZ / AUDI / BMW / MINI / VOLKSWAGON / SKODA / LANDROVER / JAGUAR / PORSCHE / VOLVO</p>
              <div style="text-align: center">
                  <p>Thank you for choosing our service.</p>
                  <p><small>Powered by: TTN Garage</small></p>
              </div>
          </div>
          <div class="inner-container" style="padding-bottom: 0px; font-size: 13px;">
              <div class="footer">Customer Signature</div>
              <div class="footer" style="border-left:1px solid black;">
                  {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(asset('general_setting/' . $logo->logo_image))) }}"
                      alt="Logo" class="logo" width="49%"> --}}
                  <p>Authorized Signature</p>
              </div>
          </div>
      </div>
  </body>

  </html>
