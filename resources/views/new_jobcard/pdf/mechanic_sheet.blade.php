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
      </style>
  </head>

  <body>
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
                                            <tr>
                                  <td style="vertical-align: top; padding-right: 5px;">
                                      <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/icons/gst_icon.png'))) }}"
                                          alt="GST Icon" style="height: 14px;">
                                  </td>
                                  <td>{{ $logo->gst }}</td>
                              </tr>
                                      </table>
                                  </td>
                              </tr>
                          </table>
                      </td>

                      <!-- Right Column: Estimate Info -->
                      <td style="width: 50%; vertical-align: top; border: 1px solid;">
                          <table style="font-size: 12px;">
                              <tr>
                                  <td colspan="2">
                                      <h2>{{ $pdfTitle ?? 'Mechanic Copy' }}</h2>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="font-weight: bold;">Job-Card Number:</td>
                                  <td>{{ $newjobcard->jobcard_number }}</td>
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




              <!-- Vehicle Info -->
              <table class="table" style="height:200px; font-size: 11px;">
                  <thead>
                      <tr>
                          <th>Vehicle Info</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>Veh. No. <strong>{{ $vehicles->number_plate }}</strong></td>
                          <td>Km Read. <strong>{{ $newjobcard->km_runing }}</strong></td>
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
                          <td>Vehicle Name : <strong>{{ implode(' ', $modelname) }}</strong></td>
                          <td>Fuel Level : <strong>{{ $newjobcard->fual_level }}%</strong></td>
                      </tr>
                      <tr>
                          <td>Engine No. <strong>{{ $vehicles->engineno }}</strong></td>
                          <td>Time :
                              <strong>{{ \Carbon\Carbon::parse($newjobcard->entry_date)->format('h:i A') ?? '-' }}</strong>
                          </td>
                      </tr>
                      <tr>
                          <td>Chassis No. <strong>{{ $vehicles->chassis_no }}</strong></td>
                          <td></td>
                      </tr>
                  </tbody>
              </table>


              {{-- <div class="customer_accessories" style="">  --}}
              <table class="table" style="height:auto; font-size: 10px;">
                  <tr>
                      <td style="width:100%; vertical-align: top;">
                          <div class="customer_voice" style="">
                              <!-- Customer Voice Table -->
                              <table class="table" style="">
                                  <thead>
                                      <tr>
                                          <th>Customer Voice</th>
                                      </tr>
                                  </thead>
                                  <tbody style="height: 100%">
                                      @php $i = 1; @endphp
                                      @foreach ($jobCardCustomerVoice as $jobCardCustomerVoices)
                                          <tr>
                                              <td>{{ $i }}.
                                                  <strong>{{ $jobCardCustomerVoices->customer_voice }}</strong>
                                              </td>
                                          </tr>
                                          @php $i++; @endphp
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </td>

                      <!-- Info Section -->
                      <td style="width:100%;vertical-align:top; font-size: 10px;">
                          <div class="accessories" style="">
                              <!-- Accessories Table -->
                              <table class="table" style="">
                                  <thead>
                                      <tr>
                                          <th>Work Note</th>
                                      </tr>
                                  </thead>
                                  <tbody style="height: 100%">
                                      @php $j = 1; @endphp
                                      @foreach ($jobCardAccessories as $jobCardAccessorie)
                                          <tr>
                                              <td>{{ $j }}.
                                                  <strong>{{ $jobCardAccessorie->customer_voice }}</strong>
                                              </td>
                                          </tr>
                                          @php $j++; @endphp
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </td>
                  </tr>
              </table>
              {{-- </div>  --}}

              @if (count($jobCardSpareParts->where('category', 1)) > 0)
                  <table class="table" style="margin-top: 10px; font-size: 10px;">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Accessory Items</th>
                              {{--
                              <th>HSN Number</th>
                              <th>Part Number</th>
                              <th>Quantity</th>
                              <th>Price </th>
                              <th>Tax Type</th>
                              <th>Tax</th>
                              <th>Discount </th>
                              <th>Total Price</th>
                              --}}
                              <th>Status</th>
                              <th>Mechanic</th>
                              {{-- <th>Remark</th> --}}
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($jobCardSpareParts->where('category', 1) as $jobCardSparePart)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $jobCardSparePart->labels?->title ?? '-' }}</td>
                                  {{--
                                  <td>{{ $jobCardSparePart->productStock?->hsn_code ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->productStock?->part_number ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->quantity ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->price ?? '-' }}</td>
                                  <td>{{ ucfirst($jobCardSparePart->productStock?->tax_type) ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->productStock?->tax_percentage ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->discount ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->total_amount ?? '-' }}</td>
                                  --}}
                                  <td></td>
                                  <td>{{ getUserFullName($jobCardSparePart->machanic_id) }}</td>
                                  {{-- <td></td> --}}
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif
              @if (count($jobCardSpareParts->where('category', 2)) > 0)
                  <table class="table" style="margin-top: 10px; font-size: 11px;">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Spare Items</th>
                              {{--
                              <th>HSN Number</th>
                              <th>Quantity</th>
                              <th>Price </th>
                              <th>Tax Type</th>
                              <th>Tax</th>
                              <th>Discount </th>
                              <th>Total Price</th>
                              --}}
                              <th>Status</th>
                              <th>Mechanic</th>
                              <th>Remark</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($jobCardSpareParts->where('category', 2) as $jobCardSparePart)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $jobCardSparePart->labels?->title ?? '-' }}</td>
                                  {{--
                                  <td>{{ $jobCardSparePart->productStock?->hsn_code ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->quantity ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->price ?? '-' }}</td>
                                  <td>{{ ucfirst($jobCardSparePart->productStock?->tax_type) ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->productStock?->tax_percentage ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->discount ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->total_amount ?? '-' }}</td>
                                  --}}
                                  <td></td>
                                  <td>{{ getUserFullName($jobCardSparePart->machanic_id) }}</td>
                                  <td></td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif
              @if (count($jobCardSpareParts->where('category', 3)) > 0)
                  <table class="table" style="margin-top: 10px; font-size: 11px;">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Tool Items</th>
                              <th>Status</th>
                              <th>Mechanic</th>
                              <th>Remark</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($jobCardSpareParts->where('category', 3) as $jobCardSparePart)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $jobCardSparePart->labels?->title ?? '-' }}</td>
                                  {{--
                                  <td>{{ $jobCardSparePart->productStock?->hsn_code ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->quantity ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->price ?? '-' }}</td>
                                  <td>{{ ucfirst($jobCardSparePart->productStock?->tax_type) ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->productStock?->tax_percentage ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->discount ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->total_amount ?? '-' }}</td>
                                  --}}
                                  <td></td>
                                  <td>{{ getUserFullName($jobCardSparePart->machanic_id) }}</td>
                                  <td></td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif
              @if (count($jobCardSpareParts->where('category', 4)) > 0)
                  <table class="table" style="margin-top: 10px; font-size: 11px;">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Lube Items</th>
                              {{--
                              <th>HSN Number</th>
                              <th>Quantity</th>
                              <th>Price </th>
                              <th>Tax Type</th>
                              <th>Tax</th>
                              <th>Discount </th>
                              <th>Total Price</th>
                              --}}
                              <th>Status</th>
                              <th>Mechanic</th>
                              <th>Remark</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($jobCardSpareParts->where('category', 4) as $jobCardSparePart)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $jobCardSparePart->labels?->title ?? '-' }}</td>
                                  {{--
                                  <td>{{ $jobCardSparePart->productStock?->hsn_code ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->quantity ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->price ?? '-' }}</td>
                                  <td>{{ ucfirst($jobCardSparePart->productStock?->tax_type) ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->productStock?->tax_percentage ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->discount ?? '-' }}</td>
                                  <td>{{ $jobCardSparePart->total_amount ?? '-' }}</td>
                                  --}}
                                  <td></td>
                                  <td>{{ getUserFullName($jobCardSparePart->machanic_id) }}</td>
                                  <td></td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif

              @if (count($jobCardExtraCharges) > 0)
                  <table class="table" style="margin-top: 10px; font-size: 11px;">
                      <thead>
                          <tr>
                              <th style="width: 25px;">#</th>
                              <th style="width: 45%;">Labour Items</th>
                              <th>Status</th>
                              <th>Mechanic</th>
                              <th>Remark</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($jobCardExtraCharges as $jobCardExtraCharge)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $jobCardExtraCharge->label ?? '-' }}</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif

          </div>
          @if ($newjobcard->step == 1)
              <div class="inner-container">
                  <p style="text-align: center">Vehicle need to be ready by :
                      {{ \carbon\carbon::parse($newjobcard->delivery_date)->format('d-m-Y') }}
                      {{ \carbon\carbon::parse($newjobcard->delivery_time)->format('h:i A') }}</p>
              </div>
          @endif
      </div>

  </body>

  </html>
