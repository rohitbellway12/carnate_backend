<?php
    use App\Models\UploadImage;
    use Illuminate\Support\Facades\Auth;

    $sparepart = Auth::guard('sparepart')->user();
    $image = null;
    $sign = null;

    if ($sparepart && $sparepart->branch_logo) {
        $uploadImage = UploadImage::find($sparepart->branch_logo);
        if ($uploadImage && $uploadImage->file) {
            $image = asset($uploadImage->file);
        }
    }

    if ($sparepart && $sparepart->branch_sign_logo) {
        $uploadImages = UploadImage::find($sparepart->branch_sign_logo);
        if ($uploadImages && $uploadImages->file) {
            $sign = asset($uploadImages->file);
        }
    }

    if (!$image) {
        $image = asset('assets/images/sidebarlogo.png');
    }

    // Prepare WhatsApp Phone and Message
    $rawPhone = $order->supplier->mobile_no ?? $order->supplier->contact_1 ?? '';
    $cleanPhone = preg_replace('/[^0-9]/', '', $rawPhone);
    if (strlen($cleanPhone) === 10) {
        $cleanPhone = '91' . $cleanPhone;
    }

    $vendorName = $sparepart->branch_name ?? 'Spare Parts Vendor';
    $poNumber = $order->po_no ?? $order->po_number ?? ('PO-' . $order->id);
    $pdfUrl = url()->current();
    $supplierName = $order->supplier->business_first_name ?? 'Supplier';

    $waMessage = "Hello " . $supplierName . ",\n\nPlease find Purchase Order *" . $poNumber . "* from *" . $vendorName . "*.\n\n📄 *Download / View PO PDF:*\n" . $pdfUrl . "\n\nThank you!";
?>
<div class="po-pdf-page">

