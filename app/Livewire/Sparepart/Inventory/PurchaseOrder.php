<?php

namespace App\Livewire\Sparepart\Inventory;

use App\Models\Modification;
use App\Models\UploadImage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\SparePartSupplier;
use App\Models\PurchaseOrder as PurchaseOrderModel;
use App\Models\SparePartLabel;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LogLevel;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.spare-part-app')]
class PurchaseOrder extends Component
{
    public $mode = 'list';

    //searcheee
    public $supplierSearch = '';
    public $supplier_name = '';
    public $supplier_phone = '';
    public $supplier_balance = '';
    public $supplierResults = [];
    public $selectedSupplierId = null;

    // add edit update Supplier
    public $showSupplierModal = false;
    public $isSupplierEdit = false;
    public $supplier_id;
    public $mobile_no, $business_first_name, $business_address, $gstin, $owner_first_name, $contact_1, $contact_2, $email;

    public $po_no = '';
    public $po_date = '';
    public $bill_no = '';
    public $bill_date = '';
    public $po_status = 'Open';

    public $po_list = [];

    public $part_search = '';
    public $partResults = [];
    public $showPartNumber = false;

    public $items = [];
    public $item_part_name = '';
    public $item_edit_index = null;
    public $selected_part_id = '';

    public $note = '';


    public $subtotal = 0;
    public $taxable_subtotal = 0;
    public $gst = 0;
    public $total_payable = 0;
    public $balance = 0;
    public $paid = 0;
    public $po_payment = 0;
    public $transaction_type;
    public $transaction_date;
    public $transaction_no;
    public $transporter_name;
    public $received_date;
    public $vehicle_number;
    public $delivery_person;
    public $lt_number;
    public $return_amount;
    public $previous_balance;
    public $total_balance;

    //edit
    public $isEdit = false;
    public $editingId = null;

    // --- PART CREATION MODAL STATE & FIELDS ---
    public $showPartModal = false;
    public $part_isEdit = false;
    public $part_name;
    public $part_brand;
    public $part_unit;
    public $part_stock;
    public $part_description;
    public $part_image_id;
    public $part_imagePreview;
    public $part_imageName;
    public $part_part_number;
    public $part_sp_type;
    public $part_purchase_amount;
    public $part_selling_amount;
    public $part_discount;
    public $part_discount_type = 1;
    public $part_tax_type;
    public $part_tax_percentage;
    public $part_hsn_code;
    public $part_rack_no;
    public $part_category;
    public $part_suitable_for = [];
    public $part_forAllVehicles = false;
    public $part_api_compatible_vehicles = [];
    public $part_part_image_url = null;
    public $part_units = [];
    public $part_categories = [];
    public $part_commission = 0;
    public $part_price = 0;
    public $part_customerPrice = 0;
    public $part_reflectedPrice = 0;
    public $partId = null;
    public $part_modifications = [];
    public $part_type = 'part'; // default type for Add Part modal
    public $sparepartId;
    public $totalOrders = 0;
    public $totalPaid = 0;
    public $totalPending = 0;
    public $search = '';
    public $date_range = '';
    public $brandFilter = '';
    protected $partRules = [
        'part_name' => 'required',
        'part_purchase_amount' => 'required|numeric|min:1',
        'part_selling_amount' => 'required|numeric|min:1',
        'part_unit' => 'required|numeric|min:1',
        'part_stock' => 'required|numeric|min:0',
        'part_brand' => 'nullable|string',
        'part_discount' => 'nullable|numeric|min:0',
        'part_description' => 'nullable|string',
        'part_sp_type' => 'required',
        'part_category' => 'required|numeric',
        'part_type' => 'required|in:part,lubricant,accessory',
    ];


    public function getGrandTotalProperty()
    {
        return collect($this->items)->sum('total');
    }

    protected $supplierRules = [
        'mobile_no' => 'required|string',
        'business_first_name' => 'required|string',
        'business_address' => 'nullable|string',
        'gstin' => 'nullable|string',
        'owner_first_name' => 'required|string',
        'contact_1' => 'required|string',
        'contact_2' => 'nullable|string',
        'email' => 'nullable|email',
    ];

    // Add validation rules for Transport Details and Transaction Type
    protected $transportRules = [
        'transporter_name' => 'nullable|string',
        'received_date' => 'nullable|date',
        'vehicle_number' => 'nullable|string',
        'delivery_person' => 'nullable|string',
        'lt_number' => 'nullable|string',
    ];
    protected $billRules = [
        'transaction_type' => 'nullable|string',
    ];

