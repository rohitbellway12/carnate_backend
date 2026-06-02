<?php

namespace App\Livewire\Workshop;

use App\Models\ProductStock;
use Livewire\WithFileUploads;
use App\Models\{WorkShopVendor, Branch, CounterCustomers, CounterSale, CounterSaleSparePart, SparePart, SparePartLabel};

use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Support\Str;
use App\Services\SharedSerialService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]

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
    public $isWorkshopGst = false;
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
    public $dateOfManufacturing, $gearbox, $gearboxNo, $engineN, $engineSize, $engine, $keyNo, $engineNo, $isPurchase, $showPurchase, $isPrint, $showPrint, $type, $showDownload, $accessory, $spare, $tool, $labourCharges, $lube, $property_id, $workshopeId,
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
    public $lastSerial;
    protected $listeners = ['delete', 'showModal', 'deleteDentImage', 'saveImage', 'selectedCustomer'];

    protected $rules = [
        'name' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email',
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
        $this->isWorkshopGst = Auth::guard('workshop')->user()->is_gst == 1;
        $this->workshopeId = Auth::guard('workshop')->user()->id;
        $this->branches = Branch::get();

        $comapny_name=WorkShopVendor::where('id', $this->workshopeId)->first();
        $this->Company = $comapny_name?->company_name ?? $comapny_name?->branch_name;

        // Preview next shared serial for display
        $vendor = WorkShopVendor::find($this->workshopeId);
        $companyCode = SharedSerialService::resolveCompanyCode($vendor);
        $financialYear = SharedSerialService::resolveSeriesCode();
        $serialService = new SharedSerialService();
        $this->countersale_number = $serialService->previewNext($this->workshopeId, $companyCode, $financialYear);
        $this->customers = CounterCustomers::where('user_id', $this->workshopeId)->get();

        $this->customerVoicesData = DB::table('job_cards_inspections')
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'))
            ->groupBy('customer_voice')
            ->get();

        // Load only this workshop's own stock items
        $this->spare = ProductStock::with('label')
            ->where('user_id', $this->workshopeId)
            ->where('stock', '>', 0)
            ->get();
    }


    public function render()
    {
        // Always refresh preview so it reflects latest claimed serials from other modules
        try {
            $vendor = WorkShopVendor::find($this->workshopeId);
            $companyCode = SharedSerialService::resolveCompanyCode($vendor);
            $financialYear = SharedSerialService::resolveSeriesCode();
            $serialService = new SharedSerialService();
            $this->countersale_number = $serialService->previewNext($this->workshopeId, $companyCode, $financialYear);
        } catch (\Throwable $e) {
            // no-op preview failure
        }

        $customer_data = CounterCustomers::where('id', $this->customer_name)->first();

        return view('livewire.workshop.countersale.countersaleadd', compact('customer_data'));
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
            'name' => ["required"],
            'mobile_no' => ['required', 'unique:counter_customers,mobile_no', 'digits:10'],
            'address' => ['nullable'],
            'email' => ['nullable', 'unique:counter_customers,email'],
        ];


        $this->validate($valArr);

        $customer = new CounterCustomers();
        $customer->name = $this->name;
        $customer->email = $this->email;
        $customer->mobile_no = $this->mobile_no;
        $customer->address = $this->address;
        $customer->user_id = $this->workshopeId;
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

        if ($this->payment_type == 'total') {
            $status = 1;
        } else {
            $status = 0;
        }

        // Claim the shared serial atomically - use same format as Job Card for shared sequence
        $vendor = WorkShopVendor::find($this->workshopeId);
        $companyCode = SharedSerialService::resolveCompanyCode($vendor);
        $financialYear = SharedSerialService::resolveSeriesCode();
        $serialService = new SharedSerialService();
        $claimedSerial = $serialService->claimNext($this->workshopeId, $companyCode, $financialYear);
        $this->countersale_number = $claimedSerial;

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
        $counterSale->type = 1;
        $counterSale->workshop_id = $this->workshopeId;
        $counterSale->is_gst = $this->isWorkshopGst ? 1 : 0;
        $counterSale->save();



        CounterSaleSparePart::where('countersale_id', $counterSale->id)->delete();

        if (!empty($items)) {
            if (count($items) > 0) {
                foreach ($items as $itemKey => $itemValue) {
                    // Get from workshop's product stock
                    $stockItem = ProductStock::with('label')->find($itemValue['id']);

                    if (!$stockItem) {
                        continue;
                    }

                    $partName = $stockItem->title ?? $stockItem->label?->title ?? 'Unknown';

                    // Deduct stock from product_stocks (stocks table)
                    $stockItem->stock -= $itemValue['quantity'];
                    $stockItem->save();

                    $item = new CounterSaleSparePart();
                    $item->countersale_id  = $counterSale->id;
                    $item->stock_label_id  = $itemValue['id'];
                    $item->stock_label_name= $partName;
                    $item->quantity        = $itemValue['quantity'];
                    $item->price           = $itemValue['unit_price'];
                    $item->total_amount    = $itemValue['total_amount'];
                    $item->discount        = $itemValue['discount'];
                    $item->final_amount    = $itemValue['final_amount'];
                    $item->discount_type   = $itemValue['discount_type'];
                    $item->product_id      = $itemValue['productId'];
                    $item->save();
                }
            }
        }

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Counter Sale Added Successfully!',
        ]);

        return redirect()->route('workshop.counter_sale');
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
            $taxRate = $this->isWorkshopGst ? (isset($part['tax_percentage']) ? (float) $part['tax_percentage'] : 0) : 0;
            $taxType = isset($part['tax_type']) ? $part['tax_type'] : 'include';

            $baseTotal = $quantity * $unitPrice;

            if ($discountType == 2) {
                $discountAmount = ($baseTotal * $discount) / 100;
            } else {
                $discountAmount = $discount;
            }

            $afterDiscount = max(0, $baseTotal - $discountAmount);

            // Add tax if it is excluded
            if ($taxType == 'exclude') {
                $final = $afterDiscount * (1 + $taxRate / 100);
            } else {
                $final = $afterDiscount;
            }

            $this->spareParts[$index]['total_amount'] = $baseTotal;
            $this->spareParts[$index]['final_amount'] = $final;
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
        // Fetch from workshop's product stock
        $sparePart = ProductStock::with('label')->find($id);

        if (!$sparePart) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Item not found in stock!',
            ]);
            return;
        }

        $partTitle = $sparePart->title ?? $sparePart->label?->title ?? 'Unknown';

        // Add the item to the table
        $this->spareParts[] = [
            'id'           => $sparePart->id,
            'part_name'    => $partTitle . ' (Current Stock: ' . ($sparePart->stock ?? 0) . ')',
            'quantity'     => '1',
            'unit_price'   => $sparePart->price ?? 0,
            'total_amount' => ($sparePart->price ?? 0) * 1,
            'discount'     => '0',
            'final_amount' => $sparePart->price ?? 0,
            'productId'    => $sparePart->id,
            'discount_type'=> $this->discount_type,
            'tax_percentage' => $sparePart->tax_percentage ?? 0,
            'tax_type'     => $sparePart->tax_type ?? 'include',
        ];

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Item added successfully!',
        ]);

        $this->recalculateSpareParts();
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
