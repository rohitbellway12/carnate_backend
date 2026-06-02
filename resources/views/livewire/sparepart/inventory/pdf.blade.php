

<?php
    use App\Models\UploadImage;
    use Illuminate\Support\Facades\Auth;

    $sparepart = Auth::guard('sparepart')->user(); // get sparepart user
   // dd($sparepart);
    $image = null;

    if ($sparepart && $sparepart->branch_logo) {
        $uploadImage = UploadImage::find($sparepart->branch_logo);
        if ($uploadImage && $uploadImage->file) {
            $image = asset($uploadImage->file); // or public path based on setup
        }


    }
      if ($sparepart && $sparepart->branch_sign_logo) {
        $uploadImages = UploadImage::find($sparepart->branch_sign_logo);
       // dd($uploadImages);
        if ($uploadImages && $uploadImages->file) {
            $sign = asset($uploadImages->file);
            //dd($sign);
        }


    }


    if (!$image) {
        $image = asset('assets/images/sidebarlogo.png'); // fallback default image
    }
?>
<div>
<style>
* {
    -webkit-print-color-adjust: exact !important; /* For Chrome, Safari */
    print-color-adjust: exact !important;         /* For Firefox */
}

/* Header Buttons */
.header-icons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: end;
    margin-bottom: 20px;
}

.header-icons button {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    color: white;
    background-color: #007bff;
    box-shadow: 0 2px 6px rgba(0, 123, 255, 0.3);
    transition: background-color 0.3s, transform 0.2s;
    cursor: pointer;
}

.header-icons button:hover {
    background-color: #0056b3;
    transform: translateY(-1px);
}

.header-icons button:active {
    background-color: #004a99;
    transform: translateY(0);
}


    @media print {
        .header-icons {
            display: none !important;
        }
        body {
            padding: 0;
            margin: 0;
        }
        body * {
            visibility: hidden;
        }
        #po-content, #po-content * {
            visibility: visible;
        }
        #po-content {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            zoom: 0.85;
        }
    }


    @media print {
        .header-icons {
            display: none !important;
        }
        body {
            padding: 0;
            margin: 0;
        }
        body * {
            visibility: hidden;
        } b
        #po-content, #po-content * {
            visibility: visible;
        }
        #po-content {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            zoom: 0.85;
        }
    }

    table {
        table-layout: fixed;
        width: 100%;
        word-wrap: break-word;
    }

    .table th, .table td {
        font-size: 12px;
        padding: 6px 8px;
        vertical-align: middle !important;
        border: 1px solid #999 !important;
    }

    body {
        font-size: 14px;
        color: #000;
        background-color: #fff;
    }

    .header-icons i {
        font-size: 18px;
        margin-left: 12px;
        cursor: pointer;
        color: #000;
    }

    h4 {
        font-weight: bold;
    }

    .table .bg-lightblue {
        background-color: #B6CDEF!important;
        font-weight: 600;
    }

    .text-end {
        text-align: right !important;
    }

    .fw-bold {
        font-weight: 600 !important;
    }

    img {
        max-width: 100%;
    }


</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Purchase Order</h4>
  <div class="header-icons">
        <button onclick="shareWhatsApp()">WhatsApp</button>
        <button onclick="shareEmail()">Email</button>
        <button onclick="downloadPDF()">Download</button>
        <button onclick="window.print()">Print</button>
        <button onclick="window.history.back()">Close</button>
    </div>
</div>

<div id="po-content">
   @php
    $vendor = auth()->guard('sparepart')->user();