    public function mount()
    {
        $this->sparepartId = Auth::guard('sparepart')->user()->id;
        if (empty($this->po_date)) {
            $this->po_date = date('Y-m-d');
        }
        if (empty($this->bill_date)) {
            $this->bill_date = date('Y-m-d');
        }
        if (empty($this->po_status)) {
            $this->po_status = 'Open';
        }
        // Bill number logic for status
        if ($this->po_status === 'Open') {
            $this->bill_no = 0;
        }
        $this->loadPOList();
        // Initialize empty part results - no dropdown on page load
        $this->partResults = [];
        $this->calculateBillDetails();
        // For part modal
        $this->part_units = \App\Models\Unit::all();
        $this->part_modifications = \App\Models\Modification::where('status', 1)->get();
        $this->part_commission = function_exists('getCommission') ? getCommission(2) : 0;
        $this->part_categories = [];
        // Try to fetch categories from API (optional, fallback to empty)
        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
                'X-RapidAPI-Key' => config('services.rapidapi.key'),
            ])->get('https://auto-parts-catalog.p.rapidapi.com/category/category-products-groups-variant-2/19942/manufacturer-id/184/lang-id/4/country-filter-id/62/type-id/1');
            if ($response->successful() && isset($response['categories'])) {
                $this->part_categories = array_map(function ($cat) {
                    return [
                        'categoryId' => $cat['categoryId'],
                        'categoryName' => $cat['categoryName']
                    ];
                }, array_values($response['categories']));
            }
        } catch (\Exception $e) {
            $this->part_categories = [];
        }
    }


    public function applyFilters()
    {
        $this->loadPOList();
    }

    public function loadPOList()
    {
        $query = \App\Models\PurchaseOrder::with('supplier')
            ->where('user_id', Auth::guard('sparepart')->user()->id);

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->whereHas('supplier', function ($supplierQuery) {
                    $supplierQuery->where('business_first_name', 'like', '%' . $this->search . '%');
                })->orWhere('bill_no', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->date_range)) {
            $dates = explode(' to ', str_replace(' - ', ' to ', $this->date_range));
            if (count($dates) === 2) {
                try {
                    $start = \Carbon\Carbon::createFromFormat('d-m-Y', trim($dates[0]))->startOfDay();
                    $end = \Carbon\Carbon::createFromFormat('d-m-Y', trim($dates[1]))->endOfDay();
                    $query->whereBetween('created_at', [$start, $end]);
                } catch (\Exception $e) {
                    // Optional: log error
                }
            }
        }


        $this->po_list = $query->latest()->get();
    }






    // for po management
    // public function loadPOList()
    // {
    //     $this->po_list = PurchaseOrderModel::with('supplier')->orderByDesc('id')->get();
    // }


    public function savePO()
    {
        // Validate that items exist
        if (empty($this->items)) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Please add at least one item to the purchase order!'
            ]);
            return;
        }

        // Validate supplier is selected
        if (!$this->selectedSupplierId) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Please select a supplier!'
            ]);
            return;
        }

        // Validate Transport Details and Transaction Type if status is Placed or Received
        if (in_array($this->po_status, ['Placed', 'Received'])) {
            $this->validate($this->transportRules);
            $this->validate($this->billRules);
        }

        // Fixed prefix - you can dynamically set this if needed
        $prefix = 'PO0725-';

        // Get the last PO that starts with this prefix
        $lastPO = PurchaseOrderModel::where('po_no', 'like', $prefix . '%')
            ->orderByDesc('id')
            ->first();

        if ($lastPO) {
            // Extract and increment the numeric part
            $lastNumber = (int) substr($lastPO->po_no, strlen($prefix));
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        $po_no = $prefix . $nextNumber;

        // Save PO
        $po = PurchaseOrderModel::create([
            'po_no' => $po_no,
            'po_date' => $this->po_date,
            'bill_no' => $this->bill_no,
            'bill_date' => $this->bill_date,
            'po_status' => $this->po_status,
            'supplier_id' => $this->selectedSupplierId,
            'note' => $this->note, // Save the note
            'subtotal' => $this->subtotal,
            'taxable_subtotal' => $this->taxable_subtotal,
            'gst' => $this->gst,
            'total_payable' => $this->total_payable,
            'po_payment' => $this->po_payment,
            'balance' => $this->balance,
            'paid' => $this->paid,
            'transaction_type' => $this->transaction_type,
            'transaction_date' => $this->transaction_date,
            'transaction_no' => $this->transaction_no,
            'transporter_name' => $this->transporter_name,
            'received_date' => $this->received_date,
            'vehicle_number' => $this->vehicle_number,
            'delivery_person' => $this->delivery_person,
            'lt_number' => $this->lt_number,
            'return_amount' => $this->return_amount,
            'previous_balance' => $this->previous_balance,
            'total_balance' => $this->total_balance,
            'user_id' => Auth::guard('sparepart')->user()->id, // <-- Use sparepart guard
        ]);

        // Save PO Items (Stock Details)
        foreach (
            $this->items as $item
        ) {
            // Try to get part/lubricant by id or part_number
            $part = null;
            if (!empty($item['id'])) {
                $part = \App\Models\Part::find($item['id'])
                    ?? \App\Models\Lubricant::find($item['id'])
                    ?? \App\Models\Accessory::find($item['id'])
                    ?? \App\Models\Tools::find($item['id']);
            }
            if (!$part && !empty($item['part_number'])) {
                $part = \App\Models\Part::where('part_number', $item['part_number'])->first()
                    ?? \App\Models\Lubricant::where('part_number', $item['part_number'])->first()
                    ?? \App\Models\Accessory::where('part_number', $item['part_number'])->first()
                    ?? \App\Models\Tools::where('part_number', $item['part_number'])->first();
            }
            \App\Models\PurchaseOrderItem::create([
                'purchase_order_id' => $po->id,
                'part_id' => $part ? $part->id : null,
                'part_name' => $item['name'],
                'part_number' => $item['part_number'] ?? ($part ? $part->part_number : null),
                'brand' => $part ? ($part->brand ?? null) : null,
                'category_id' => $part ? ($part->category_id ?? null) : null,
                'unit_id' => $part ? ($part->unit_id ?? null) : null,
                'rack_no' => $part ? ($part->rack_no ?? null) : null,
                'qty' => $item['qty'],
                'unit_price' => $item['unit_price'] !== '' ? $item['unit_price'] : null,
                'total' => $item['total'] !== '' ? $item['total'] : null,
                'hsn_code' => $item['hsn_code'] ?? '',

                'gst_percent' => floatval($item['gst_percent'] ?? 0),
                'discount' => floatval($item['discount'] ?? 0),
                'discount_type' => $item['discount_type'] ?? 1,
                'selling_price' => $item['selling_price'] !== '' ? $item['selling_price'] : null,

                // GST breakdown
                'taxable_amount' => $item['taxable_amount'] !== '' ? $item['taxable_amount'] : null,
                'cgst' => floatval($item['cgst'] ?? 0),
                'sgst' => floatval($item['sgst'] ?? 0),
                'cgst_percent' => floatval($item['cgst_percent'] ?? 0),
                'sgst_percent' => floatval($item['sgst_percent'] ?? 0),
            ]);
        }

        // Toast message
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Purchase Order Created with ' . count($this->items) . ' items!'
        ]);

        // Reset and reload
        $this->resetPOForm();
        $this->loadPOList();
        $this->mode = 'list';
    }

    public function placeOrder()
    {
        $this->po_status = 'Placed';
        // Validate Transport Details and Transaction Type
        $this->validate($this->transportRules);
        $this->validate($this->billRules);
        $this->autofillTransactionFields();
        $this->updatePO();
    }

    public function editPO($id)
    {
        $po = \App\Models\PurchaseOrder::with('items', 'supplier')->findOrFail($id);
        $this->editingId = $po->id;
        $this->isEdit = true;
        $this->po_no = $po->po_no;
        $this->po_date = $po->po_date;
        $this->bill_no = $po->bill_no;
        $this->bill_date = $po->bill_date;
        $this->po_status = $po->po_status;
        $this->note = $po->note;
        $this->subtotal = $po->subtotal;
        $this->taxable_subtotal = $po->taxable_subtotal;
        $this->gst = $po->gst;
        $this->total_payable = $po->total_payable;
        $this->selectedSupplierId = $po->supplier_id;
        $this->supplier_name = $po->supplier->business_first_name ?? '';
        $this->supplier_phone = $po->supplier->mobile_no ?? '';
        $this->supplier_balance = $po->supplier->balance ?? '';
        $this->transaction_type = $po->transaction_type;
        $this->transaction_date = $po->transaction_date;
        $this->transaction_no = $po->transaction_no;
        $this->transporter_name = $po->transporter_name;
        $this->received_date = $po->received_date;
        $this->vehicle_number = $po->vehicle_number;
        $this->delivery_person = $po->delivery_person;
        $this->lt_number = $po->lt_number;
        $this->return_amount = $po->return_amount;
        $this->previous_balance = $po->previous_balance;
        $this->total_balance = $po->total_balance;
        $this->po_payment = $po->po_payment;
        $this->balance = $po->balance;
        $this->paid = $po->paid;
        $this->items = [];
        foreach ($po->items as $item) {
            $this->items[] = [
                'id' => $item->id,
                'name' => $item->part_name,
                'part_number' => $item->part_number ?? '',
                'brand' => $item->brand ?? '',
                'category_id' => $item->category_id ?? '',
                'unit_id' => $item->unit_id ?? '',
                'rack_no' => $item->rack_no ?? '',
                'qty' => $item->qty,
                'unit_price' => $item->unit_price,
                'total' => $item->total,
                'hsn_code' => $item->hsn_code ?? '',
                'gst_percent' => 0,
                'gst_type' => 'exclude',
                'discount' => 0,
                'discount_type' => isset($item->discount_type) ? $item->discount_type : 1,
                'selling_price' => $item->selling_price ?? '',
                // Add any other fields you use in the table
            ];
        }
        $this->mode = 'create';
    }

    public function updatePO()
    {
        if (!$this->editingId)
            return;
        // Validate Transport Details and Transaction Type if status is Placed or Received
        if (in_array($this->po_status, ['Placed', 'Received'])) {
            $this->validate($this->transportRules);
            $this->validate($this->billRules);
        }
        $po = \App\Models\PurchaseOrder::findOrFail($this->editingId);
        $po->update([
            'po_date' => $this->po_date,
            'bill_no' => $this->bill_no,
            'bill_date' => $this->bill_date,
            'po_status' => $this->po_status,
            'supplier_id' => $this->selectedSupplierId,
            'note' => $this->note,
            'subtotal' => $this->subtotal,
            'taxable_subtotal' => $this->taxable_subtotal,
            'gst' => $this->gst,
            'total_payable' => $this->total_payable,
            'po_payment' => $this->po_payment,
            'balance' => $this->balance,
            'paid' => $this->paid,
            'transaction_type' => $this->transaction_type,
            'transaction_date' => $this->transaction_date,
            'transaction_no' => $this->transaction_no,
            'transporter_name' => $this->transporter_name,
            'received_date' => $this->received_date,
            'vehicle_number' => $this->vehicle_number,
            'delivery_person' => $this->delivery_person,
            'lt_number' => $this->lt_number,
            'return_amount' => $this->return_amount,
            'previous_balance' => $this->previous_balance,
            'total_balance' => $this->total_balance,
        ]);
        // Remove old items and add new
        $po->items()->delete();
        foreach ($this->items as $item) {
            // Try to get part/lubricant by id or part_number
            $part = null;
            if (!empty($item['id'])) {
                $part = \App\Models\Part::find($item['id'])
                    ?? \App\Models\Lubricant::find($item['id'])
                    ?? \App\Models\Accessory::find($item['id'])
                    ?? \App\Models\Tools::find($item['id']);
            }
            if (!$part && !empty($item['part_number'])) {
                $part = \App\Models\Part::where('part_number', $item['part_number'])->first()
                    ?? \App\Models\Lubricant::where('part_number', $item['part_number'])->first()
                    ?? \App\Models\Accessory::where('part_number', $item['part_number'])->first()
                    ?? \App\Models\Tools::where('part_number', $item['part_number'])->first();
            }
            \App\Models\PurchaseOrderItem::create([
                'purchase_order_id' => $po->id,
                'part_id' => $part ? $part->id : null,
                'part_name' => $item['name'],
                'part_number' => $item['part_number'] ?? ($part ? $part->part_number : null),
                'brand' => $part ? ($part->brand ?? null) : null,
                'category_id' => $part ? ($part->category_id ?? null) : null,
                'unit_id' => $part ? ($part->unit_id ?? null) : null,
                'rack_no' => $part ? ($part->rack_no ?? null) : null,
                'qty' => $item['qty'],
                'unit_price' => $item['unit_price'],
                'total' => $item['total'],
                // New fields
                'hsn_code' => $item['hsn_code'] ?? '',
                'gst_percent' => floatval($item['gst_percent'] ?? 0),
                'discount' => floatval($item['discount'] ?? 0),
                'discount_type' => $item['discount_type'] ?? 1,
                'selling_price' => $item['selling_price'] ?? '',
                // GST breakdown
                'taxable_amount' => floatval($item['taxable_amount'] ?? 0),
                'cgst' => floatval($item['cgst'] ?? 0),
                'sgst' => floatval($item['sgst'] ?? 0),
                'cgst_percent' => floatval($item['cgst_percent'] ?? 0),
                'sgst_percent' => floatval($item['sgst_percent'] ?? 0),
            ]);
        }
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Purchase Order Updated!'
        ]);
        $this->resetPOForm();
        $this->isEdit = false;
        $this->editingId = null;
        $this->loadPOList();
        $this->calculateSummary();
        $this->mode = 'list';
    }

    public function markReceived()
    {
        $this->po_status = 'Received';
        // Validate Transport Details and Transaction Type
        $this->validate($this->transportRules);
        $this->validate($this->billRules);
        $this->autofillTransactionFields();
        $this->updatePO();
    }

    public function addToStock()
    {
        $po = \App\Models\PurchaseOrder::find($this->editingId);
        if (!$po) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Purchase Order not found!'
            ]);
            return;
        }

        foreach ($this->items as $item) {
            // $categoryId = isset($item['category_id']) ? (int)$item['category_id'] : null;
            // $categoryName = $categoryId ? (\App\Models\SparePartCategory::find($categoryId)->categoryName ?? '') : '';
            $test = \App\Models\SparePartProductStock::create([
                'partname' => $item['name'],
                'part_no' => $item['part_number'] ?? '',
                'company_name' => $item['brand'] ?? '',
                'category' => $item['category_id'] ?? '',
                // 'category' => $item['category_id']? \App\Models\Category::find($item['category_id'])->title ?? '': '',
                // 'category' => $item['category_id'] ? (\App\Models\SparePartCategory::find($item['category_id'])->title ?? '') : '',
                // 'category' => $categoryName,
                'quantity' => $item['qty'],
                'unit' => $item['unit_id'] ?? '',
                // 'unit' => $item['unit_id'] ? (\App\Models\Unit::find($item['unit_id'])->title ?? '') : '',
                'rack_no' => $item['rack_no'] ?? '',
                'total_payable' => $this->total_payable,
                'purchase_order_id' => $po->id,
                'user_id' => Auth::guard('sparepart')->user()->id,
            ]);

            // NEW: Update part stock in parts table
            if (!empty($item['part_number'])) {
                $part = \App\Models\Part::where('part_number', $item['part_number'])->first();
                if ($part) {
                    $part->stock = $part->stock + $item['qty'];
                    $part->save();
                }
            }
        }
        // Set status to Closed and update in DB

        $po->po_status = 'Closed';
        $po->save();
        $this->po_status = 'Closed';
        // dd($test);
        // dd($part);
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Stock added successfully!'
        ]);

    }


    public function resetPOForm()
    {
        $this->reset([
            'po_no',
            'po_date',
            'bill_no',
            'bill_date',
            'po_status',
            'selectedSupplierId',
            'supplier_name',
            'supplier_phone',
            'supplier_balance',
            'items',
            'part_search',
            'partResults',
            'showPartNumber',
            'note',
            'subtotal',
            'taxable_subtotal',
            'gst',
            'total_payable',
        ]);
        $this->po_date = date('Y-m-d');
        $this->bill_date = date('Y-m-d');
        $this->po_status = 'Open';


    }

    public function goToList()
    {
        $this->resetPOForm();
        $this->isEdit = false;
        $this->editingId = null;
        $this->mode = 'list';
    }

    public function goToCreate()
    {
        $this->resetPOForm();
        $this->isEdit = false;
        $this->editingId = null;
        $this->mode = 'create';
    }
    public function setStatus($status)
    {
        $this->po_status = $status;
        if ($status === 'Open') {
            $this->bill_no = 0;
        }
        if (in_array($status, ['Placed', 'Received'])) {
            $this->autofillTransactionFields();
        }
        $this->calculateBillDetails();
    }

    public function focusSupplierSearch()
    {
        $this->supplierResults = SparePartSupplier::orderBy('business_first_name')->limit(50)->get()->toArray();
    }

    public function focusPartSearch()
    {
        $lubricants = \App\Models\Lubricant::withTrashed()->orderBy('name')->limit(10)->get();
        $parts = \App\Models\Part::withTrashed()->orderBy('name')->limit(10)->get();
        $accessories = \App\Models\Accessory::withTrashed()->orderBy('name')->limit(10)->get();
        $tools = \App\Models\Tools::withTrashed()->orderBy('name')->limit(10)->get();
        $this->partResults = $lubricants->merge($parts)->merge($accessories)->merge($tools)->take(20)->values();
    }

    // Supplier Management
    public function updatedSupplierSearch($value)
    {
        $value = trim($value);
        if ($value !== '') {
            $this->supplierResults = SparePartSupplier::where('business_first_name', 'like', "%$value%")
                ->orWhere('mobile_no', 'like', "%$value%")
                ->orderBy('business_first_name')
                ->limit(50)
                ->get()
                ->toArray();
        } else {
            $this->supplierResults = SparePartSupplier::orderBy('business_first_name')->limit(50)->get()->toArray();
        }
        $this->supplier_name = '';
        $this->supplier_phone = '';
        $this->supplier_balance = '';
        $this->selectedSupplierId = null;
    }

    public function selectSupplier($id)
    {
        $supplier = SparePartSupplier::find($id);
        if ($supplier) {
            $this->supplier_name = $supplier->business_first_name;
            $this->supplier_phone = $supplier->mobile_no;
            $this->supplier_balance = $supplier->balance ?? 0;
            $this->selectedSupplierId = $id;
            $this->supplierResults = [];
            $this->supplierSearch = $supplier->business_first_name;
        }
    }

    public function openSupplierModal()
    {
        $this->resetSupplierFields();
        $this->isSupplierEdit = false;
        $this->showSupplierModal = true;
    }

    public function closeSupplierModal()
    {
        $this->showSupplierModal = false;
    }

    public function resetSupplierFields()
    {
        $this->mobile_no = $this->business_first_name = $this->business_address = $this->gstin = null;
        $this->owner_first_name = $this->contact_1 = $this->contact_2 = $this->email = null;
        $this->supplier_id = null;
    }

    public function storeSupplier()
    {
        $this->validate($this->supplierRules);
        $supplier =
            \App\Models\SparePartSupplier::create([
                'mobile_no' => $this->mobile_no,
                'business_first_name' => $this->business_first_name,
                'business_address' => $this->business_address,
                'gstin' => $this->gstin,
                'owner_first_name' => $this->owner_first_name,
                'contact_1' => $this->contact_1,
                'contact_2' => $this->contact_2,
                'email' => $this->email,
                'user_id' => $this->sparepartId,
            ]);
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Supplier added successfully!'
        ]);
        // Set the new supplier as selected
        $this->selectSupplier($supplier->id);
        $this->closeSupplierModal();
    }

    public function editSupplier()
    {
        if ($this->selectedSupplierId) {
            $supplier = \App\Models\SparePartSupplier::find($this->selectedSupplierId);
            if ($supplier) {
                $this->supplier_id = $supplier->id;
                $this->mobile_no = $supplier->mobile_no;
                $this->business_first_name = $supplier->business_first_name;
                $this->business_address = $supplier->business_address;
                $this->gstin = $supplier->gstin;
                $this->owner_first_name = $supplier->owner_first_name;
                $this->contact_1 = $supplier->contact_1;
                $this->contact_2 = $supplier->contact_2;
                $this->email = $supplier->email;
                $this->isSupplierEdit = true;
                $this->showSupplierModal = true;
            }
        }
    }

    public function updateSupplier()
    {
        $this->validate($this->supplierRules);
        $supplier = \App\Models\SparePartSupplier::findOrFail($this->supplier_id);
        $supplier->update([
            'mobile_no' => $this->mobile_no,
            'business_first_name' => $this->business_first_name,
            'business_address' => $this->business_address,
            'gstin' => $this->gstin,
            'owner_first_name' => $this->owner_first_name,
            'contact_1' => $this->contact_1,
            'contact_2' => $this->contact_2,
            'email' => $this->email,
        ]);
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Supplier updated successfully!'
        ]);
        // Update the selected supplier details
        $this->selectSupplier($supplier->id);
        $this->closeSupplierModal();
    }

    //  Part & Lubricant Search & Selection
    public function updatedPartSearch($value)
    {
        $value = trim($value);
        if (strlen($value) > 1) {
            $lubricants = \App\Models\Lubricant::withTrashed()
                ->where(function ($query) use ($value) {
                    $query->Where('part_number', 'like', "%$value%");
                    $query->orWhere('name', 'like', "%$value%");

                })
                ->limit(5)
                ->get();

            $parts = \App\Models\Part::withTrashed()
                ->where(function ($query) use ($value) {
                    $query->where('part_number', 'like', "%$value%");
                    $query->orWhere('name', 'like', "%$value%");
                })
                ->limit(5)
                ->get();

            $accessories = \App\Models\Accessory::withTrashed()
                ->where(function ($query) use ($value) {
                    $query->where('part_number', 'like', "%$value%");
                    $query->orWhere('name', 'like', "%$value%");
                })
                ->limit(5)
                ->get();

            $tools = \App\Models\Tools::withTrashed()
                ->where(function ($query) use ($value) {
                    $query->where('part_number', 'like', "%$value%");
                    $query->orWhere('name', 'like', "%$value%");
                })
                ->limit(5)
                ->get();

            $this->partResults = $lubricants->merge($parts)->merge($accessories)->merge($tools)->take(5)->values();
        } else {
            $this->partResults = [];
        }
    }

    public function toggleShowPartNumber()
    {
        $this->showPartNumber = !$this->showPartNumber;
    }

    public function selectPart($id)
    {
        if (!$id)
            return;

        $part = \App\Models\Part::withTrashed()->find($id)
            ?? \App\Models\Lubricant::withTrashed()->find($id)
            ?? \App\Models\Accessory::withTrashed()->find($id)
            ?? \App\Models\Tools::withTrashed()->find($id);
        if (!$part)
            return;

        // Check if item already exists in the table
        foreach ($this->items as $item) {
            if ($item['id'] == $part->id) {
                // Item already exists, skip adding
                return;
            }
        }

        // Default values
        $qty = 1;
        $unit_price = $part->purchase_price ?? $part->price ?? 0;
        $total = $qty * $unit_price;

        $item = [
            'id' => $part->id,
            'name' => $part->name,
            'part_number' => $part->part_number ?? '',
            'qty' => $qty,
            'unit_price' => $unit_price,
            'total' => $total,
            'hsn_code' => $part->hsn_code ?? '',
            'gst_percent' => 0,
            'gst_type' => 'exclude',
            'discount' => 0,
            'discount_type' => $part->discount_type ?? 1,
            'selling_price' => $part->selling_amount ?? '',
            'brand' => $part->brand ?? '',
            'category_id' => $part->category_id ?? '',
            'unit_id' => $part->unit_id ?? '',
            'rack_no' => $part->rack_no ?? '',
            // Add any other fields you use in the table
        ];

        $this->items[] = $item;

        // Clear the selected value to reset dropdown
        $this->selected_part_id = '';
        $this->part_search = '';
        $this->partResults = [];
        $this->calculateBillDetails();
    }

    public function updateItemHSN($index, $value)
    {
        if (isset($this->items[$index])) {
            $this->items[$index]['hsn_code'] = $value;
        }
    }
    public function updateItemGST($index, $value)
    {
        if (isset($this->items[$index])) {
            $this->items[$index]['gst_percent'] = $value;
            $this->calculateBillDetails();
        }
    }
    public function updateItemDiscount($index, $value)
    {
        if (isset($this->items[$index])) {
            $this->items[$index]['discount'] = $value;
            $this->calculateBillDetails();
        }
    }
    public function updateItemDiscountType($index, $value)
    {
        if (isset($this->items[$index])) {
            $this->items[$index]['discount_type'] = $value;
            $this->calculateBillDetails();
        }
    }
    public function updateItemSellingPrice($index, $value)
    {
        if (isset($this->items[$index])) {
            $this->items[$index]['selling_price'] = $value;
            $this->calculateBillDetails();
        }
    }

    public function updateItemGstType($index, $value)
    {
        if (isset($this->items[$index])) {
            $this->items[$index]['gst_type'] = $value;
            $this->calculateBillDetails();
        }
    }

    public function updateItemPurchasePrice($index, $value)
    {
        if (isset($this->items[$index])) {
            $this->items[$index]['purchase_price'] = $value;
            $this->calculateBillDetails();
        }
    }

    public function removeItem($index)
    {
        if (isset($this->items[$index])) {
            unset($this->items[$index]);
            $this->items = array_values($this->items); // Reindex array
            $this->calculateBillDetails();
        }
    }

    public function updateItemQty($index, $qty)
    {
        if (isset($this->items[$index])) {
            $qty = (float) $qty;
            $unitprice = (float) ($this->items[$index]['unit_price'] ?? 0);

            $this->items[$index]['qty'] = $qty;
            // $this->items[$index]['total'] = $qty * $this->items[$index]['unit_price'];
            $this->items[$index]['total'] = $qty * $unitprice;
            $this->calculateBillDetails();
        }
    }

    public function updateItemPrice($index, $price)
    {
        if (isset($this->items[$index])) {

            $qty = (float) ($this->items[$index]['qty'] ?? 1);
            $price = (float) $price;


            $this->items[$index]['unit_price'] = $price;
            // $this->items[$index]['total'] = $this->items[$index]['qty'] * $price;
            $this->items[$index]['total'] = $qty * $price;
            $this->calculateBillDetails();
        }
    }

    // --- PART MODAL LOGIC ---
    public function openPartModal()
    {
        $this->resetPartForm();
        $this->showPartModal = true;
        $this->part_isEdit = false;
        $this->part_type = 'part';
    }
    public function closePartModal()
    {
        $this->showPartModal = false;
        $this->resetPartForm();
        $this->part_type = 'part';
    }

    public function updatedPartPartNumber($value)
    {
        if (empty($value)) {
            $this->part_part_image_url = null;
            $this->part_api_compatible_vehicles = [];
            return;
        }

        $cleanValue = preg_replace('/[^A-Za-z0-9]/', '', $value);
        $found = false;
        $article = null;

        // Step 1: Try Original Search
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
            'X-RapidAPI-Key' => config('services.rapidapi.key'),
        ])->get('https://auto-parts-catalog.p.rapidapi.com/articles/article-number-details/lang-id/4/country-filter-id/62/article-no/' . $value);

        if ($response->successful() && !empty($response['articles'])) {
            $article = $response['articles'][0];
            $found = true;
        }

        // Step 2: Fallback to Cross-Number Search (ArticleNumber)
        if (!$found) {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
                'X-RapidAPI-Key' => config('services.rapidapi.key'),
            ])->get('https://auto-parts-catalog.p.rapidapi.com/artlookup/search-for-cross-numbers/lang-id/4/article-type/ArticleNumber/article-no/' . $cleanValue);

            if ($response->successful() && !empty($response['articles'])) {
                $article = $response['articles'][0];
                // Map fields to match expectations
                $article['articleProductName'] = $article['articleProductName'] ?? null;
                $article['supplierName'] = $article['supplierName'] ?? null;
                $article['s3ImageLink'] = $article['s3image'] ?? null;
                $found = true;
            }
        }

        // Step 3: Fallback to Cross-Number Search (OENumber)
        if (!$found) {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
                'X-RapidAPI-Key' => config('services.rapidapi.key'),
            ])->get('https://auto-parts-catalog.p.rapidapi.com/artlookup/search-for-cross-numbers/lang-id/4/article-type/OENumber/article-no/' . $cleanValue);

            if ($response->successful() && !empty($response['articles'])) {
                $article = $response['articles'][0];
                $article['articleProductName'] = $article['articleProductName'] ?? null;
                $article['supplierName'] = $article['supplierName'] ?? null;
                $article['s3ImageLink'] = $article['s3image'] ?? null;
                $found = true;
            }
        }

        if ($found) {
            $this->part_name = $article['articleProductName'] ?? null;
            $this->part_brand = $article['supplierName'] ?? null;
            $this->part_part_image_url = $article['s3ImageLink'] ?? null;
            
            $descriptionParts = [];
            if (!empty($article['allSpecifications'])) {
                foreach ($article['allSpecifications'] as $spec) {
                    $descriptionParts[] = $spec['criteriaName'] . ': ' . ($spec['criteriaValue'] ?? 'N/A');
                }
            }
            $this->part_description = implode(', ', $descriptionParts);
            
            $compatibleCars = [];
            if (!empty($article['compatibleCars'])) {
                foreach ($article['compatibleCars'] as $car) {
                    $compatibleCars[] = [
                        'vehicleId' => $car['vehicleId'] ?? null,
                        'manufacturerName' => $car['manufacturerName'] ?? '',
                        'modelName' => $car['modelName'] ?? '',
                        'typeEngineName' => $car['typeEngineName'] ?? '',
                        'fuelType' => $car['fuelType'] ?? '',
                        'year' => (
                            (!empty($car['constructionIntervalStart']) ? substr($car['constructionIntervalStart'], 0, 4) : '') .
                            (
                                (!empty($car['constructionIntervalEnd']) && substr($car['constructionIntervalEnd'], 0, 4) !== substr($car['constructionIntervalStart'], 0, 4))
                                ? ' - ' . substr($car['constructionIntervalEnd'], 0, 4)
                                : ''
                            )
                        ),
                    ];
                }
            }
            $this->part_api_compatible_vehicles = $compatibleCars;
            $this->part_suitable_for = collect($compatibleCars)->pluck('vehicleId')->toArray();
            $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Part details fetched successfully!']);
        } else {
            $this->part_part_image_url = null;
            $this->part_api_compatible_vehicles = [];
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Could not find details for this part number.']);
        }
    }


    // price and customer price
    private function calculatePartPrice()
    {
        $price = 0;
        $sellingAmount = floatval($this->part_selling_amount);
        $taxPercentage = floatval($this->part_tax_percentage);
        $discount = floatval($this->part_discount);
        $commission = floatval($this->part_commission);

        if ($this->part_tax_type == 'include' && $taxPercentage) {
            $includedPrice = $sellingAmount / ($taxPercentage / 100 + 1);
            $price = round($includedPrice, 2);
        } elseif ($this->part_tax_type == 'exclude' && $taxPercentage) {
            $tax = ($sellingAmount * $taxPercentage) / 100;
            $price = $sellingAmount + $tax;
        } else {
            $price = $sellingAmount;
        }

        if ($this->part_discount_type == 1) {
            $price -= $discount;
        } elseif ($this->part_discount_type == 2) {
            $discountAmount = ($price * $discount) / 100;
            $price -= $discountAmount;
        }

        $this->part_reflectedPrice = $this->part_price = $price;
        $totalCommission = ($price * $commission) / 100;
        $this->part_customerPrice = $price + $totalCommission;
    }
    public function storePart()
    {
        $this->calculatePartPrice();

        // Cast numeric fields to proper types before validation
        $this->part_purchase_amount = (float) $this->part_purchase_amount;
        $this->part_selling_amount = (float) $this->part_selling_amount;
        $this->part_unit = (int) $this->part_unit;
        $this->part_stock = (int) $this->part_stock;
        $this->part_discount = (float) $this->part_discount;
        $this->part_category = (int) $this->part_categories;
        $this->part_sp_type = (string) $this->part_sp_type;

        $this->validate($this->partRules);

        // Decide which model to use
        $model = null;
        if ($this->part_type === 'part') {
            $model = \App\Models\Part::class;
        } elseif ($this->part_type === 'lubricant') {
            $model = \App\Models\Lubricant::class;
        } elseif ($this->part_type === 'accessory') {
            $model = \App\Models\Accessory::class;
        } elseif ($this->part_type === 'tools') {
            $model = \App\Models\Tools::class;
        }

        // Check if part/lubricant/accessory already exists by part_number
        // $existing = $model::where('part_number', $this->part_part_number)->first();

        // if ($existing) {
        //     // If exists, increase stock
        //     $existing->stock = $existing->stock + (int)$this->part_stock;
        //     $existing->save();
        //     $partId = $existing->id;
        //     $partObj = $existing;
        // } else {
        // If not exists, create new
        // Set spare_part_type based on part_type
        $sparePartType = 2; // default part
        if ($this->part_type === 'accessory') {
            $sparePartType = 1;
        } elseif ($this->part_type === 'lubricant') {
            $sparePartType = 4;
        } elseif ($this->part_type === 'tools') {
            $sparePartType = 3;
        }

        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $this->part_name],
            ['title' => $this->part_name, 'spare_part_type' => 1]
        );





        // Prepare suitable_for string (convert IDs to names and process API vehicles)
        $suitableForString = '';
        if ($this->part_forAllVehicles) {
            $suitableForString = 'All Vehicles';
            // Optionally retrieve all active modifications:
            $selectedVehicleIds = \App\Models\Modification::where('status', 1)->pluck('id')->toArray();
        } elseif (!empty($this->part_suitable_for) && is_array($this->part_suitable_for)) {
            $vehicleNames = [];
            foreach ($this->part_suitable_for as $vehicleId) {
                $apiVehicle = collect($this->part_api_compatible_vehicles)->firstWhere('vehicleId', $vehicleId);
                if ($apiVehicle) {
                    // API vehicle found – create or get corresponding Modification
                    $modification = \App\Models\Modification::firstOrCreate(
                        [
                            'title' => $apiVehicle['manufacturerName'] . ' ' . $apiVehicle['modelName'],
                            'brand_name' => $apiVehicle['manufacturerName'],
                            'variant_name' => $apiVehicle['modelName'],
                            'year' => $apiVehicle['year'] ?? date('Y'),
                        ],
                        [
                            'brand_id' => 1, // default brand
                            'variant_id' => 1, // default variant
                            'status' => 1,
                        ]
                    );
                    $vehicleNames[] = trim(
                        $apiVehicle['manufacturerName'] . ' ' .
                        $apiVehicle['modelName'] . ' ' .
                        ($apiVehicle['year'] ?? '')
                    );
                } else {
                    // Fall back to existing Modification
                    $mod = \App\Models\Modification::find($vehicleId);
                    if ($mod) {
                        $vehicleNames[] = trim($mod->brand_name . ' ' . $mod->variant_name . ' ' . $mod->year);
                    } else {
                        $vehicleNames[] = $vehicleId;
                    }
                }
            }
            $suitableForString = implode(', ', $vehicleNames);
        } elseif (!empty($this->part_suitable_for)) {
            $suitableForString = is_string($this->part_suitable_for)
                ? $this->part_suitable_for
                : '';
        }



        // Handle API image if present and no manual image uploaded
        if (empty($this->image) && !empty($this->part_part_image_url)) {
            $imageContents = @file_get_contents($this->part_part_image_url);
            if ($imageContents !== false) {
                $imageName = 'uploads/' . uniqid('api_img_') . '.' . pathinfo(parse_url($this->part_part_image_url, PHP_URL_PATH), PATHINFO_EXTENSION);
                $fullPath = public_path($imageName);
                file_put_contents($fullPath, $imageContents);
                $upload = UploadImage::create(["file" => $imageName]);
                $this->part_image_id = $upload->id;
            }
        }

        if (!empty($this->image)) {
            $this->part_image_id = $this->image->id;
        }
        //dd($this->part_tax_percentage);
        $partObj = $model::create([
            'name' => $this->part_name,
            'brand' => $this->part_brand ?? '',
            'price' => $this->part_customerPrice ?? 0,
            'amount' => $this->part_price ?? 0,
            'unit_id' => $this->part_unit,
            'suitable_for' => $suitableForString,
            'hsn_code' => $this->part_hsn_code ?? '',
            'rack_no' => $this->part_rack_no ?? '',
            'discount' => $this->part_discount ?? 0,
            'stock' => $this->part_stock,
            'description' => $this->part_description ?? '',
            'image' => $this->part_image_id,
            'part_number' => $this->part_part_number,
            'sp_type' => $this->part_sp_type,
            'purchase_price' => $this->part_purchase_amount,
            'tax_type' => $this->part_tax_type,
            'tax_percentage' => $this->part_tax_percentage ?? 0,

            'category_id' => $this->part_category,
            'selling_amount' => $this->part_selling_amount,
            'discount_type' => $this->part_discount_type,
            'user_id' => $this->sparepartId,
            'spare_part_type' => $sparePartType,
            'label_id' => $sparePartLabel->id,
        ]);
        //dd($partObj->toArray());
        $partId = $partObj->id;
        // }

        // Add to PO items array (auto-fill bill details)
        $item = [
            'id' => $partId,
            'name' => $partObj->name,
            'part_number' => $partObj->part_number ?? '',
            'qty' => 1,
            'unit_price' => $partObj->purchase_price ?? $partObj->price ?? 0,
            'total' => $partObj->purchase_price ?? $partObj->price ?? 0,
            'hsn_code' => $partObj->hsn_code ?? '',
            'gst_percent' => 0,
            'gst_type' => 'exclude',
            'discount' => 0,
            'discount_type' => $partObj->discount_type ?? 1,
            'selling_price' => $partObj->selling_amount ?? '',
            'brand' => $partObj->brand ?? '',
            'category_id' => $partObj->category_id ?? '',
            'unit_id' => $partObj->unit_id ?? '',
            'rack_no' => $partObj->rack_no ?? '',
            'type' => $this->part_type, // for reference
        ];
        $this->items[] = $item;
        $this->calculateBillDetails();
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Item added successfully!']);
        $this->closePartModal();
        $this->resetPartForm();
    }

    public function updatedPoPayment($value)
    {
        $this->paid = floatval($value);
        $this->balance = floatval($this->total_payable) - floatval($value);
    }

    public function render()
    {
        $query = \App\Models\PurchaseOrder::with('supplier')
            ->where('user_id', Auth::guard('sparepart')->user()->id);

        if ($this->search) {
            $query->where(function ($q) {
                $q->whereHas('supplier', function ($supplierQuery) {
                    $supplierQuery->where('business_first_name', 'like', '%' . $this->search . '%');
                })->orWhere('bill_no', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->date_range) {
            $dates = explode(' - ', $this->date_range);
            if (count($dates) === 2) {
                $start = \Carbon\Carbon::parse($dates[0])->startOfDay();
                $end = \Carbon\Carbon::parse($dates[1])->endOfDay();
                $query->whereBetween('po_date', [$start, $end]);
            }
        }

        $po_list = $query->latest()->get();

        $this->calculateSummary(clone $query);

        if ($this->mode === 'create') {
            return view('livewire.sparepart.inventory.purchase-order-create');
        }

        // return view('livewire.sparepart.inventory.purchase-order', [
        //     'po_list' => $po_list,
        // ]);
        $modifications = Modification::query()
            ->when($this->brandFilter, function ($query) {
                $query->where('brand_name', 'like', '%' . $this->brandFilter . '%');
            })
            ->get();

        // ---------- Return View ----------
        return view('livewire.sparepart.inventory.purchase-order', [
            'po_list' => $po_list,
            'modifications' => $modifications,
        ]);
    }



    //gst calulation
//     public function calculateBillDetails()
// {
//         // Normalize items: ensure all keys exist
//         foreach ($this->items as $i => $item) {
//             if (!isset($this->items[$i]['discount'])) $this->items[$i]['discount'] = 0;
//             if (!isset($this->items[$i]['gst_percent'])) $this->items[$i]['gst_percent'] = 0;
//             if (!isset($this->items[$i]['discount_type'])) $this->items[$i]['discount_type'] = 1;
//             if (!isset($this->items[$i]['gst_type'])) $this->items[$i]['gst_type'] = 'exclude';
//         }
//         $subtotal = 0;
//          //gst calulation
//         $totalGst = 0;
//         $discountTotal = 0;

    //         foreach ($this->items as &$item) { // Use reference to update total
//             $rowTotalBeforeDiscount = $item['qty'] * $item['unit_price'];

    //             // Calculate discount
//             $discount = 0;
//             if (!empty($item['discount'])) {
//                 if (isset($item['discount_type']) && $item['discount_type'] == 2) { // Percentage
//                     $discount = ($rowTotalBeforeDiscount * $item['discount']) / 100;
//                 } else { // Fixed amount
//                     $discount = $item['discount'];
//                 }
//             }
//             $discountTotal += $discount;

    //             $priceAfterDiscount = $rowTotalBeforeDiscount - $discount;

    //             // Calculate GST
//             $rowGST = 0;
//             $taxableAmount = $priceAfterDiscount;

    //             if (!empty($item['gst_percent'])) {
//                 if ($item['gst_type'] === 'include') {
//                     // GST is included in the price
//                     $taxableAmount = $priceAfterDiscount / (1 + ($item['gst_percent'] / 100));
//                     $rowGST = $priceAfterDiscount - $taxableAmount;
//                     $item['total'] = $priceAfterDiscount; // Total remains the same
//                 } else { // 'exclude'
//                     // GST is excluded, add it on top
//                     $rowGST = ($taxableAmount * $item['gst_percent']) / 100;
//                     $item['total'] = $priceAfterDiscount + $rowGST;
//                 }
//             } else {
//                 $item['total'] = $priceAfterDiscount;
//             }

    //             $totalGst += $rowGST;
//             $subtotal += $taxableAmount; // Subtotal should be the sum of taxable amounts
//         }
//         unset($item); // Unset reference
//         $this->subtotal = $subtotal;
//         $this->gst = $totalGst;
//         $this->total_payable = $subtotal + $totalGst;
//         $this->taxable_subtotal = $subtotal;
//         // Update balance and paid in real time
//         $this->balance = floatval($this->total_payable) - floatval($this->po_payment);
//         $this->paid = floatval($this->po_payment);
// }


    public function calculateBillDetails()
    {
        $subtotal = 0;

        foreach ($this->items as &$item) {
            $item['total'] = $item['qty'] * $item['unit_price'];
            $item['cgst'] = 0;
            $item['sgst'] = 0;
            $item['cgst_percent'] = 0;
            $item['sgst_percent'] = 0;
            $item['taxable_amount'] = $item['total'];
            $item['discount'] = 0;
            $subtotal += $item['total'];
        }
        unset($item);

        $this->subtotal = round($subtotal, 2);
        $this->gst = 0;
        $this->total_payable = round($subtotal, 2);
        $this->taxable_subtotal = $subtotal;

        $this->balance = floatval($this->total_payable) - floatval($this->po_payment);
        $this->paid = floatval($this->po_payment);
    }



    public function show($id)
    {
        $order = PurchaseOrderModel::with(['supplier', 'items'])->findOrFail($id);
        // dd($order);
        return view('livewire.sparepart.inventory.pdf', compact('order'));
    }





    public function resetPartForm()
    {
        $this->part_name = '';
        $this->part_brand = '';
        $this->part_unit = null;
        $this->part_stock = '';
        $this->part_description = '';
        $this->part_image_id = null;
        $this->part_imagePreview = null;
        $this->part_imageName = '';
        $this->part_part_number = '';
        $this->part_sp_type = '';
        $this->part_purchase_amount = '';
        $this->part_selling_amount = '';
        $this->part_discount = '';
        $this->part_discount_type = 1;
        $this->part_tax_type = '';
        $this->part_tax_percentage = '';
        $this->part_hsn_code = '';
        $this->part_rack_no = '';
        $this->part_category = '';
        $this->part_suitable_for = [];
        $this->part_forAllVehicles = false;
        $this->part_api_compatible_vehicles = [];
        $this->part_part_image_url = null;
        $this->part_price = 0;
        $this->part_customerPrice = 0;
        $this->part_reflectedPrice = 0;
        $this->partId = null;
    }

    /**
     * Central autofill for transaction_date and transaction_no
     */
    private function autofillTransactionFields()
    {
        if (empty($this->transaction_date)) {
            $this->transaction_date = date('Y-m-d');
        }
        if (empty($this->transaction_no)) {
            $lastTxn = \App\Models\PurchaseOrder::whereNotNull('transaction_no')->orderByDesc('id')->first();
            if ($lastTxn && preg_match('/TXN(\\d+)/', $lastTxn->transaction_no, $m)) {
                $nextNo = str_pad(((int) $m[1]) + 1, 4, '0', STR_PAD_LEFT);
                $this->transaction_no = 'TXN' . $nextNo;
            } else {
                $this->transaction_no = 'TXN0001';
            }
        }
    }





    public function calculateSummary()
    {
        $this->totalOrders = \App\Models\PurchaseOrder::where('user_id', Auth::guard('sparepart')->user()->id)->count();
        $this->totalPaid = \App\Models\PurchaseOrder::where('user_id', Auth::guard('sparepart')->user()->id)->sum('paid');
        $this->totalPending = \App\Models\PurchaseOrder::where('user_id', Auth::guard('sparepart')->user()->id)->sum('balance');
    }



    public function updatedSearch()
    {
        $this->loadPOList();
    }

    public function updatedDateRange()
    {
        $this->loadPOList();
    }

    public function cancelOrder()
    {
        $this->po_status = 'Cancelled';
        if ($this->isEdit && $this->editingId) {
            $po = \App\Models\PurchaseOrder::find($this->editingId);
            if ($po) {
                $po->po_status = 'Cancelled';
                $po->save();
            }
        }
        // Optionally, show a toast
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Order Cancelled!'
        ]);
        // Optionally, update UI or redirect
        // $this->mode = 'list';
    }
}
