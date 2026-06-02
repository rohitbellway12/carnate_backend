<?php

namespace App\Livewire\Sparepart;

use Livewire\WithFileUploads;
use App\Models\{WorkShopVendor, Branch, CounterCustomers, CounterSale, CounterSaleSparePart, SparePart, SparePartLabel, SparePartVendor};

use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Support\Str;
use App\Services\SharedSerialService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]

class CounterSaleAddController extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';


    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $gender, $birth_date, $display_name, $branches;
    public $staffId, $workshopId, $jobId, $vehicles, $km_reading, $fual_level, $imagePath, $dentImageId, $mechanic, $sparePartLabel, $isAddvehicle, $unit_price, $sms_alert, $pdftype, $viewtype, $items_purchase, $showstock, $isOpen, $vehicle_brand_id_data, $vehicle_type_id_data, $vehicle_type_id, $vehicledatacollection, $extra_charges, $spare_parts_data, $search_customer_voice, $search_accessory, $search_work_notes, $item, $search_vehicle, $selectedVehicleName, $transaction_number, $countersalenumber, $note, $gst_no;

    public $customerVoiceCount = "0";
    public $mechanic_id = "0";
    public $part_name = "0";
    public $hidden_balance_amount = "0";
    public $photosCount = "0";
    public $itemNames = [];
    public $accessariesCount = "0";
    public $workNoteCount = "0";
    public $property_photos = [];
    public $carImages = [];

    public $vehical_types = [];
    public $fuel_types = [];
    public $vehical_models = [];
    public $vehical_brands = [];
    public $final_discount = 0;
    public $final_paid = 0;
    public $total_amount = 0;
    public $total_discount = 0;
    public $final_amount = 0;
    public $advance = 0;
    public $supervisor = 0;
    public $balance_amount = 0;
    public $states = [];
    public $cities = [];
    public $customers, $supervisors, $country, $vehical_type, $vehical_brand, $fuel_type, $color, $model_name, $lubes_data, $lubes_data_price, $accessory_data, $accessory_data_price;
    public $showCustomerVoice, $addCustomerVoice, $confirmpassword, $add, $smsAlert, $showPhoto, $addphoto, $accessories, $showAccessoriesVoice, $addAccessoriesVoice, $addWorkNote, $showWorkNote, $images, $addVehicals, $isAddvehicl, $customer_name, $vehiclesName, $orderId;
    public $customerVoices = [];

    public $employee = [];
    public $label = [];
    public $charge = [];
    public $accessoriesVoices = [];
    public $workVoices = [];
    public $isAdd = false;
    public $showDentCar = false;
    public $customerVoicesData = [];
    public $adds = false;

    public $isVehical, $showVehical, $isBrand, $showBrand, $isModel, $showModel, $isFuel, $showFuel, $vehicleDetails, $spare_parts_price, $driver_name, $driver_number, $policy_number, $insurance_name, $gstin_number, $policy_expiry_date, $pickup_address, $drop_address;
    public $vehicle_id, $vehicleBrand, $modelName, $fuel_id, $odometerReading, $numberPlate, $chassisNo, $modelYear, $noOfGear, $user;
    public $dateOfManufacturing, $gearbox, $gearboxNo, $engineN, $engineSize, $engine, $keyNo, $engineNo, $isPurchase, $showPurchase, $isPrint, $showPrint, $type, $showDownload, $accessory, $spare, $tool, $labourCharges, $lube, $property_id, $sparePartId,
    $isDownload, $imageUrl, $canAddRow, $canAddRowStock, $totalPricePurchase, $rows = [];
    public $costEstimate = 0;
    public $discount_type = 0;
    public $deliveryDate;
    public $deliveryTime;
    public $payableAmount = 0;
    public $pendingAmount = 0;
    public $totalAmount = 0;
    public $showTable = 2; // Default to show first table
    public $extraCharges = [], $spareParts = [], $lubes = [], $tools = [], $accessoriess = [];
    public $isEdits = false;
    public $fields = [];
    public $vehicleType = '';
    public $vehicleTypes = [];
    public $brandType = '';
    public $brandTypes = [];
    public $modelType = '';
    public $modelTypes = [];
    public $fuelType = '';
    public $fuelTypes = [];

    public $payment_type, $countersale_number;
    public $partial_amount = 0;
    public $selectedItemsCustomerVoice = [];
    public $selectedItemsAccessoryVoice = [];
    public $selectedItemsWorkNoteVoice = [], $spare_parts_id;

    public $Company;


    public $showCustomerAlert = false;
    protected $listeners = ['delete', 'showModal', 'deleteDentImage', 'saveImage', 'selectedCustomer'];

    protected $rules = [
        'name' => 'required|string',
        'lastname' => 'nullable|string',
        'email' => 'nullable|email',
        'password' => 'nullable|min:6',
        'mobile_no' => 'required|digits:10',
        'branch_name' => 'required|string',
        'landline_no' => 'nullable|string',
        'country_id' => 'required|integer',
        'state_id' => 'required|integer',
        'city_id' => 'required|integer',
        'address' => 'required|string',
        'gender' => 'required',
    ];

    public function mount($isAdd = null)
    {
        $user = Auth::guard('sparepart')->user();
        $this->sparePartId = ($user->parent_id && (int) $user->user_type !== 0)
            ? (int) $user->parent_id
            : (int) $user->id;

        $this->branches = Branch::get();

        // Get company name for Spare Part Vendor
        $company_name = SparePartVendor::where('id', $this->sparePartId)->first();
        $this->Company = $company_name?->company_name ?? $company_name?->branch_name;

        // Preview next shared serial for display
        $companyCode = strtoupper(Str::of((string) $this->Company)->substr(0, 3).'INV');
        $financialYear = $this->getFinancialYear();
        $serialService = new SharedSerialService();
        $this->countersale_number = $serialService->previewNext($this->sparePartId, $companyCode, $financialYear);

        $this->customers = CounterCustomers::where('user_id', $this->sparePartId)->get();

        $this->customerVoicesData = DB::table('job_cards_inspections')
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'))
            ->groupBy('customer_voice')
            ->get();

        $this->spare = SparePart::with('label')->where('user_id', $this->sparePartId)->get();
    }

    public function render()
    {
        // Always refresh preview so it reflects latest claimed serials from other modules
        try {
            $companyCode = strtoupper(Str::of((string) $this->Company)->substr(0, 3).'INV');
            $financialYear = $this->getFinancialYear();
            $serialService = new SharedSerialService();
            $this->countersale_number = $serialService->previewNext($this->sparePartId, $companyCode, $financialYear);
        } catch (\Throwable $e) {
            // no-op preview failure
        }

        $customer_data = CounterCustomers::where('id', $this->customer_name)->first();
        return view('livewire.sparepart.countersaleadd', compact('customer_data'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;

    }

    public function updatedCustomerName($customer_id)
    {

        $this->customer_name = $customer_id;

        return true;
    }

    public function addCustomer()
    {
        $this->add = false;
        $this->showModal = true;
    }


    public function storeCustomer()
    {

        $valArr = [
            'name' => ["required", "string", "max:255"],
            'mobile_no' => ["required", "unique:counter_customers,mobile_no", "digits:10"],
            'address' => ["nullable", "string"],
            'email' => ["nullable", "email", "unique:counter_customers,email"],
        ];

        $this->validate($valArr);

        $customer = new CounterCustomers();
        $customer->name = $this->name;
        $customer->email = $this->email;
        $customer->mobile_no = $this->mobile_no;
        $customer->address = $this->address;
        $customer->user_id = $this->sparePartId;
        // $customer->number_plate = $this->numberPlate;
        $customer->gst_number = $this->gst_no;
        $customer->save();

        // echo "<pre>";print_r($customer);die;
        $this->customer_name = $customer->id;

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Counter Customer added successfully!',
        ]);

        $this->reset('name', 'email', 'mobile_no', 'address', 'gst_no');
        $this->showModal = false;
    }

    public function createCounterSale()
    {

        $items = $this->spareParts;
        $valArr = [
            'customer_name' => "required",
            'payment_type' => "required",
            'final_amount' => "required|numeric|min:1",
        ];

        $this->validate($valArr);
        if(empty($items)){
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Items can not be null',
            ]);
            return;
        }

        if ($this->payment_type == 'total' || $this->balance_amount <= 0) {
            $status = 2; // Full Paid
        } elseif ($this->partial_amount > 0) {
            $status = 1; // Partial Payment
        } else {
            $status = 0; // Un-paid
        }

        // Claim the shared serial atomically - use same format as Job Card for shared sequence
        $companyCode = strtoupper(Str::of((string) $this->Company)->substr(0, 3).'INV');
        $financialYear = $this->getFinancialYear();
        $serialService = new SharedSerialService();
        $claimedSerial = $serialService->claimNext($this->sparePartId, $companyCode, $financialYear);
        $this->countersale_number = $claimedSerial;

        // echo "<pre>";print_r($this->payment_type);die;
        $counterSale = new CounterSale();
        $counterSale->customer_id = $this->customer_name;
        $counterSale->countersale_number = $claimedSerial;
        $counterSale->shared_serial = $claimedSerial;
        $counterSale->date = date('Y-m-d');
        $counterSale->note = $this->note;
        $counterSale->total = $this->totalAmount;
        $counterSale->subtotal = $this->final_amount;
        $counterSale->partial_amount = $this->partial_amount;
        $counterSale->status = $status;
        $counterSale->payment_type = $this->payment_type;
        $counterSale->balance_amount = $this->balance_amount;
        $counterSale->sparepart_id = $this->sparePartId;
        $counterSale->staff_id = Auth::guard('sparepart')->id();
        $counterSale->save();



        CounterSaleSparePart::where('countersale_id', $counterSale->id)->delete();

        if (!empty($items)) {
            if (count($items) > 0) {
                foreach ($items as $itemKey => $itemValue) {
                    // Get spare part name directly from spare_parts table
                    $sparePart = SparePart::find($itemValue['id']);

                    if (!$sparePart) {
                        continue; // Skip if spare part not found
                    }

                    $partName = $sparePart->label?->title ?? $sparePart->name ?? 'Unknown';

                    $item = new CounterSaleSparePart();
                    $item->countersale_id = $counterSale->id;
                    $item->stock_label_id = $itemValue['id'];
                    $item->stock_label_name = $partName;
                    $item->quantity = $itemValue['quantity'];
                    $item->price = $itemValue['unit_price'];
                    $item->total_amount = $itemValue['total_amount'];
                    $item->discount = $itemValue['discount'];
                    $item->final_amount = $itemValue['final_amount'];
                    $item->discount_type = $itemValue['discount_type'];
                    $item->product_id = $itemValue['productId'];
                    $item->save();

                    // Update stock in spare_parts table
                    $sparePart->stock -= $itemValue['quantity'];
                    $sparePart->save();
                }

            }
        }

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Counter Sale Added Successfully!',
        ]);

        return redirect()->route('sparepart.countersale');
    }


    public function delete()
    {
        WorkShopVendor::destroy($this->staffId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Staff deleted successfully!']);
    }

    private function resetForm()
    {
        $this->name = '';
        $this->lastname = '';
        $this->gender = '';
        $this->email = '';
        $this->password = '';
        $this->mobile_no = '';
        $this->branch_name = '';
        $this->landline_no = '';
        $this->country_id = null;
        $this->state_id = null;
        $this->city_id = null;
        $this->address = '';
        $this->birth_date = '';
        $this->display_name = '';
        $this->staffId = null;
        $this->states = [];
        $this->cities = [];
    }



    public function updated($propertyName)
    {
        if (strpos($propertyName, 'spareParts') !== false) {
            $this->recalculateSpareParts();
        }
        $this->resetErrorBag();
    }

    public function recalculateSpareParts()
    {
        foreach ($this->spareParts as $index => $part) {
            $quantity = isset($part['quantity']) ? (float) $part['quantity'] : 0;
            $unitPrice = isset($part['unit_price']) ? (float) $part['unit_price'] : 0;
            $discount = isset($part['discount']) ? (float) $part['discount'] : 0;
            $discountType = isset($part['discount_type']) ? (int) $part['discount_type'] : 1;

            $total = $quantity * $unitPrice;

            if ($discountType === 2) {
                $discountAmount = ($total * $discount) / 100;
            } else {
                $discountAmount = min($discount, $total);
            }

            $final = max(0, $total - $discountAmount);

            $this->spareParts[$index]['total_amount'] = round($total, 2);
            $this->spareParts[$index]['final_amount'] = round($final, 2);
        }

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->totalAmount = 0;
        $this->final_amount = 0;

        foreach ($this->spareParts as $part) {
            $this->totalAmount += $part['total_amount'];
            $this->final_amount += $part['final_amount'];
        }

        // Auto-update balance based on selection
        if ($this->payment_type === 'total') {
            $this->partial_amount = $this->final_amount;
            $this->total_amount = $this->final_amount;
            $this->balance_amount = 0;
        } else {
            $this->balance_amount = $this->final_amount - $this->partial_amount;
        }
    }

    public function updatedPartialAmount()
    {
        $finalAmount = (float) $this->final_amount;
        $partialAmount = (float) $this->partial_amount;

        $this->balance_amount = max(0, $finalAmount - $partialAmount);
    }


    public function updatedPaymentType()
    {
        if ($this->payment_type === 'total') {
            $this->total_amount = $this->final_amount;
            $this->balance_amount = 0;
        } else {
            $this->partial_amount = 0;
            $this->balance_amount = $this->final_amount;
        }
    }




    public function updatedSparePartsData($id)
    {
        // Fetch spare part directly from spare_parts table
        $sparePart = SparePart::find($id);

        if (!$sparePart) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Spare Part not found!',
            ]);
            return;
        }

        // Calculate Offline Price: Selling Amount + Tax (if excluded)
        $unitPrice = $sparePart->selling_amount ?? 0;
        if ($sparePart->tax_type == 'exclude' && $sparePart->tax_percentage) {
            $unitPrice += ($unitPrice * $sparePart->tax_percentage) / 100;
        }

        // Add the spare part to the table
        $this->spareParts[] = [
            'id' => $sparePart->id,
            'part_name' => ($sparePart->label?->title ?? $sparePart->name ?? 'Unknown') . ' (Current Stock: ' . ($sparePart->stock ?? 0) . ')',
            'quantity' => '1',
            'unit_price' => $unitPrice,
            'total_amount' => $unitPrice * 1,
            'discount' => '0',
            'final_amount' => $unitPrice,
            'productId' => $sparePart->id,
            'discount_type' => $this->discount_type,
        ];

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Spare Part Row added Successfully!',
        ]);

        $this->calculateTotals();
    }



    public function removeRow($type, $index)
    {
        $amountToDeduct = 0;
        $discountToDeduct = 0;

        if ($type == 'spareParts' && isset($this->spareParts[$index])) {
            $amountToDeduct = $this->spareParts[$index]['total_amount'];
            $discountToDeduct = $this->spareParts[$index]['discount'] ?? 0;

            // Remove the row
            unset($this->spareParts[$index]);
        }

        // Update the total amount and final amount
        $this->totalAmount -= $amountToDeduct;
        $this->final_amount -= ($amountToDeduct - $discountToDeduct);

        // Ensure the amounts do not become negative
        if ($this->totalAmount < 0) {
            $this->totalAmount = 0;
        }
        if ($this->final_amount < 0) {
            $this->final_amount = 0;
        }

        $this->balance_amount = $this->final_amount - $this->advance;

        $this->dispatch('swal:toast', [
            'type' => 'error',
            'message' => 'Row Remove Successfully!',
        ]);
    }

    private function getFinancialYear(): string
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        
        // Financial year starts from April (month 4)
        if ($currentMonth >= 4) {
            // If current month is April or later, financial year is current year to next year
            $fyStart = substr($currentYear, -2);
            $fyEnd = substr($currentYear + 1, -2);
        } else {
            // If current month is before April, financial year is previous year to current year
            $fyStart = substr($currentYear - 1, -2);
            $fyEnd = substr($currentYear, -2);
        }
        
        return $fyStart . $fyEnd;
    }


}