@endphp


    <div class="row mb-3">

        @if ($vendor && $vendor->profileImage && $vendor->profileImage->file)
            <div class="col-4">
                <!-- <img src="{{ asset('assets/images' . $vendor->profileImage->file) }}" alt="Company Logo" width="150"> -->
                 <img src="{{ $image }}" alt="Logo" width="150">
            </div>
        @else
            <div class="col-4">
                <img src="{{ asset('assets/images/sidebarlogo.png') }}" alt="Default Logo" width="150">
            </div>
        @endif


            @if ($vendor)
                <div class="col-8 text-end">
                    <strong>{{ $vendor->branch_name }}</strong><br>
                    <span class="text-success">{{ $vendor->tagline }}</span><br>
                    {{ $vendor->address }}<br>
                    <i class="fas fa-phone"></i> {{ $vendor->branch_number ?? $vendor->mobile_no }}<br>
                    <i class="fas fa-envelope"></i> {{ $vendor->branch_email ?? $vendor->email }}
                </div>
            @else
                <div class="col-8 text-end text-danger">
                    Vendor not logged in.
                </div>
            @endif


    </div>

    <!-- Order & Supplier Details -->
    <table class="table table-bordered mb-3">
        <tr class="bg-lightblue">
            <th colspan="2">Order To:</th>
            <th colspan="2">Purchase Order</th>
        </tr>
        <tr>
            <td colspan="2">
                {{ $order->supplier->business_first_name ?? 'N/A' }}<br>
                Address: {{ $order->supplier->business_address ?? '' }}<br>
            </td>
            <td colspan="2">
                PO Number: {{ $order->po_number }}<br>
                Date: {{ \Carbon\Carbon::parse($order->po_date)->format('d-m-Y') }}<br>
                Status: {{ ucfirst($order->po_status) }}
            </td>
        </tr>
    </table>

    <!-- Item Table -->
    <table class="table table-bordered mb-3">
        <thead class="bg-lightblue">
            <tr>
                <th>#</th>
                <th>Parts Name</th>
                <th>HSN/SAC</th>
                <th>Quantity</th>
                <th>Unit Price(₹)</th>
                <th>Discount</th>
                <th>Taxable Amount(₹)</th>
                <th>CGST(₹)</th>
                <th>SGST(₹)</th>
            {{-- <th>GST Type</th> --}}
                <th>Amount(₹)</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($order->items as $index => $item)
                @php $total += $item->total; @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->part_name ?? $item->name }}</td>
                    <td>{{ $item->hsn_code }}</td>
                    <td>{{ $item->qty ?? $item->quantity }} units</td>
                    <td>{{ $item->unit_price }}</td>
                    <td>₹ {{ $item->discount }}</td>
                    <td>{{ $item->taxable_amount ?? '' }}</td>
                    <td>{{ $item->cgst ?? '' }} ({{ $item->cgst_percent ?? 0 }}%)</td>
                    <td>{{ $item->sgst ?? '' }} ({{ $item->sgst_percent ?? 0 }}%)</td>
                   {{-- <td>{{ $item->gst_type ?? '' }}</td> --}}
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="9" class="text-end fw-bold">Total(₹)</td>
                <td class="fw-bold">{{ number_format($total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Tax & Amount Details -->
    <table class="table table-bordered mb-3">
        <tr class="bg-lightblue">
            <th>Tax Details:</th>
            <th>Amount Details:</th>
        </tr>
        <tr>
            <td>
                SGST: ₹ {{ $order->items->sum('sgst') }}<br>
                CGST: ₹ {{ $order->items->sum('cgst') }}<br>
              <strong>  GST Total: ₹ {{ number_format( $order->items->sum('sgst') + $order->items->sum('cgst'),2 )}} </strong><br>

            </td>
            <td>
                Total(₹):<br>
                <strong>{{ number_format($total, 2) }}</strong><br>
                Balance(₹):<br>
                <strong>{{ number_format($order->balance, 2) }}</strong>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <table class="table table-bordered">
        <tr class="bg-lightblue">
            <th>Amount In Words</th>
            <th>Authorized Signature</th>
        </tr>
        <tr>
            <td>
                {{ ucwords(getAmountInWords($total)) }} Rupees Only
            </td>
            <!-- <td><img src="{{ asset('assets/images/sidebarlogo.png') }}" alt="Stamp" height="40"></td> -->
             <td><img src="{{$sign}}" height="50"></td>
             <!-- <img src="{{ $image }}" alt="Logo" width="150"> -->
        </tr>
    </table>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    function shareWhatsApp() {
        const text = encodeURIComponent("Here is your Purchase Order: {{ url()->current() }}");
        window.open(`https://wa.me/?text=${text}`, '_blank');
    }

    function shareEmail() {
        const subject = encodeURIComponent("Purchase Order - {{ $order->po_number }}");
        const body = encodeURIComponent("Please find the purchase order.\n\nLink: {{ url()->current() }}");
        window.open(`https://mail.google.com/mail/?view=cm&fs=1&su=${subject}&body=${body}`, '_blank');
    }

    function downloadPDF() {
        const element = document.getElementById('po-content');
        const clone = element.cloneNode(true);

        const wrapper = document.createElement('div');
        wrapper.style.transform = "scale(0.64)";
        wrapper.style.transformOrigin = "top left";
        wrapper.style.width = "1160px";
        wrapper.style.padding = "20px";
        wrapper.style.backgroundColor = "#fff";

        wrapper.appendChild(clone);
        document.body.appendChild(wrapper);

        const opt = {
            margin: 0,
            filename: 'purchase-order.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(wrapper).save().then(() => {
            document.body.removeChild(wrapper);
        });
    }
</script>

</div>