<style>
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        font-size: 13px;
        color: #1e293b;
        background-color: #f1f5f9;
        margin: 0;
        padding: 0;
    }

    .po-pdf-page {
        padding: 20px 10px;
    }

    /* Action Toolbar (No Print) */
    .header-toolbar {
        max-width: 210mm;
        margin: 0 auto 16px auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .toolbar-title {
        margin: 0;
        font-size: 19px;
        font-weight: 700;
        color: #0f172a;
    }

    .header-icons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .header-icons .btn-action {
        padding: 8px 16px;
        border: none;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        color: white;
        background-color: #2563eb;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25);
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .header-icons .btn-action:hover {
        background-color: #1d4ed8;
        transform: translateY(-1px);
    }

    .header-icons .btn-whatsapp {
        background-color: #25D366 !important;
        box-shadow: 0 2px 6px rgba(37, 211, 102, 0.3) !important;
    }

    .header-icons .btn-whatsapp:hover {
        background-color: #1ebe57 !important;
    }

    .header-icons .btn-download {
        background-color: #e53935 !important;
        box-shadow: 0 2px 6px rgba(229, 57, 53, 0.25) !important;
    }

    .header-icons .btn-download:hover {
        background-color: #d32f2f !important;
    }

    .header-icons .btn-secondary {
        background-color: #64748b !important;
        box-shadow: 0 2px 6px rgba(100, 116, 139, 0.25) !important;
    }

    .header-icons .btn-secondary:hover {
        background-color: #475569 !important;
    }

    /* A4 Paper Container */
    #po-wrapper {
        width: 100%;
        max-width: 210mm;
        min-height: 297mm;
        margin: 0 auto;
        background: #ffffff;
        padding: 14mm 15mm;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        position: relative;
    }

    table {
        table-layout: fixed;
        width: 100%;
        border-collapse: collapse;
        word-wrap: break-word;
        margin-bottom: 14px;
    }

    .table th, .table td {
        font-size: 11.5px;
        padding: 7px 9px;
        vertical-align: middle !important;
        border: 1px solid #cbd5e1 !important;
        color: #1e293b;
    }

    .table .bg-lightblue {
        background-color: #e0f2fe !important;
        color: #0369a1 !important;
        font-weight: 700;
        font-size: 12px;
    }

    .text-end {
        text-align: right !important;
    }

    .fw-bold {
        font-weight: 700 !important;
    }

    /* Print & A4 Page Rules */
    @page {
        size: A4 portrait;
        margin: 10mm 10mm;
    }

    @media print {
        body {
            background: #ffffff !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .header-toolbar, .no-print {
            display: none !important;
        }

        .po-pdf-page {
            padding: 0 !important;
        }

        #po-wrapper {
            max-width: 100% !important;
            width: 100% !important;
            min-height: auto !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    }
</style>

{{-- Action Toolbar --}}
<div class="header-toolbar no-print">
    <h4 class="toolbar-title">
        <i class="fas fa-file-invoice me-1" style="color: #e53935;"></i>
        Purchase Order #{{ $order->po_no ?? $order->po_number ?? $order->id }}
    </h4>
    <div class="header-icons">
        <button type="button" class="btn-action btn-whatsapp" onclick="shareWhatsApp()" title="Send direct to supplier WhatsApp">
            <i class="fab fa-whatsapp"></i> Share on WhatsApp
        </button>
        <button type="button" class="btn-action" onclick="shareEmail()" title="Share via Email">
            <i class="fas fa-envelope"></i> Email
        </button>
        <button type="button" class="btn-action btn-download" onclick="downloadPDF()" title="Download PDF file">
            <i class="fas fa-download"></i> Download PDF
        </button>
        <button type="button" class="btn-action" onclick="window.print()" title="Print A4 document">
            <i class="fas fa-print"></i> Print
        </button>
        <button type="button" class="btn-action btn-secondary" onclick="window.history.back()" title="Go back">
            <i class="fas fa-arrow-left"></i> Back
        </button>
    </div>
</div>

{{-- A4 Printable Sheet --}}
<div id="po-wrapper">
    <div id="po-content">

        @php
            $vendor = auth()->guard('sparepart')->user();
        @endphp

        {{-- Header Section: Logo & Vendor Info --}}
        <table style="border: none; margin-bottom: 16px;">
            <tr style="border: none;">
                <td style="border: none; width: 45%; vertical-align: top; padding: 0;">
                    <img src="{{ $image }}" alt="Vendor Logo" style="max-height: 70px; max-width: 190px; object-fit: contain;">
                </td>
                <td style="border: none; width: 55%; text-align: right; vertical-align: top; padding: 0;">
                    @if ($vendor)
                        <div style="font-size: 16px; font-weight: 700; color: #0f172a;">{{ $vendor->branch_name }}</div>
                        @if(!empty($vendor->tagline))
                            <div style="font-size: 11px; color: #16a34a; font-weight: 600;">{{ $vendor->tagline }}</div>
                        @endif
                        <div style="font-size: 11.5px; color: #475569; margin-top: 3px;">
                            {{ $vendor->address }}<br>
                            @if(!empty($vendor->branch_number) || !empty($vendor->mobile_no))
                                <i class="fas fa-phone-alt me-1 text-muted"></i> {{ $vendor->branch_number ?? $vendor->mobile_no }} &nbsp;
                            @endif
                            @if(!empty($vendor->branch_email) || !empty($vendor->email))
                                <i class="fas fa-envelope me-1 text-muted"></i> {{ $vendor->branch_email ?? $vendor->email }}
                            @endif
                        </div>
                    @else
                        <div style="font-size: 15px; font-weight: 700;">Purchase Order</div>
                    @endif
                </td>
            </tr>
        </table>

        <div style="text-align: center; border-top: 2px solid #e2e8f0; border-bottom: 2px solid #e2e8f0; padding: 6px 0; margin-bottom: 14px;">
            <span style="font-size: 15px; font-weight: 700; letter-spacing: 1px; color: #0f172a; text-transform: uppercase;">
                PURCHASE ORDER
            </span>
        </div>

        {{-- Order & Supplier Details --}}
        <table class="table mb-3">
            <tr class="bg-lightblue">
                <th style="width: 50%;">ORDER TO (SUPPLIER)</th>
                <th style="width: 50%;">ORDER DETAILS</th>
            </tr>
            <tr>
                <td style="vertical-align: top; line-height: 1.5;">
                    <strong style="font-size: 13px; color: #0f172a;">{{ $order->supplier->business_first_name ?? 'N/A' }}</strong><br>
                    @if(!empty($order->supplier->owner_first_name))
                        <span>Contact Person: {{ $order->supplier->owner_first_name }}</span><br>
                    @endif
                    @if(!empty($order->supplier->business_address))
                        <span>Address: {{ $order->supplier->business_address }}</span><br>
                    @endif
                    @if(!empty($order->supplier->mobile_no) || !empty($order->supplier->contact_1))
                        <span>Mobile: {{ $order->supplier->mobile_no ?? $order->supplier->contact_1 }}</span><br>
                    @endif
                    @if(!empty($order->supplier->gstin))
                        <span>GSTIN: <strong>{{ $order->supplier->gstin }}</strong></span>
                    @endif
                </td>
                <td style="vertical-align: top; line-height: 1.5;">
                    <span>PO Number: <strong style="color: #0f172a;">{{ $order->po_no ?? $order->po_number ?? ('PO-' . $order->id) }}</strong></span><br>
                    <span>PO Date: <strong>{{ !empty($order->po_date) ? \Carbon\Carbon::parse($order->po_date)->format('d-m-Y') : 'N/A' }}</strong></span><br>
                    @if(!empty($order->bill_no))
                        <span>Bill No: <strong>{{ $order->bill_no }}</strong></span><br>
                    @endif
                    @if(!empty($order->bill_date))
                        <span>Bill Date: <strong>{{ \Carbon\Carbon::parse($order->bill_date)->format('d-m-Y') }}</strong></span><br>
                    @endif
                    <span>Status: <strong style="color: #16a34a;">{{ ucfirst($order->po_status ?? 'Open') }}</strong></span>
                </td>
            </tr>
        </table>

        {{-- Item Table --}}
        <table class="table mb-3">
            <thead class="bg-lightblue">
                <tr>
                    <th style="width: 35px; text-align: center;">#</th>
                    <th>Part Name / Description</th>
                    <th style="width: 80px;">HSN/SAC</th>
                    <th style="width: 70px; text-align: center;">Qty</th>
                    <th style="width: 85px; text-align: right;">Unit Price (₹)</th>
                    <th style="width: 75px; text-align: right;">Discount</th>
                    <th style="width: 90px; text-align: right;">Taxable (₹)</th>
                    <th style="width: 80px; text-align: right;">GST (₹)</th>
                    <th style="width: 95px; text-align: right;">Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $total = 0; 
                    $totalQty = 0;
                @endphp
                @foreach($order->items as $index => $item)
                    @php 
                        $total += $item->total; 
                        $qty = $item->qty ?? $item->quantity ?? 1;
                        $totalQty += $qty;
                        $cgst = floatval($item->cgst ?? 0);
                        $sgst = floatval($item->sgst ?? 0);
                        $itemGst = $cgst + $sgst;
                    @endphp
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $item->part_name ?? $item->name }}</strong>
                            @if(!empty($item->brand))
                                <br><small class="text-muted">Brand: {{ $item->brand }}</small>
                            @endif
                        </td>
                        <td>{{ $item->hsn_code ?? '-' }}</td>
                        <td style="text-align: center;">{{ $qty }}</td>
                        <td style="text-align: right;">{{ number_format($item->unit_price, 2) }}</td>
                        <td style="text-align: right;">{{ !empty($item->discount) ? ('₹ ' . number_format($item->discount, 2)) : '-' }}</td>
                        <td style="text-align: right;">{{ number_format($item->taxable_amount ?? $item->total, 2) }}</td>
                        <td style="text-align: right;">{{ $itemGst > 0 ? number_format($itemGst, 2) : '-' }}</td>
                        <td style="text-align: right; font-weight: 600;">{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
                <tr style="background: #f8fafc;">
                    <td colspan="3" style="font-weight: 700; text-align: right;">Total Items / Quantity:</td>
                    <td style="text-align: center; font-weight: 700;">{{ $totalQty }}</td>
                    <td colspan="4" style="text-align: right; font-weight: 700;">Grand Total (₹):</td>
                    <td style="text-align: right; font-weight: 700; color: #0f172a;">{{ number_format($total, 2) }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Tax & Amount Summary --}}
        <table class="table mb-3">
            <tr class="bg-lightblue">
                <th style="width: 50%;">TAX DETAILS</th>
                <th style="width: 50%;">PAYMENT & BALANCE SUMMARY</th>
            </tr>
            <tr>
                <td style="vertical-align: top; line-height: 1.6;">
                    <span>SGST: <strong>₹ {{ number_format($order->items->sum('sgst'), 2) }}</strong></span><br>
                    <span>CGST: <strong>₹ {{ number_format($order->items->sum('cgst'), 2) }}</strong></span><br>
                    <span>Total GST: <strong style="color: #0f172a;">₹ {{ number_format($order->items->sum('sgst') + $order->items->sum('cgst'), 2) }}</strong></span>
                </td>
                <td style="vertical-align: top; line-height: 1.6;">
                    <div style="display: flex; justify-content: space-between;">
                        <span>Total Payable:</span>
                        <strong>₹ {{ number_format($total, 2) }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Paid Amount:</span>
                        <strong style="color: #16a34a;">₹ {{ number_format($order->paid ?? 0, 2) }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; border-top: 1px dashed #cbd5e1; padding-top: 3px; margin-top: 3px;">
                        <span>Balance Due:</span>
                        <strong style="color: #dc2626;">₹ {{ number_format($order->balance ?? ($total - ($order->paid ?? 0)), 2) }}</strong>
                    </div>
                </td>
            </tr>
        </table>

        {{-- Footer & Signatures --}}
        <table class="table" style="margin-bottom: 0;">
            <tr class="bg-lightblue">
                <th style="width: 65%;">AMOUNT IN WORDS</th>
                <th style="width: 35%; text-align: center;">AUTHORIZED SIGNATURE</th>
            </tr>
            <tr>
                <td style="vertical-align: middle; font-weight: 600; color: #334155; padding: 12px 10px;">
                    {{ ucwords(getAmountInWords($total)) }} Rupees Only
                </td>
                <td style="text-align: center; vertical-align: bottom; height: 70px; padding: 10px;">
                    @if(!empty($sign))
                        <img src="{{ $sign }}" alt="Authorized Signature" style="max-height: 45px; object-fit: contain;"><br>
                    @else
                        <div style="height: 35px;"></div>
                    @endif
                    <span style="font-size: 11px; color: #64748b; border-top: 1px solid #cbd5e1; display: inline-block; padding-top: 4px; min-width: 140px;">
                        Authorized Signatory
                    </span>
                </td>
            </tr>
        </table>

    </div>
</div>

</div>

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    function shareWhatsApp() {
        const phone = "{{ $cleanPhone }}";
        const message = {!! json_encode($waMessage) !!};
        
        let url = "";
        if (phone && phone.length >= 10) {
            url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
        } else {
            url = `https://wa.me/?text=${encodeURIComponent(message)}`;
        }
        window.open(url, '_blank');
    }

    function shareEmail() {
        const subject = encodeURIComponent("Purchase Order - {{ $order->po_no ?? $order->po_number ?? $order->id }}");
        const body = encodeURIComponent("Dear {{ $order->supplier->business_first_name ?? 'Supplier' }},\n\nPlease find the purchase order.\n\nDirect View / Download Link: {{ url()->current() }}\n\nRegards,\n{{ $vendor->branch_name ?? 'Vendor' }}");
        window.open(`https://mail.google.com/mail/?view=cm&fs=1&su=${subject}&body=${body}`, '_blank');
    }

    function downloadPDF() {
        const element = document.getElementById('po-wrapper');
        const filename = 'PO-{{ $order->po_no ?? $order->po_number ?? $order->id }}.pdf';

        const opt = {
            margin: [8, 8, 8, 8],
            filename: filename,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true, letterRendering: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save();
    }
</script>