<?php

namespace App\Livewire\Workshop;

use App\Mail\EstimateMail;
use App\Mail\InvoiceMail;
use App\Models\{City, WorkShopVendor, Country, State, Branch, Category, Customer, JobCard, JobCardImage, Modification, UploadImage, User, Vehicle, Order, SparePart, OrderItem, Payment, SparePartVehicleModification, Staff, Unit, VehicleModel};
use App\Models\Fueltype;
use App\Models\JobCardExtraCharge;
use App\Models\JobCardsDentMark;
use App\Models\JobCardsInspection;
use App\Models\JobCardSparePart;
use App\Models\LabourCharge;
use App\Models\ProductStock;
use App\Models\SendJobCardPdfMail;
use App\Models\SparePartLabel;
use App\Models\Vehiclebrand;
use App\Models\VehicleType;
use Illuminate\Support\Facades\{Auth, DB, Mail};
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Services\SharedSerialService;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Razorpay\Api\Api;
use Livewire\Attributes\On;

#[Layout('components.layouts.workshop-app')]

class JobCardEditController extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $gender, $birth_date, $display_name, $branches;
    public $staffId, $workshopId, $jobId, $jobcardData, $vehicles, $km_reading, $fual_level, $imagePath, $dentImageId, $mechanic, $sparePartLabel, $isAddvehicle, $unit_price, $sms_alert, $pdftype, $viewtype, $items_purchase, $showstock, $isOpen, $vehicle_brand_id_data, $vehicle_type_id_data, $vehicle_type_id, $vehicledatacollection, $extra_charges, $spare_parts_data, $search_customer_voice, $search_accessory, $search_work_notes, $item, $search_vehicle, $selectedVehicleName, $payment_type, $transaction_number, $gst_no;

    public $customerVoiceCount = "0";
    public $mechanic_id = "0";
    public $part_name = "0";
    public $hidden_balance_amount = "0";
    public $jobcarddentCount = "0";
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
    public $showCustomerVoice, $addCustomerVoice, $confirmpassword, $add, $smsAlert, $showPhoto, $addphoto, $accessories, $showAccessoriesVoice, $addAccessoriesVoice, $addWorkNote, $showWorkNote, $images, $addVehicals, $isAddvehicl, $jobcard_number, $customer_name, $vehiclesName, $orderId;
    public $customerVoices = [];
    public $jobcard_item_id = [];
    public $jobcard_quantity = [];
    public $jobcard_price = [];
    public $jobcard_total_amount = [];
    public $jobcard_discount = [];
    public $jobcard_final_amount = [];
    public $employee = [];
    public $label = [];
    public $charge = [];
    public $accessoriesVoices = [];
    public $workVoices = [];
    public $isAdd = false;
    public $showDentCar = false;
    public $jobcardNumbers;
    public $jobCardsDentImage;
    public $customerVoicesData = [];
    public $adds = false;

    public $isVehical, $showVehical, $isBrand, $showBrand, $isModel, $showModel, $isFuel, $showFuel, $vehicleDetails, $spare_parts_price, $driver_name, $driver_number, $policy_number, $insurance_name, $gstin_number, $policy_expiry_date, $pickup_address, $drop_address;
    public $vehicle_id, $vehicleBrand, $modelName, $fuel_id, $odometerReading, $numberPlate, $chassisNo, $modelYear, $noOfGear, $user;
    public $dateOfManufacturing, $gearbox, $gearboxNo, $engineN, $engineSize, $engine, $keyNo, $engineNo, $isPurchase, $showPurchase, $isPrint, $showPrint, $type, $showDownload, $accessory, $spare, $tool, $labourCharges, $lube, $property_id,
    $isDownload, $imageUrl, $canAddRow, $canAddRowStock, $totalPricePurchase, $rows = [], $shared_serial_preview, $subtotal = 0;
    public $costEstimate = 0;
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

    public $units = [], $categories = [];
    public $stock_itemName, $stock_brand_name, $stock_sellPrice, $stock_tax_type, $stock_tax_percentage, $stock_quantity, $stock_hsn_code, $stock_rack_no, $stock_part_number, $stock_unit, $stock_category, $stock_suitable_for, $stock_forAllVehicles = false, $modifications = [], $forAllVehicles = false, $suitable_for, $stock_buy_price, $stock_sp_type;

    public $selectedItemsCustomerVoice = [];
    public $selectedItemsAccessoryVoice = [];
    public $selectedItemsWorkNoteVoice = [], $notes, $showCustomerVoiceInput = false, $customerVoiceInpt, $accessoryData, $showAccessoriesInput = false, $accessoriesVoicesInput, $showWorkNoteInput = false, $workNotInpt, $worknotVoicesData;

    public $showLabourCharge, $title, $labour_type,  $outsource_price, $tax_type, $tax_percentage, $price, $total_price, $labourId, $extra_charges_dropdown, $customer_data;

    public $puchase_price;

    //spare part purchase price
    public $purchase_price;
    protected $listeners = ['delete', 'showModal', 'deleteDentImage', 'saveImage', 'closejobcard'];

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

    public function mount($id)
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
        $this->user = WorkShopVendor::where('id', $this->workshopId)->first();
        $this->branches = Branch::get();

        $this->deliveryDate = now()->format('Y-m-d');
        $this->deliveryTime = now()->format('H:i');
        $this->showTable = 2;
        $this->jobId = $id;
        $this->customers = Customer::where('user_id', $this->workshopId)->get();


        $jobcardData = JobCard::find($this->jobId);

        // dd($jobcardData->toArray());
        $this->jobcardData = $jobcardData;
        $this->final_amount = $jobcardData->final_amount;
        $this->totalAmount = $jobcardData->amount;
        $this->advance = $jobcardData->advance;
        $this->balance_amount = $jobcardData->balance_amount;
        $this->hidden_balance_amount = $jobcardData->balance_amount;
        $this->final_discount = $jobcardData->final_discount;
        $this->final_paid = $jobcardData->final_paid;
        $this->supervisor = $jobcardData->supervisor_id;
        $this->payment_type = $jobcardData->payment_type;
        $this->transaction_number = $jobcardData->transaction_number;
        $this->notes = $jobcardData->notes;

        $extracharges = JobCardExtraCharge::where('jobcard_id', $this->jobId)->get();
        $jobcardImage = JobCardImage::where('job_card_number', $jobcardData->jobcard_number)->first();

        $this->photosCount = UploadImage::whereIn('id', explode(',', @$jobcardImage->image_id))->get()->count();


        foreach ($extracharges as $extracharge) {
            // manish
            $qty = $extracharge->qty ?? 1;
            $amount = $extracharge->amount ?? 0;
            $gstPercentage = $extracharge->gst ?? 0;
            $gstType = $extracharge->gst_type ?? 'exclude';

            $baseTotal = $qty * $amount;
            $gstAmount = 0;
            $finalAmount = 0;

            if ($gstType === 'exclude' && $gstPercentage > 0) {
                // GST Exclude: GST is added to base amount
                $gstAmount = ($baseTotal * $gstPercentage) / 100;
                $finalAmount = $baseTotal + $gstAmount;
            } elseif ($gstType === 'include' && $gstPercentage > 0) {
                // GST Include: GST is already included in the amount, extract GST
                // $gstAmount = ($baseTotal * $gstPercentage) / (100 + $gstPercentage);
                $gstAmount = ($baseTotal * $gstPercentage) /100;
                $finalAmount = $baseTotal; // Amount already includes GST
            } else {
                // No GST
                $finalAmount = $baseTotal;
            }

            // Calculate Cost Amount (GST amount) - This should show the GST amount
            $costAmount = round($gstAmount, 2);

            // Calculate Product Cost based on GST type
            if ($gstType === 'include') {
                // If GST is included: Product Cost = Selling Price - Cost Amount (GST)
                $productCost = round($finalAmount - $gstAmount, 2);
            } else {
                // If GST is excluded: Product Cost = Selling Price + Cost Amount (GST)
                // $productCost = round($finalAmount + $gstAmount, 2);
                $productCost = round($finalAmount , 2);
            }

            $this->extraCharges[] = [
                'label' => $extracharge->label,
                'charge' => $extracharge->charges,
                'mechanic_id' => $extracharge->machanic_id,
                'charge_type' => $extracharge->charge_type,
                'amount' => $extracharge->amount,
                'gst_type' => $extracharge->gst_type,
                'gst_percentage' => $extracharge->gst,
               'labour_type' => $extracharge->labour_type ?? null, // ✅ Add this
    'outsource_price' => $extracharge->outsource_price ?? null,
     'qty' => $extracharge->qty ?? 1,
     'cost_amount' => $costAmount,
     'product_cost' => $productCost,

            ];
           // dd($this->extraCharges);
        }

        // echo "<prE>";print_r($jobcardData->jobCardSpareParts->toArray());
        // die;

        foreach ($jobcardData->jobCardSpareParts as $jobcardLabel) {

            // Prefer values saved on job_card_spare_parts; fallback to SparePart/ProductStock
            $purchasePrice = $jobcardLabel->purchase_price ?? null;
            $taxType = $jobcardLabel->tax_type ?? null;
            $taxPercentage = $jobcardLabel->tax_percentage ?? null;

            if ($purchasePrice === null || $taxType === null || $taxPercentage === null) {
                $stockMeta = SparePart::where('label_id', $jobcardLabel->stock_label_id)
                    ->where('user_id', Auth::guard('workshop')->user()->id)
                    ->first();
                if (!$stockMeta) {
                    $stockMeta = ProductStock::where('user_id', Auth::guard('workshop')->user()->id)
                        ->where('label_id', $jobcardLabel->stock_label_id)
                        ->first();
                }
                $purchasePrice = $purchasePrice ?? ($stockMeta->purchase_price ?? $stockMeta->buy_price ?? null);
                $taxType = $taxType ?? ($stockMeta->tax_type ?? null);
                $taxPercentage = $taxPercentage ?? ($stockMeta->tax_percentage ?? null);
            }

            $data = [
                'id' => $jobcardLabel->stock_label_id,
                'part_name' => $jobcardLabel->stock_label_name . ' (Current Stock: ' . $jobcardLabel->quantity . ')',
                'quantity' => $jobcardLabel->quantity,
                'unit_price' => $jobcardLabel->price,
                'purchase_price' => $purchasePrice,
                'tax_type' => $taxType,
                'tax_percentage' => $taxPercentage,
                'total_amount' => $jobcardLabel->total_amount,
                'discount' => $jobcardLabel->discount,
                'discount_type'=>$jobcardLabel->discount_type,
                'final_amount' => $jobcardLabel->final_amount,
            ];



            switch ($jobcardLabel->category) {
                case 2: // Spare Parts
                    $this->spareParts[] = $data;
                    break;
                case 4: // Lubricants
                    $this->lubes[] = $data;
                    break;
                case 1: // Accessories
                    $this->accessoriess[] = $data;
                    break;
                default:
                    // Handle unknown types if necessary
                    break;
            }

        }



        $this->vehicles = Vehicle::where('id', $jobcardData->vehicle_id)->get();

        $this->loadWorkshopStockDropdowns();
        $this->rows[] = [
            'category' => '',
            'item' => '',
            'quantity' => '',
            'price' => 0,
            'total_price' => 0,
        ];

        $jobcardData = JobCard::find($this->jobId);
        $this->jobcardData = $jobcardData;

        $this->vehical_types = VehicleType::where('soft_delete', '=', 0)->get();
        $this->fuel_types = Fueltype::where('soft_delete', '=', 0)->get();
        $jobcardImage = JobCardImage::where('job_card_number', $jobcardData->jobcard_number)->first();

        $this->carImages = UploadImage::whereIn('id', explode(',', @$jobcardImage->image_id))->get();
        // echo "<pre>";print_r($jobcardData);die;
        $jobcardNumber = $jobcardData->jobcard_number;

        $this->jobcardNumbers = $jobcardData->jobcard_number;

        // Prepare a preview of shared serial for UI display (does not claim)
        try {
            $serialService = new SharedSerialService();
            [$companyCode, $seriesCode] = $this->sharedSerialCodes();
            $this->shared_serial_preview = $serialService->previewNext($this->workshopId, $companyCode, $seriesCode);
        } catch (\Throwable $e) {
            $this->shared_serial_preview = null;
        }

        $this->jobcarddentCount = JobCardsDentMark::where('jobcard_number', $jobcardNumber)->count();

        $inspectionCounts = JobCardsInspection::where('jobcard_number', $jobcardNumber)
            ->selectRaw('is_customer_voice, COUNT(*) as count')
            ->groupBy('is_customer_voice')
            ->pluck('count', 'is_customer_voice');


        $this->workNoteCount = $inspectionCounts[0] ?? 0;
        $this->customerVoiceCount = $inspectionCounts[1] ?? 0;
        $this->accessariesCount = $inspectionCounts[2] ?? 0;

        $this->km_reading = $jobcardData->km_runing;
        $this->fual_level = $jobcardData->fual_level;
        $this->deliveryDate = $jobcardData->delivery_date;
        $this->deliveryTime = $jobcardData->delivery_time;
        $this->jobcard_number = $jobcardNumber;
        $this->customer_name = $jobcardData->customer_id;
        $this->vehicle_id = $jobcardData->vehicle_id;
        $this->customer_data = $jobcardData->customer;

        $this->fetchCustomerVoicesData();
        $this->fetchAccessoryData();
        $this->fetchWorkNoteVoicesData();

        $this->stock_sp_type = 0;

        // $this->supervisors = WorkShopVendor::where('user_type', 21)->where('parent_id', $this->workshopId)->get();
         $this->supervisors = WorkShopVendor::where('parent_id', $this->workshopId)->get();
        // dd($this->supervisors);
        $this->mechanic = WorkShopVendor::where('user_type', 32)->where('parent_id', $this->workshopId)->get();
    }


    private function fetchCustomerVoicesData()
    {
        $this->customerVoices = JobCardsInspection::where('jobcard_number', $this->jobcardData->jobcard_number)
            ->where('is_customer_voice', 1)
            ->pluck('customer_voice')
            ->toArray();
        // echo "<pre>"; print_r($inspectionCounts); die;
        $this->customerVoicesData = DB::table('job_cards_inspections')->where('is_customer_voice', 1)
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));
        if (!empty($this->customerVoices)) {
            $this->customerVoicesData = $this->customerVoicesData->whereNotIn('customer_voice', $this->customerVoices);
        }

        $this->customerVoicesData = $this->customerVoicesData->groupBy('customer_voice')->orderBy('id', 'desc')->get();
    }

    private function fetchAccessoryData()
    {

        $this->accessoriesVoices = JobCardsInspection::where('jobcard_number', $this->jobcardData->jobcard_number)
            ->where('is_customer_voice', 2)
            ->pluck('customer_voice')
            ->toArray();
        $this->accessoryData = DB::table('job_cards_inspections')->where('is_customer_voice', 2)
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));

        if (!empty($this->accessoriesVoices)) {
            $this->accessoryData = $this->accessoryData->whereNotIn('customer_voice', $this->accessoriesVoices);
        }

        $this->accessoryData = $this->accessoryData->groupBy('customer_voice')->orderBy('id', 'desc')->get();
    }

    private function fetchWorkNoteVoicesData()
    {

        $this->workVoices = JobCardsInspection::where('jobcard_number', $this->jobcardData->jobcard_number)
            ->where('is_customer_voice', 0)
            ->pluck('customer_voice')
            ->toArray();

        $this->worknotVoicesData = DB::table('job_cards_inspections')->where('is_customer_voice', 0)
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));

        if (!empty($this->workVoices)) {
            $this->worknotVoicesData = $this->worknotVoicesData->whereNotIn('customer_voice', $this->workVoices);
        }

        $this->worknotVoicesData = $this->worknotVoicesData->groupBy('customer_voice')->orderBy('id', 'desc')->get();
    }


    public function upload_property()
    {
        // Validate the property_photos field
        $this->validate([
            'property_photos' => ['required'],
        ]);

        $photoPaths = [];
        $photoIDs = [];

        if (sizeof($this->property_photos)) {
            foreach ($this->property_photos as $property_photo) {
                if (!empty($property_photo)) {
                    $photoPath = $property_photo->store("job_card_image" . $this->property_id . "/gallery", "public");
                    $photoPaths[] = $photoPath;

                    $fileExtension = $property_photo->getClientOriginalExtension();
                    $image = UploadImage::create([
                        "file" => $photoPath,
                        "ext" => $fileExtension,
                        "img_id" => 0,
                        "delete_code" => 0,
                        "type" => 0,
                    ]);
                    $photoIDs[] = $image->id;
                }
            }
            JobCardImage::where('job_card_number', $this->jobcardNumbers)->delete();

            if (!empty($photoIDs)) {
                JobCardImage::create([
                    'job_card_number' => $this->jobcardNumbers,
                    'image_id' => implode(',', $photoIDs),
                ]);
            }

            $this->photosCount = UploadImage::whereIn('id', $photoIDs)->get()->count();

            $this->isOpen = '';
            $this->property_photos = [];
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Car Image uploaded']);
            $this->showPhoto = false;
        }
    }



    public function addRowPurchase()
    {
        if (empty($this->canAddRow)) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'title' => "Item cannot be null.",
            ]);
        } else {
            $this->rows[] = [
                'category' => '',
                'item' => '',
                'quantity' => '',
                'price' => 0,
                'total_price' => 0,
            ];
            $this->canAddRow = false;
        }
    }

    public function removeRowPurchase($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Reindex the array
        $this->calculateTotalPurchase();
        $this->canAddRow = true;
    }

    public function removeRowstock($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Reindex the array
        $this->canAddRowStock = true;
    }

    public function getItemPurchase($index)
    {
        $category = $this->rows[$index]['category'];
        $modId = $this->resolveJobCardModificationId();

        $this->rows[$index]['item'] = '';
        $this->rows[$index]['quantity_purchase'] = 0;
        $this->rows[$index]['max_quantity'] = 0;
        $this->rows[$index]['price_purchase'] = 0;
        $this->rows[$index]['selling_price'] = 0;
        $this->rows[$index]['total_price_purchase'] = 0;

        $items_purchase_query = DB::table('spare_parts')
            ->join('spare_part_labels', 'spare_parts.label_id', '=', 'spare_part_labels.id') // INNER JOIN
            ->where('spare_parts.spare_part_type', $category)
            ->where('spare_parts.stock', '>', 0)
            ->whereNotIn('spare_parts.id', array_column($this->rows, 'item'))
            ->whereNull('spare_parts.deleted_at')
            ->whereNull('spare_part_labels.deleted_at') // Ignore soft-deleted labels
            ->whereExists(function ($subQuery) {
                $subQuery->select(DB::raw(1))
                    ->from('spare_part_vendor')
                    ->whereRaw('spare_part_vendor.id = spare_parts.user_id')
                    ->where('spare_part_vendor.online_stock_status', 1);
            });

        if ($modId) {
            $items_purchase_query = $items_purchase_query->where(function ($query) use ($modId) {
                $query->where('spare_parts.forAllVehicles', 1)
                      ->orWhereExists(function ($subQuery) use ($modId) {
                          $subQuery->select(DB::raw(1))
                                   ->from('spare_part_vehicle_modifications')
                                   ->whereRaw('spare_part_vehicle_modifications.spare_part_id = spare_parts.id')
                                   ->where('spare_part_vehicle_modifications.vehicle_modification_id', $modId);
                      });
            });
        }

        $items_purchase = $items_purchase_query->select(
                'spare_parts.*',
                DB::raw("spare_part_labels.title as label_title")
            )
            ->get();

        $this->items_purchase[$index] = $items_purchase;
        if ($items_purchase->count() > 0) {
            $firstItem = $items_purchase->first();
            $this->rows[$index]['item'] = $firstItem->id;
            $this->rows[$index]['quantity_purchase'] = 1;
            $this->rows[$index]['max_quantity'] = $firstItem->stock;
            // Calculate Offline Price (Auto)
            $offlinePrice = $firstItem->selling_amount ?? 0;
            if (($firstItem->tax_type ?? '') == 'exclude' && ($firstItem->tax_percentage ?? 0)) {
                $offlinePrice += ($offlinePrice * $firstItem->tax_percentage) / 100;
            }

            // Purches Price (under Purches Price column) = Online Price (Auto)
            $this->rows[$index]['price_purchase'] = $firstItem->price ?? 0;
            // Selling Price (under Selling Price column) = Offline Price (Auto)
            $this->rows[$index]['selling_price'] = $offlinePrice;
            $this->rows[$index]['total_price_purchase'] = ($this->rows[$index]['selling_price'] ?? 0) * 1;
        }
        $this->canAddRow = true;
        $this->recalculateTotalPricePurchase();
    }

    public function getAmountPurchase($index)
    {
        $itemId = $this->rows[$index]['item'];
        $item = SparePart::find($itemId);

        if ($item) {
            // Calculate Offline Price (Auto)
            $offlinePrice = $item->selling_amount ?? 0;
            if (($item->tax_type ?? '') == 'exclude' && ($item->tax_percentage ?? 0)) {
                $offlinePrice += ($offlinePrice * $item->tax_percentage) / 100;
            }

            // Purches Price (under Purches Price column) = Online Price (Auto)
            $this->rows[$index]['price_purchase'] = $item->price ?? 0;
            // Selling Price (under Selling Price column) = Offline Price (Auto)
            $this->rows[$index]['selling_price'] = $offlinePrice;
            $this->rows[$index]['max_quantity'] = $item->stock;

            $this->updateTotalPricePurchase($index);
        }
    }

    public function updateTotalPricePurchase($index)
    {
        $quantity = (int) ($this->rows[$index]['quantity_purchase'] ?? 0); // Cast to integer
        $price = (float) ($this->rows[$index]['selling_price'] ?? 0);

        // Update the total price for the row
        $this->rows[$index]['total_price_purchase'] = $quantity * $price;
        $this->recalculateTotalPricePurchase();
    }

    public function recalculateTotalPricePurchase()
    {
        $this->totalPricePurchase = array_sum(array_column($this->rows, 'total_price_purchase'));
    }


    public function updatedSearchCustomerVoice($customerVoice)
    {
        $this->customerVoicesData = DB::table('job_cards_inspections')->where('customer_voice', 'like', '%' . $customerVoice . '%')->where('is_customer_voice', 1)
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));

        if (!empty($this->customerVoices)) {
            $this->customerVoicesData = $this->customerVoicesData->whereNotIn('customer_voice', $this->customerVoices);
        }

        $this->customerVoicesData = $this->customerVoicesData->groupBy('customer_voice')->orderBy('id', 'desc')->get();
    }

    public function updatedSearchAccessory($accessory)
    {

        $this->accessoryData = DB::table('job_cards_inspections')->where('is_customer_voice', 2)->where('customer_voice', 'like', '%' . $accessory . '%')
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));

        if (!empty($this->accessoriesVoices)) {
            $this->accessoryData = $this->accessoryData->whereNotIn('customer_voice', $this->accessoriesVoices);
        }

        $this->accessoryData = $this->accessoryData->groupBy('customer_voice')->orderBy('id', 'desc')->get();
    }

    public function updatedSearchWorkNotes($worknotes)
    {

        $this->worknotVoicesData = DB::table('job_cards_inspections')->where('is_customer_voice', 0)->where('customer_voice', 'like', '%' . $worknotes . '%')
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));

        if (!empty($this->workVoices)) {
            $this->worknotVoicesData = $this->worknotVoicesData->whereNotIn('customer_voice', $this->workVoices);
        }

        $this->worknotVoicesData = $this->worknotVoicesData->groupBy('customer_voice')->orderBy('id', 'desc')->get();
    }


    public function updatedSearchVehicle($modelId)
    {

        $vehicle_model = VehicleModel::where('id', $modelId)->first();
        $vehicle_brand = Vehiclebrand::where('id', $vehicle_model->brand_id)->first();
        $vehicle_type = VehicleType::where('id', $vehicle_brand->vehicle_type_id)->first();

        $this->vehicle_type_id = $vehicle_type->id;
        $this->vehicleBrand = $vehicle_brand->id;
        $this->modelName = $vehicle_model->id;


        $this->selectedVehicleName = $vehicle_type->vehicle_type . '/' . $vehicle_brand->vehicle_brand . '/' . $vehicle_model->model_name;
    }
    public function updatedCustomerName($customerId)
    {
        if (!empty($customerId)) {
            $this->vehicles = $vehicleData = Vehicle::where('customer_id', $customerId)->get();
            if (empty($vehicleData->toArray())) {
                $this->dispatch('swal:toast', [
                    'type' => 'info',
                    'message' => 'No vehicles found for this customer. Please add a vehicle.'
                ]);
            } else {
                $this->dispatch('swal:toast', [
                    'type' => 'success',
                    'message' => 'Vehicles found successfully.'
                ]);
            }
        } else {
            $this->vehicles = collect();
        }
    }



    public function updatedPurchase($propertyName)
    {
        // Trigger getItem() when category is updated
        if (str_contains($propertyName, 'rows.') && str_contains($propertyName, '.category')) {
            preg_match('/rows\.(\d+)\.category/', $propertyName, $matches);
            if (isset($matches[1])) {
                $this->getItem($matches[1]);
            }
        }
    }

    public function updatedRowsPurchase()
    {
        $this->calculateTotalPurchase();
    }
    public function updatedRows($value, $index)
    {
        $index = explode('.', $index);
        if (isset($index[1]) && $index[1] == 'item') {
            // dd($value);
            $this->getAmountPurchase($index[0]);
        }
    }

    public function calculateTotalPurchase()
    {
        $this->totalPricePurchase = array_sum(array_column($this->rows, 'total_price_purchase'));
    }
    public function getCanSubmitPropertyPurchase(): bool
    {
        return !collect($this->rows)->contains(fn($row) => empty($row['quantity_purchase']) || $row['quantity_purchase'] == 0);
    }

    public function getCanSubmitPropertyStock(): bool
    {
        return !collect($this->rows)->contains(fn($row) => empty($row['quantity_stock']) || $row['quantity_stock'] == 0);
    }


    public function createOrder()
    {
        // $api_key = env('RAZORPAY_KEY');
        // $api_secret = env('RAZORPAY_SECRET');
$api_key = config('services.razorpay.key');
$api_secret = config('services.razorpay.secret');

        $api = new Api($api_key, $api_secret);

        $orderData = [
            'amount' => $this->totalPricePurchase * 100, // Convert to paise
            'currency' => 'INR',
            'receipt' => 'receipt_' . time(),
        ];

        $order = $api->order->create($orderData);
        $this->orderId = $order->id;

        // Dispatch the event with the order details
        $this->dispatch('razorpay-show', [
            'amount' => $this->totalPricePurchase,
            'orderId' => $this->orderId,
        ]);

        \Log::info('Razorpay Order Response:', (array) $order);
    }


    #[On('storePayment')]
    public function handlePayment($paymentResponse)
    {
        $payment = Payment::create([
            'payment_id' => $paymentResponse['razorpay_payment_id'],
            'order_id' => $paymentResponse['razorpay_order_id'],
            'status' => 'success',
            'amount' => $paymentResponse['amount'],
            'user_id' => Auth::guard('workshop')->user()->id,
        ]);


        $purchaseTotal = array_sum(array_map(function($row) {
            return ($row['quantity_purchase'] ?? 1) * ($row['price_purchase'] ?? 0);
        }, $this->rows));

        $order = new Order;
        $order->order_date = now();
        $order->total_amount = $purchaseTotal;
        $order->total_quantity = array_sum(array_column($this->rows, 'quantity_purchase'));
        $order->total_item = count($this->rows);
        $order->workshop_id = Auth::guard('workshop')->user()->id;
        $order->payment_id = 1;
        $order->jobcard_id = $this->jobId;
        $order->is_confim = $this->shouldPublishJobCardOrders() ? 1 : 0;
        $order->save();

        // echo "<pre>";print_r($this->rows);die;
        foreach ($this->rows as $row) {
            $sparePart = SparePart::find($row['item']);
            if (!$sparePart) continue;

            $userId = $sparePart->user_id;

            $orderItem = new OrderItem;
            $orderItem->spare_part_id = $row['item'];
            $orderItem->user_id = $userId;
            $orderItem->quantity = $row['quantity_purchase'];
            $orderItem->price = $row['price_purchase'] ?? ($sparePart->price ?? 0);

            $baseAmount = $sparePart->amount ?? $orderItem->price;
            $orderItem->spare_price = $baseAmount;
            $orderItem->spare_total_price = $baseAmount * $orderItem->quantity;
            $orderItem->spare_tax = $sparePart->tax_percentage ?? 0;
            $orderItem->spare_tax_type = $sparePart->tax_type ?? null;
            $orderItem->spare_tax_price = (($baseAmount * $orderItem->quantity) * ($sparePart->tax_percentage ?? 0)) / 100;
            $orderItem->total_amount = $orderItem->price * $orderItem->quantity;

            $orderItem->category = $row['category'];
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }

        if ($order->is_confim == 1) {
            $vendorIds = \App\Models\OrderItem::where('order_id', $order->id)
                ->pluck('user_id')
                ->unique()
                ->filter();
            foreach ($vendorIds as $vendorId) {
                \App\Models\Notification::create([
                    'user_id' => $vendorId,
                    'order_id' => $order->id,
                    'title'   => '🛒 New Order Received',
                    'message' => "Workshop has placed a new order (Order #{$order->id}). Please review the order items and accept or decline them.",
                    'sound'   => 'order.mp3',
                ]);
            }
        }

        $this->storePurchase();
    }

    public function storePurchase()
    {
        $purchaseTotal = array_sum(array_map(function($row) {
            return ($row['quantity_purchase'] ?? 1) * ($row['price_purchase'] ?? 0);
        }, $this->rows));

        $order = new Order;
        $order->order_date = now();
        $order->total_amount = $purchaseTotal;
        $order->total_quantity = array_sum(array_column($this->rows, 'quantity_purchase'));
        $order->total_item = count($this->rows);
        $order->workshop_id = Auth::guard('workshop')->user()->id;
        $order->payment_id = 1;
        $order->payment_status = 0;
        $order->jobcard_id = $this->jobId;
        $order->is_confim = $this->shouldPublishJobCardOrders() ? 1 : 0;
        $order->save();
        $mergedData = [];
        foreach ($this->rows as $row) {
            $sparePart = SparePart::find($row['item']);
            if (!$sparePart) continue;

            $userId = $sparePart->user_id;

            $orderItem = new OrderItem;
            $orderItem->spare_part_id = $row['item'];
            $orderItem->user_id = $userId;
            $orderItem->quantity = $row['quantity_purchase'];
            $orderItem->price = $row['price_purchase'] ?? ($sparePart->price ?? 0);

            $baseAmount = $sparePart->amount ?? $orderItem->price;
            $orderItem->spare_price = $baseAmount;
            $orderItem->spare_total_price = $baseAmount * $orderItem->quantity;
            $orderItem->spare_tax = $sparePart->tax_percentage ?? 0;
            $orderItem->spare_tax_type = $sparePart->tax_type ?? null;
            $orderItem->spare_tax_price = (($baseAmount * $orderItem->quantity) * ($sparePart->tax_percentage ?? 0)) / 100;
            $orderItem->total_amount = $orderItem->price * $orderItem->quantity;

            $orderItem->category = $row['category'];
            $orderItem->order_id = $order->id;
            $order->payment_status = 0;
            $orderItem->save();

            $items_purchase = $sparePart;

            $data = [
                'id' => $items_purchase->label_id,
                'part_name' => ($items_purchase->label?->title ?? 'Unknown(title is not available)') . ' (Current Stock: ' . ($row['quantity_purchase'] ?? 1) . ')',

                'quantity' => $row['quantity_purchase'] ?? 1,
                // Selling price (unit) for billing
                'unit_price' => $row['selling_price'] ?? ($items_purchase->price ?? 0),
                // Track purchase price separately for display
                'purchase_price' => $row['price_purchase'] ?? ($items_purchase->price ?? 0),
                'tax_type' => $items_purchase->tax_type ?? null,
                'tax_percentage' => $items_purchase->tax_percentage ?? null,
                'total_amount' => ($row['selling_price'] ?? ($items_purchase->price ?? 0)) * ($row['quantity_purchase'] ?? 1),
                'discount' => 0,
                'final_amount' => ($row['selling_price'] ?? ($items_purchase->price ?? 0)) * ($row['quantity_purchase'] ?? 1),
            ];


            switch ($row['category']) {
                case 2:
                    $this->spareParts[] = $data;
                    break;
                case 4:
                    $this->lubes[] = $data;
                    break;
                case 1:
                    $this->accessoriess[] = $data;
                    break;
                default:
                    break;
            }


            $this->calculateTotals();
        }
 
        if ($order->is_confim == 1) {
            $vendorIds = \App\Models\OrderItem::where('order_id', $order->id)
                ->pluck('user_id')
                ->unique()
                ->filter();
            foreach ($vendorIds as $vendorId) {
                \App\Models\Notification::create([
                    'user_id' => $vendorId,
                    'order_id' => $order->id,
                    'title'   => '🛒 New Order Received',
                    'message' => "Workshop has placed a new order (Order #{$order->id}). Please review the order items and accept or decline them.",
                    'sound'   => 'order.mp3',
                ]);
            }
        }



        // Reset the form or display success message
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => "Purchase Order submitted successfully!",
        ]);

        foreach ($this->rows as $index => $row) {
            $this->rows[$index]['item'] = null;
            $this->rows[$index]['quantity_purchase'] = null;
            $this->rows[$index]['price_purchase'] = null;
            $this->rows[$index]['total_price_purchase'] = null;
            $this->rows[$index]['category'] = null;
        }


        $this->showPurchase = false;
    }
    public function storestock()
    {
        $this->validate([
            'stock_itemName' => 'required',
            // 'stock_brand_name' => 'required',
            'stock_sellPrice' => 'required|numeric',
            'stock_buy_price' => 'required|numeric',
            'stock_quantity'=> 'required|numeric',
            // 'stock_hsn_code'=> 'required',
            // 'stock_rack_no'=> 'required',
            'stock_unit'=> 'required',
            'stock_category'=> 'required',
            'stock_tax_type'=> 'required',
            'stock_tax_percentage'=> 'required|numeric',
        ],[
            'stock_itemName.required' => 'Stock Item Name is required',
            'stock_brand_name.required' => 'Brand Name is required',
            'stock_sellPrice.required' => 'Selling Price is required',
            'stock_buy_price.required' => 'Buying Price is required',
            'stock_quantity.required' => 'Quantity is required',
            'stock_hsn_code.required' => 'HSN Code is required',
            'stock_rack_no.required' => 'Rack No is required',
            'stock_unit.required' => 'Unit is required',
            'stock_category.required' => 'Category is required',
            'stock_sellPrice.numeric' => 'Selling Price must be a number',
            'stock_buy_price.numeric' => 'Buying Price must be a number',
            'stock_quantity.numeric' => 'Quantity must be a number',
            'stock_tax_percentage.numeric' => 'Tax Percentage must be a number',
            'stock_tax_type.required' => 'Tax Type is required',

        ]);

        $categoryType = 0;
        if($this->showTable == 2){
            $categoryType = 2;
        }elseif ($this->showTable == 3){
            $categoryType = 4;
        }elseif ($this->showTable == 5){
            $categoryType = 1;
        }

        $sparePartLabel = SparePartLabel::firstOrCreate(
            [
                'title' => $this->stock_itemName,
                'spare_part_type' =>$categoryType
            ]
        );

        $productStock = ProductStock::where([
            'user_id' => Auth::guard('workshop')->user()->id,
            'label_id' => $sparePartLabel->id,
            'price' => $this->stock_sellPrice,
            'category_id' => $categoryType
        ])->first();

        $sellingAmount = floatval($this->stock_sellPrice);
        $taxPercentage = floatval($this->stock_tax_percentage);
        if ($this->stock_tax_type == 'include' && $taxPercentage) {
            $includedPrice = $sellingAmount / ($taxPercentage / 100 + 1);
            $price = round($includedPrice);
        } elseif ($this->stock_tax_type == 'exclude' && $taxPercentage) {
            $tax = ($sellingAmount * $taxPercentage) / 100;
            $price = $sellingAmount + $tax;
        } else {
            $price = $sellingAmount;
        }
        if ($productStock) {
            $productStock->stock += $this->stock_quantity;
            $productStock->save();
        } else {
            $productStock = new ProductStock;
            $productStock->user_id = Auth::guard('workshop')->user()->id;
            $productStock->label_id = $sparePartLabel->id;
            $productStock->category_id = $categoryType;
            $productStock->buy_price =$this->stock_buy_price;
            // $productStock->price =$price;
            $productStock->price =$sellingAmount;
            $productStock->stock = $this->stock_quantity;
            $productStock->brand = $this->stock_brand_name;
            $productStock->hsn_code = $this->stock_hsn_code;
            $productStock->rack_no = $this->stock_rack_no;
             $productStock->part_number = $this->stock_part_number;
              $productStock->self_stock = 1;
            if($this->showTable == 5){
            $productStock->part_number = $this->stock_part_number;
            }
            $productStock->categories_id = $this->stock_category; // Assuming this is the correct field name
            $productStock->unit_id = $this->stock_unit;
            $productStock->forAllVehicles = $this->forAllVehicles ? 1 : 0;
            $productStock->tax_percentage = $this->stock_tax_percentage;
            $productStock->tax_type = $this->stock_tax_type;
            if($this->showTable == 2){
                $productStock->sp_type = $this->stock_sp_type;
            }
            $productStock->save();
        }

        if ($this->forAllVehicles) {
            $suitableForData = Modification::where('status', 1)->pluck('id')->toArray();
        } else {
            $suitableForData = $this->suitable_for;
        }

        foreach ($suitableForData as $sutaiblefor) {
            SparePartVehicleModification::create([
                'spare_part_id' => $productStock->id,
                'vehicle_modification_id' => $sutaiblefor
            ]);
        }

        $data = [
            'id' => $sparePartLabel->id,
            'part_name' => $sparePartLabel->title . ' (Current Stock: ' .  $productStock->stock . ')',
            'quantity' => 1,
            'unit_price' =>$productStock->price,
            'purchase_price' => $productStock->buy_price,
            'tax_type' => $productStock->tax_type ?? null,
            'tax_percentage' => $productStock->tax_percentage ?? null,
            'total_amount' => $productStock->price * 1,
            'discount' => 0,
            'final_amount' => $productStock->price * 1,
        ];

        switch ($categoryType) {
            case 2:
                $this->spareParts[] = $data;
                break;
            case 4:
                $this->lubes[] = $data;
                break;
            case 1:
                $this->accessoriess[] = $data;
                break;
            default:
                break;
        }

        $dataList = [
            'label_id' => $productStock->label_id,
            'label_name' => @$productStock->label->title,
            'cat_type' => $productStock->category_id,
            'product_stock_id' => @$productStock->id,
            'stock' => @$productStock->stock,
            'price' => @$productStock->price,
        ];

        switch ($productStock->category_id) {
            case 1:
                $this->accessory[] = $dataList;
                break;
            case 2:
                $this->spare[] = $dataList;
                break;
            case 3:
                $this->tool[] = $dataList;
                break;
            case 4:
                $this->lube[] = $dataList;
                break;

            default:
                break;
        }


        $this->calculateTotals();

        $this->reset('stock_itemName', 'stock_brand_name', 'stock_sellPrice', 'stock_buy_price', 'stock_quantity', 'stock_hsn_code','stock_part_number', 'stock_rack_no', 'stock_unit', 'stock_category', 'stock_part_number', 'forAllVehicles', 'suitable_for','stock_tax_percentage','stock_tax_type');
        $this->resetErrorBag();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => "Stock Updated Successfully",
        ]);

        $this->showstock = false;
        $this->loadWorkshopStockDropdowns();
    }

    public function updatedVehicleId($value): void
    {
        if ($this->jobcardData) {
            $this->jobcardData->modification_id = Vehicle::where('id', $value)->value('modification_id');
        }
        $this->loadWorkshopStockDropdowns();
    }

    public function render()
    {

        $vehicle_data = Vehicle::where('id', $this->vehicle_id)->first();

        $countries = Country::all();
        $this->labourCharges = LabourCharge::where('user_id', $this->workshopId)->get();
        // Ensure UI always reflects live values from SparePart/ProductStock each render
        $this->hydrateLineItemMeta();
        return view('livewire.workshop.jobcard.edit', compact('countries', 'vehicle_data'));
    }



    public function updated($propertyName)
    {
        // dd($propertyName);
        if (strpos($propertyName, 'spareParts') !== false) {
            $this->recalculateSpareParts();
        }

        if (strpos($propertyName, 'lubes') !== false) {
            $this->recalculateLubes();
        }

        if (strpos($propertyName, 'accessoriess') !== false) {
            $this->recalculateAccessories();
        }

        // if (strpos($propertyName, 'extraCharges') !== false) {
        //     $this->recalculateExtraCharges();
        // }

        $this->resetErrorBag();
    }

    // public function recalculateSpareParts()
    // {
    //     foreach ($this->spareParts as $index => $part) {
    //         $quantity = max(0, (int) ($part['quantity'] ?? 0));
    //         $unitPrice = max(0, (float) ($part['unit_price'] ?? 0));
    //         $discount = max(0, (float) ($part['discount'] ?? 0));

    //         $total = $quantity * $unitPrice;
    //         $final = (float) ($total ?? 0) - (float) ($discount ?? 0);

    //         $this->spareParts[$index]['total_amount'] = $total;
    //         $this->spareParts[$index]['final_amount'] = $final;
    //         $this->calculateTotals();
    //     }
    // }

    public function recalculateSpareParts()
{
    foreach ($this->spareParts as $index => $part) {
        $quantity = max(0, (int) ($part['quantity'] ?? 0));
        $unitPrice = max(0, (float) ($part['unit_price'] ?? 0));
        $discount = max(0, (float) ($part['discount'] ?? 0));
        $discountType = $part['discount_type'] ?? 'fixed';

        $total = $quantity * $unitPrice;
        $discountAmount = 0;

        if ($discountType === 'percent') {
            $discountAmount = ($total * $discount) / 100;
        } else {
            $discountAmount = $discount;
        }

        $final = max(0, $total - $discountAmount);

        $taxType = $part['tax_type'] ?? 'exclude';
        $taxRate = (float)($part['tax_percentage'] ?? 0);
        $taxAmt = 0;
        if ($taxType == 'exclude' && $taxRate > 0) {
            $taxAmt = ($final * $taxRate) / 100;
        }

        $this->spareParts[$index]['total_amount'] = round($total, 2);
        $this->spareParts[$index]['final_amount'] = round($final + $taxAmt, 2);
    }

    $this->calculateTotals();
}


    // public function recalculateLubes()
    // {
    //     foreach ($this->lubes as $index => $lube) {
    //         $quantity = $lube['quantity'] ?? 0;
    //         $unitPrice = $lube['unit_price'] ?? 0;
    //         $discount = $lube['discount'] ?? 0;

    //         $total = $quantity * $unitPrice;
    //         $final = $total - $discount;

    //         $this->lubes[$index]['total_amount'] = $total;
    //         $this->lubes[$index]['final_amount'] = $final;
    //         $this->calculateTotals();
    //     }
    // }

  public function recalculateLubes()
{
    foreach ($this->lubes as $index => $lube) {
        $quantity = $lube['quantity'] ?? 0;
        $unitPrice = $lube['unit_price'] ?? 0;
        $discount = $lube['discount'] ?? 0;
        $discountType = $lube['discount_type'] ?? 'fixed';

        $total = $quantity * $unitPrice;

        if ($discountType === 'percent') {
            $discountAmount = ($total * $discount) / 100;
        } else {
            $discountAmount = $discount;
        }

        $final = $total - $discountAmount;

        $this->lubes[$index]['total_amount'] = round($total, 2);
        $this->lubes[$index]['final_amount'] = round(max($final, 0), 2);
    }

    $this->calculateTotals(); // Optional: Recalculate overall totals if needed
}



    // public function recalculateAccessories()
    // {
    //     foreach ($this->accessoriess as $index => $accessory) {
    //         $quantity = $accessory['quantity'] ?? 0;
    //         $unitPrice = $accessory['unit_price'] ?? 0;
    //         $discount = $accessory['discount'] ?? 0;

    //         $total = $quantity * $unitPrice;
    //         $final = $total - $discount;

    //         $this->accessoriess[$index]['total_amount'] = $total;
    //         $this->accessoriess[$index]['final_amount'] = $final;
    //         $this->calculateTotals();
    //     }
    // }

public function recalculateAccessories()
{
    foreach ($this->accessoriess as $index => $accessory) {
        $quantity = $accessory['quantity'] ?? 0;
        $unitPrice = $accessory['unit_price'] ?? 0;
        $discount = $accessory['discount'] ?? 0;
        $discountType = $accessory['discount_type'] ?? 'fixed';

        $total = $quantity * $unitPrice;

        if ($discountType === 'percent') {
            $discountAmount = ($total * $discount) / 100;
        } else {
            $discountAmount = $discount;
        }

        $final = $total - $discountAmount;

        $this->accessoriess[$index]['total_amount'] = round($total, 2);
        $this->accessoriess[$index]['final_amount'] = round(max($final, 0), 2);
    }

    $this->calculateTotals();
}


public function recalculateExtraCharges()
{
    $subtotal = 0;

    foreach ($this->extraCharges as $index => $extracharges) {
        $qty = isset($extracharges['qty']) ? (int) $extracharges['qty'] : 1;
        $amount = isset($extracharges['amount']) ? (float) $extracharges['amount'] : 0;
        $gstPercentage = isset($extracharges['gst_percentage']) ? (float) $extracharges['gst_percentage'] : 0;
        $gstType = $extracharges['gst_type'] ?? 'exclude';

        $baseTotal = $qty * $amount;
        $gstAmount = 0;
        $finalAmount = 0;

        if ($gstType === 'exclude' && $gstPercentage > 0) {
            // GST Exclude: GST is added to base amount
            $gstAmount = ($baseTotal * $gstPercentage) / 100;
            $finalAmount = $baseTotal + $gstAmount;
        } elseif ($gstType === 'include' && $gstPercentage > 0) {
            // GST Include: GST is already included in the amount, extract GST
            // $gstAmount = ($baseTotal * $gstPercentage) / (100 + $gstPercentage);
            $gstAmount = ($baseTotal * $gstPercentage) / 100;
            $finalAmount = $baseTotal; // Amount already includes GST
        } else {
            // No GST
            $finalAmount = $baseTotal;
        }

        // Calculate Cost Amount (GST amount) - This should show the GST amount
        $this->extraCharges[$index]['cost_amount'] = round($gstAmount, 2);

        // Calculate Product Cost based on GST type
        if ($gstType === 'include') {
            // If GST is included: Product Cost = Selling Price - Cost Amount (GST)
            // $this->extraCharges[$index]['product_cost'] = round($finalAmount - $gstAmount, 2);
            $this->extraCharges[$index]['product_cost'] = round($baseTotal - $gstAmount, 2);
        } else {
            // If GST is excluded: Product Cost = Selling Price + Cost Amount (GST)
            // $this->extraCharges[$index]['product_cost'] = round($finalAmount + $gstAmount, 2);
            // $this->extraCharges[$index]['product_cost'] = round($baseTotal + $gstAmount, 2);
            $this->extraCharges[$index]['product_cost'] = round($baseTotal, 2);
        }

        // ✅ Charge now reflects the full row amount (qty * rate + GST)
        $this->extraCharges[$index]['charge'] = round($finalAmount, 2);

        // ✅ Also store base and final separately
        $this->extraCharges[$index]['total_amount'] = round($baseTotal, 2);      // Without GST
        $this->extraCharges[$index]['final_amount'] = round($finalAmount, 2);    // With GST

        $subtotal += $finalAmount;
    }

    $this->subtotal = round($subtotal, 2);
}




    //jobcardtotalcards
    public function calculateTotals()
{
    $this->recalculateExtraCharges();

    // Ensure purchase/tax meta is present on all item arrays (handles post-status changes)
    $this->hydrateLineItemMeta();

    $this->totalAmount = 0;
    $this->final_amount = 0;

    foreach ($this->spareParts as $part) {
        $this->final_amount += (float) ($part['final_amount'] ?? 0);
    }

    foreach ($this->lubes as $lube) {
        $this->final_amount += (float) ($lube['final_amount'] ?? 0);
    }

    foreach ($this->accessoriess as $accessory) {
        $this->final_amount += (float) ($accessory['final_amount'] ?? 0);
    }

    foreach ($this->extraCharges as $charge) {
        $this->final_amount += (float) ($charge['final_amount'] ?? 0);
    }

    // Keep totalAmount aligned with the visible category totals (final amounts)
    $this->totalAmount = $this->final_amount;
    $final = max(0, $this->final_amount);
    $advance = max(0, (float) ($this->advance ?? 0));

    $this->hidden_balance_amount = max(0, $final - $advance);
    $this->balance_amount = max(0, $final - $advance);

    $this->final_paid = 0;
    $this->final_discount = 0;

}


    public function updatedAdvance($value)
    {
        $this->calculateTotals();
    }


    public function updatedFinalDiscount($value)
    {
        // dd($this->final_amount);
        $hidden_balance_amount = max(0, (float) ($this->hidden_balance_amount ?? 0));
        $value = max(0, (float) ($value ?? 0));

        $this->balance_amount = max(0, $hidden_balance_amount - $value);
        $this->final_paid = 0;
    }

    public function updatedFinalPaid($value)
    {
        $hidden_balance_amount = max(0, (float) ($this->hidden_balance_amount ?? 0));
        $value = max(0, (float) ($value ?? 0));
        $discount = max(0, (float) ($this->final_discount ?? 0));

        $this->balance_amount = max(0, $hidden_balance_amount - $discount - $value);

    }


public function updatedSparePartsData($id)
{
    $price = $this->spare_parts_price;

    $labels = SparePartLabel::with([
        'productStocks' => function ($qry) use ($price) {
            $qry->where('price', $price);
        }
    ])->find($id);

    $defaultRow = [
        'id' => $id,
        'quantity' => 1,
        'unit_price' => $price,
        'purchase_price' => 0,
        'tax_type' => null,
        'tax_percentage' => null,
        'discount' => 0,
        'discount_type' => 'fixed', // default is fixed
    ];

    if (empty($labels->productStocks->toArray()) || $labels->productStocks[0]->stock <= 0) {
        $this->dispatch('swal:toast', [
            'type' => 'error',
            'message' => 'This part is out of stock!',
        ]);
        $this->spare_parts_data = "";
        return;
    }

    $stock = $labels->productStocks[0];
    $defaultRow['part_name'] = $labels->title . ' (Current Stock: ' . $stock->stock . ')';
    $defaultRow['purchase_price'] = $stock->buy_price ?? 0;
    $defaultRow['tax_type'] = $stock->tax_type ?? null;
    $defaultRow['tax_percentage'] = $stock->tax_percentage ?? null;

    $total = $defaultRow['quantity'] * $defaultRow['unit_price'];
    $discount = 0;

    if ($defaultRow['discount_type'] === 'percent') {
        $discount = ($total * $defaultRow['discount']) / 100;
    } else {
        $discount = $defaultRow['discount']; // since it's fixed
    }

    $final = $total - $discount;

    $taxType = $defaultRow['tax_type'] ?? 'exclude';
    $taxRate = (float)($defaultRow['tax_percentage'] ?? 0);
    $taxAmt = 0;
    if ($taxType == 'exclude' && $taxRate > 0) {
        $taxAmt = ($final * $taxRate) / 100;
    }

    $defaultRow['total_amount'] = round($total, 2);
    $defaultRow['final_amount'] = round(max($final + $taxAmt, 0), 2);

    $this->spareParts[] = $defaultRow;

    $this->dispatch('swal:toast', [
        'type' => 'success',
        'message' => 'Spare Part Row added Successfully!',
    ]);

    $this->calculateTotals();
}



public function updatedLubesData($id)
{
    $price = $this->lubes_data_price;

    $labels = SparePartLabel::with([
        'productStocks' => function ($qry) use ($price) {
            $qry->where('price', $price);
        }
    ])->find($id);

    $defaultRow = [
        'id' => $id,
        'quantity' => 1,
        'unit_price' => $price,
        'purchase_price' => 0,
        'tax_type' => null,
        'tax_percentage' => null,
        'discount' => 0,
        'discount_type' => 'fixed', // default discount type
    ];

    if (empty($labels->productStocks->toArray()) || $labels->productStocks[0]->stock <= 0) {
        $this->dispatch('swal:toast', [
            'type' => 'error',
            'message' => 'This lube is out of stock!',
        ]);
        $this->lubes_data = "";
        return;
    }

    $stock = $labels->productStocks[0];
    $defaultRow['part_name'] = $labels->title . ' (Current Stock: ' . $stock->stock . ')';
    $defaultRow['purchase_price'] = $stock->buy_price ?? 0;
    $defaultRow['tax_type'] = $stock->tax_type ?? null;
    $defaultRow['tax_percentage'] = $stock->tax_percentage ?? null;

    // Calculate total and final amount based on discount type
    $total = $defaultRow['quantity'] * $defaultRow['unit_price'];
    $discount = 0;

    if ($defaultRow['discount_type'] === 'percent') {
        $discount = ($total * $defaultRow['discount']) / 100;
    } else {
        $discount = $defaultRow['discount']; // fixed discount
    }

    $final = $total - $discount;

    $defaultRow['total_amount'] = round($total, 2);
    $defaultRow['final_amount'] = round(max($final, 0), 2);

    $this->lubes[] = $defaultRow;

    $this->dispatch('swal:toast', [
        'type' => 'success',
        'message' => 'Lubes Row added Successfully!',
    ]);

    $this->lubes_data = "";
    $this->calculateTotals();
}


public function updatedAccessoryData($id)
{
    $price = $this->accessory_data_price;

    $labels = SparePartLabel::with([
        'productStocks' => function ($qry) use ($price) {
            $qry->where('price', $price);
        }
    ])->find($id);

    $defaultRow = [
        'id' => $id,
        'quantity' => 1,
        'unit_price' => $price,
        'purchase_price' => 0,
        'tax_type' => null,
        'tax_percentage' => null,
        'discount' => 0,
        'discount_type' => 'fixed', // default discount type
    ];

    if (empty($labels->productStocks->toArray()) || $labels->productStocks[0]->stock <= 0) {
        $this->dispatch('swal:toast', [
            'type' => 'error',
            'message' => 'This accessory is out of stock!',
        ]);
        $this->accessory_data = "";
        return;
    }

    $stock = $labels->productStocks[0];
    $defaultRow['part_name'] = $labels->title . ' (Current Stock: ' . $stock->stock . ')';
    $defaultRow['purchase_price'] = $stock->buy_price ?? 0;
    $defaultRow['tax_type'] = $stock->tax_type ?? null;
    $defaultRow['tax_percentage'] = $stock->tax_percentage ?? null;

    // Calculate totals
    $total = $defaultRow['quantity'] * $defaultRow['unit_price'];

    if ($defaultRow['discount_type'] === 'percent') {
        $discount = ($total * $defaultRow['discount']) / 100;
    } else {
        $discount = $defaultRow['discount'];
    }

    $final = $total - $discount;

    $defaultRow['total_amount'] = round($total, 2);
    $defaultRow['final_amount'] = round(max($final, 0), 2);

    $this->accessoriess[] = $defaultRow;

    $this->dispatch('swal:toast', [
        'type' => 'success',
        'message' => 'Accessory Row added Successfully!',
    ]);

    $this->calculateTotals();
}


    public function updatedExtraChargesDropdown($id)
    {
        $labels = LabourCharge::where('id', $id)
            ->first();
        if ($labels) {
            $qty = 1;
            $amount = $labels->price;
            $gstPercentage = $labels->gst ?? 0;
            $gstType = $labels->gst_type ?? 'exclude';

            $baseTotal = $qty * $amount;
            $gstAmount = 0;
            $finalAmount = 0;

            if ($gstType === 'exclude' && $gstPercentage > 0) {
                // GST Exclude: GST is added to base amount
                $gstAmount = ($baseTotal * $gstPercentage) / 100;
                $finalAmount = $baseTotal + $gstAmount;
            } elseif ($gstType === 'include' && $gstPercentage > 0) {
                // GST Include: GST is already included in the amount, extract GST
                $gstAmount = ($baseTotal * $gstPercentage) / (100 + $gstPercentage);
                $finalAmount = $baseTotal; // Amount already includes GST
            } else {
                // No GST
                $finalAmount = $baseTotal;
            }

            // Calculate Cost Amount (GST amount) - This should show the GST amount
            $costAmount = round($gstAmount, 2);

            // Calculate Product Cost based on GST type
            if ($gstType === 'include') {
                // If GST is included: Product Cost = Selling Price - Cost Amount (GST)
                // $productCost = round($finalAmount - $gstAmount, 2);
                $productCost = round($baseTotal - $gstAmount, 2);
            } else {
                // If GST is excluded: Product Cost = Selling Price + Cost Amount (GST)
                //$productCost = round($finalAmount + $gstAmount, 2);
                $productCost = round($baseTotal + $gstAmount, 2);
            }

            $this->extraCharges[] = [
                'label' => $labels->title,
                // 'charge' => number_format($labels->total, 2),
                // 'charge' => number_format((float) $labels->total, 2),
                 'charge' => (float) $labels->total,
                'amount' => $labels->price,
                'gst_type' => $labels->gst_type,
                'gst_percentage' => $labels->gst,
                // 'charge_type' => 1,
                'mechanic_id' => '',
                 'labour_type' => $labels->labour_type, // <-- must be set
    'charge_type' => $labels->labour_type === 'outsource' ? 2 : 1,      // ✅ added
            'outsource_price' => $labels->outsource_price,
            'qty' => 1,
            'cost_amount' => $costAmount,
            'product_cost' => $productCost,
            ];

            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Labour Charge added Succesfully!',
            ]);
        } else {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'something went wrong! Please try again.',
            ]);
            return;
        }

        $this->reset('extra_charges');

        $this->calculateTotals();
    }

    public function addExtraChargeRowEmpty()
    {
        $this->showLabourCharge = true;
    }

    public function addSparePartRows()
    {
        $this->isPurchase = false;
        $this->showPurchase = true;
        $this->reset('rows', 'totalPricePurchase');
        switch ($this->showTable) {
            case 5:
                $category = 1;
                break;
            case 3:
                $category = 4;
                break;
            case 2:
                $category = 2;
                break;
            default:
                $category = '';
                break;
        }

        $this->rows[] = [
            'category' => $category,
            'item' => '',
            'quantity' => 0,
            'price' => 0,
            'total_price' => 0,
        ];

        if ($category) {
            $this->getItemPurchase(0);
        }
    }

    public function addStockRows()
    {
        $this->resetErrorBag();
        $this->showPurchase = false;
        $this->isPurchase = false;
        $this->showstock = true;
        $this->units = Unit::all();
        $this->categories = Category::all();
        $this->modifications = Modification::where('status', 1)->get();
        $this->reset('stock_itemName', 'stock_brand_name', 'stock_sellPrice', 'stock_buy_price', 'stock_quantity', 'stock_hsn_code', 'stock_rack_no', 'stock_unit', 'stock_category', 'stock_part_number', 'forAllVehicles', 'suitable_for', 'stock_tax_percentage', 'stock_tax_type');
    }

    public function updatedForAllVehicles($value)
    {
        if ($value == true) {
            $this->suitable_for = [];
            $this->forAllVehicles = true;
        } else {
            $this->forAllVehicles = false;
        }
    }

    public function addRowStock()
    {

        $this->rows[] = [
            'category' => '',
            'item' => '',
            'quantity' => 1,
            'price' => 10,
        ];
    }
    public function addRow()
    {
        switch ($this->showTable) {
            case 5:
                $category = 1;
                break;
            case 3:
                $category = 4;
                break;
            case 2:
                $category = 2;
                break;
            default:
                $category = '';
                break;
        }

        $this->rows[] = [
            'category' => $category,
            'item' => '',
            'quantity' => 0,
            'price' => 0,
            'total_price' => 0,
        ];

        if ($category) {
            $this->getItemPurchase(count($this->rows) - 1);
        }
    }
    public function removepurchase($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Reindex the array
    }


    public function storeOrder()
    {
        // $this->validate();
        // Save logic here
        session()->flash('message', 'Vehicle successfully saved.');
        $this->reset(['rows', 'showPurchase']);
        $this->addRow();
    }


    // Remove row
    public function removeRow($type, $index)
    {
        if ($type == 'extraCharges' && isset($this->extraCharges[$index])) {
            unset($this->extraCharges[$index]);
        } elseif ($type == 'spareParts' && isset($this->spareParts[$index])) {
            unset($this->spareParts[$index]);
        } elseif ($type == 'lubes' && isset($this->lubes[$index])) {
            unset($this->lubes[$index]);
        } elseif ($type == 'tools' && isset($this->tools[$index])) {
            unset($this->tools[$index]);
        } elseif ($type == 'accessoriess' && isset($this->accessoriess[$index])) {
            unset($this->accessoriess[$index]);
        }

        $this->calculateTotals();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Row Removed Successfully!',
        ]);
    }




    public function calculatePendingAmount()
    {
        $this->pendingAmount = $this->totalAmount - $this->advance;
    }
    public function toggleTable($value1)
    {
        // dd($value1);
        $this->showTable = $value1;
    }



    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;

        $this->supervisors = WorkShopVendor::where('type', 2)->get();
    }

    public function addCustomer()
    {
        $this->add = false;
        $this->showModal = true;
    }

    public function addVehical()
    {
        if (empty($this->customer_name)) {

            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Please select customer!']);
            $this->isEdits = false;
            $this->vehicleDetails = false;
        } else {
            $this->vehical_types = VehicleType::where('soft_delete', '=', 0)->get();
            $this->fuel_types = Fueltype::where('soft_delete', '=', 0)->get();
            $this->isEdits = false;
            $this->vehicleDetails = true;
        }
    }


    public function addAccessorie()
    {
        $accessoriesVoices = JobCardsInspection::where('jobcard_number', $this->jobcardData->jobcard_number)
            ->where('is_customer_voice', 2)
            ->get();

        $this->accessoriesVoices = [];

        if (!empty($accessoriesVoices->toArray())) {
            foreach ($accessoriesVoices as $value) {
                $this->accessoriesVoices[] = $value->customer_voice;
            }
        }

        if (empty($this->accessoriesVoices)) {
            $this->accessoriesVoices[] = '';
        }

        // echo "<pre>"; print_r($this->accessoriesVoices); die;

        $this->addAccessoriesVoice = false;
        $this->showAccessoriesVoice = true;
    }


    public function addWork()
    {
        // $workVoices = JobCardsInspection::where('jobcard_number', $this->jobcardData->jobcard_number)->where('is_customer_voice', 0)->get();

        // $this->workVoices = [];
        // foreach ($workVoices as $key => $value) {
        //     $this->workVoices[] = $value->customer_voice;
        // }

        // if (empty($this->workVoices)) {
        //     $this->workVoices[] = '';
        // }
        $this->addWorkNote = false;
        $this->showWorkNote = true;
    }

    public function addVoice()
    {

        $this->customerVoices = JobCardsInspection::where('jobcard_number', $this->jobcardData->jobcard_number)
            ->where('is_customer_voice', 1)
            ->pluck('customer_voice')
            ->toArray();
        // $customerVoices = JobCardsInspection::where('jobcard_number', $this->jobcardData->jobcard_number)->where('is_customer_voice', 1)->get();
        // $this->customerVoices = [];
        // foreach ($customerVoices as $key => $value) {
        //     // $this->customerVoices[] = $value->customer_voice;
        //     $this->selectedItemsCustomerVoice[] = $value->customer_voice;
        // }
        $this->addCustomerVoice = false;
        $this->showCustomerVoice = true;
    }

    public function addImage()
    {

        $this->addphoto = false;
        $this->showPhoto = true;
    }

    public function addWorkField()
    {
        $this->showWorkNoteInput = true;
    }

    public function cancelworknewvoice()
    {
        $this->showWorkNoteInput = false;
        $this->workNotInpt = "";
    }

    public function removeWorkNotVoice($key)
    {
        if (isset($this->workVoices[$key])) {
            JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)->where('is_customer_voice', 0)->where('customer_voice', $this->workVoices[$key])->delete();
            unset($this->workVoices[$key]);
            $this->workVoices = array_values($this->workVoices);
            $this->fetchWorkNoteVoicesData();
            $cardInspirationCount = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)->where('is_customer_voice', 0)->count();
            $this->workNoteCount = $cardInspirationCount;
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Remove successfully']);
        } else {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => 'Ops somthing went to wrong']);
        }
    }

    public function addWorkNotInptVoice()
    {

        if (empty($this->workNotInpt)) {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => 'Wrok Not is required']);
            return;
        }
        $workshopData = JobCardsInspection::create([
            'jobcard_number' => $this->jobcardNumbers,
            'customer_voice' => $this->workNotInpt,
            'is_customer_voice' => 0,
            'user_id' => Auth::guard('workshop')->user()->id,
        ]);
        $workshopVoice[] = $workshopData->customer_voice;
        $this->workVoices = array_merge($workshopVoice, $this->workVoices);
        $this->workVoices = array_filter($this->workVoices, function ($value) {
            return !empty($value);
        });
        $this->workVoices = array_values($this->workVoices);

        $cardInspirationCountWorkNotes = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 0)
            ->count();
        $this->workNoteCount = $cardInspirationCountWorkNotes;

        $this->workNotInpt = "";
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Voice added successfully']);
    }


    public function removeWorkField($index)
    {
        unset($this->workVoices[$index]);
        $this->workVoices = array_values($this->workVoices); // Reindex array
    }

    public function addAccessorieField()
    {

        // $AccessoriesVoice = JobCardsInspection::where('jobcard_number', $this->jobcardData->jobcard_number)->where('is_customer_voice', 2)->get();
        // $this->accessoriesVoices = [];
        // foreach ($AccessoriesVoice as $key => $value) {
        //     // $this->customerVoices[] = $value->customer_voice;
        //     $this->selectedItemsAccessoriesVoice[] = $value->customer_voice;
        // }

        $this->showAccessoriesInput = true;
        $this->addAccessoriesVoice = false;
        $this->showAccessoriesVoice = true;
        // $this->accessoriesVoices[] = '';
    }

    public function cancelAccessoriesField()
    {
        $this->showAccessoriesInput = false;
        $this->accessoriesVoicesInput = '';
    }

    public function addAccessoriesInptVoice()
    {
        if (empty($this->accessoriesVoicesInput)) {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => 'Accessories is required']);
            return;
        }
        $accessoriesData = JobCardsInspection::create([
            'jobcard_number' => $this->jobcardNumbers,
            'customer_voice' => $this->accessoriesVoicesInput,
            'is_customer_voice' => 2,
            'user_id' => Auth::guard('workshop')->user()->id,
        ]);
        $accessories[] = $accessoriesData->customer_voice;
        $this->accessoriesVoices = array_merge($accessories, $this->accessoriesVoices);
        $this->accessoriesVoices = array_filter($this->accessoriesVoices, function ($value) {
            return !empty($value);
        });
        $this->accessoriesVoices = array_values($this->accessoriesVoices);

        $cardInspirationCountAccessaries = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 2)
            ->count();
        $this->accessariesCount = $cardInspirationCountAccessaries;

        $this->accessoriesVoicesInput = "";
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Accessories added successfully']);
    }

    public function removeAccessoriesVoice($key)
    {

        if (isset($this->accessoriesVoices[$key])) {
            JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)->where('is_customer_voice', 2)->where('customer_voice', $this->accessoriesVoices[$key])->delete();
            unset($this->accessoriesVoices[$key]);
            $this->accessoriesVoices = array_values($this->accessoriesVoices);
            $this->fetchAccessoryData();
            $cardInspirationCountAccessaries = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)->where('is_customer_voice', 2)->count();
            $this->accessariesCount = $cardInspirationCountAccessaries;
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Remove successfully']);
        } else {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => 'Ops somthing went to wrong']);
        }
    }

    public function updateSelectedItemsAccessoryVoice($value)
    {
        $selectedValue[] = $value;
        $this->accessoriesVoices = array_merge($selectedValue, $this->accessoriesVoices);
        $this->accessoriesVoices = array_filter($this->accessoriesVoices, function ($value) {
            return !empty($value);
        });
        $this->accessoriesVoices = array_unique(array_values($this->accessoriesVoices));

        JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 2)
            ->delete();
        foreach ($this->accessoriesVoices as $value) {

            JobCardsInspection::create([
                'jobcard_number' => $this->jobcardNumbers,
                'customer_voice' => $value,
                'is_customer_voice' => 2,
                'user_id' => Auth::guard('workshop')->user()->id,
            ]);
        }

        $cardInspirationCountAccessaries = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)->where('is_customer_voice', 2)->count();
        $this->accessariesCount = $cardInspirationCountAccessaries;
        $this->fetchAccessoryData();
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Accessories added successfully']);
    }

      public function updateSelectedItemsWorkNotesVoice($value){
        $selectedValue[] =  $value;
        $this->workVoices = array_merge($selectedValue, $this->workVoices);
            $this->workVoices = array_filter($this->workVoices, function($value) {
                return !empty($value);
            });
            $this->workVoices = array_unique(array_values($this->workVoices));

            JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
        ->where('is_customer_voice', 0)
        ->delete();
            foreach($this->workVoices as $value){

                JobCardsInspection::create([
                    'jobcard_number' => $this->jobcardNumbers,
                    'customer_voice' => $value,
                    'is_customer_voice' => 0,
                    'user_id' => Auth::guard('workshop')->user()->id,
                ]);
            }

            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Voice added successfully']);
            $cardInspirationCountWorkNotes = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 0)
            ->count();
           $this->workNoteCount = $cardInspirationCountWorkNotes;
            $this->fetchWorkNoteVoicesData();
    }

    public function removeAccessorieField($index)
    {
        unset($this->accessoriesVoices[$index]);
        $this->accessoriesVoices = array_values($this->accessoriesVoices); // Reindex array
    }

    public function addField()
    {
        $this->showCustomerVoiceInput = true;
    }
    public function cancelVoiceField()
    {
        $this->showCustomerVoiceInput = false;
        $this->customerVoiceInpt = "";
    }

    public function addCustomerInptVoice()
    {
        if (empty($this->customerVoiceInpt)) {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => 'Customer voice is required']);
            return;
        }
        $jobcarInspections = JobCardsInspection::create([
            'jobcard_number' => $this->jobcardNumbers,
            'customer_voice' => $this->customerVoiceInpt,
            'is_customer_voice' => 1,
            'user_id' => Auth::guard('workshop')->user()->id,
        ]);
        $customerVoice[] = $jobcarInspections->customer_voice;
        $this->customerVoices = array_merge($customerVoice, $this->customerVoices);
        $this->customerVoices = array_filter($this->customerVoices, function ($value) {
            return !empty($value);
        });
        $this->customerVoices = array_values($this->customerVoices);

        $cardInspirationCount = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 1)
            ->count();

        $this->customerVoiceCount = $cardInspirationCount;

        $this->customerVoiceInpt = "";
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Voice added successfully']);
    }

    public function removeCustomerVoice($key)
    {

        if (isset($this->customerVoices[$key])) {
            JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)->where('is_customer_voice', 1)->where('customer_voice', $this->customerVoices[$key])->delete();
            unset($this->customerVoices[$key]);
            $this->customerVoices = array_values($this->customerVoices);
            $this->fetchCustomerVoicesData();
            $cardInspirationCount = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)->where('is_customer_voice', 1)->count();
            $this->customerVoiceCount = $cardInspirationCount;
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Remove successfully']);
        } else {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => 'Ops somthing went to wrong']);
        }
    }

    public function updateSelectedItemsCustomerVoice($value)
    {
        $selectedValue[] = $value;
        $this->customerVoices = array_merge($selectedValue, $this->customerVoices);
        $this->customerVoices = array_filter($this->customerVoices, function ($value) {
            return !empty($value);
        });
        $this->customerVoices = array_unique(array_values($this->customerVoices));

        JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 1)
            ->delete();
        foreach ($this->customerVoices as $value) {

            JobCardsInspection::create([
                'jobcard_number' => $this->jobcardNumbers,
                'customer_voice' => $value,
                'is_customer_voice' => 1,
                'user_id' => Auth::guard('workshop')->user()->id,
            ]);
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Voice added successfully']);
        $cardInspirationCount = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 1)
            ->count();
        $this->customerVoiceCount = $cardInspirationCount;
        $this->fetchCustomerVoicesData();
    }

    public function removeField($index)
    {
        unset($this->customerVoices[$index]);
        $this->customerVoices = array_values($this->customerVoices); // Reindex array
    }

    public function stateData($countryId)
    {
        if ($countryId) {
            $this->states = State::where('country_id', $countryId)->get();
        } else {
            $this->states = [];
        }
    }

    public function cityData($stateId)
    {
        if ($stateId) {
            $this->cities = City::where('state_id', $stateId)->get();
        } else {
            $this->cities = [];
        }
    }
    public function addVehicalType()
    {

        $this->isVehical = false;
        $this->showVehical = true;
    }

    public function addBrandType()
    {
        $this->isBrand = false;
        $this->showBrand = true;
    }

    public function addModelType()
    {
        $this->isModel = false;
        $this->showModel = true;
    }

    public function addFuelType()
    {
        $this->isFuel = false;
        $this->showFuel = true;
    }
    public function downloadPdf()
    {
        $this->isDownload = false;
        $this->showDownload = true;
    }

    public function downloadPdfdata()
    {



        $valArr = [
            'pdftype' => ["required"],
        ];


        $customMessages = customErrorMsg();
        $this->validate($valArr, $customMessages);

        if ($this->pdftype === 'mechanic') {
            $this->showDownload = false;

            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Mechanic Sheet Download Succefully!',]);
            return redirect()->route('download.mechanic.sheet', [$this->jobcardData->id, 0]);
        } elseif ($this->pdftype === 'worksheet_estimate') {
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Work Estimate Download Succefully!',]);
            $this->showDownload = false;
            return redirect()->route('download.estimate.invoice', [$this->jobcardData->id, 0]);
        } elseif ($this->pdftype === 'invoice') {
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Invoice Download Succefully!',]);
            $this->showDownload = false;
            return redirect()->route('download.invoice', [$this->jobcardData->id, 0]);
        } else {
            $this->dispatch('error', 'Invalid selection.');
            $this->showDownload = false;
            return;
        }
    }


    public function viewPdfdata()
    {
        $valArr = [
            'viewtype' => ["required"],
        ];

        $customMessages = customErrorMsg();
        $this->validate($valArr, $customMessages);

        if (in_array($this->viewtype, ['mechanic', 'worksheet_estimate', 'invoice'])) {
            $routes = [
                'mechanic' => 'download.mechanic.sheet',
                'worksheet_estimate' => 'download.estimate.invoice',
                'invoice' => 'download.invoice',
            ];

            $url = route('pdf.view', [
                'url' => base64_encode(route($routes[$this->viewtype], [$this->jobcardData->id, 1]))
            ]);

            $this->dispatch('pdfPreiview', $url);
        } else {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'title' => 'Invalid selection.',
            ]);
        }
    }










    public function removeModelsType($index)
    {
        unset($this->modelTypes[$index]);
        $this->modelTypes = array_values($this->modelTypes);
    }

    public function printPdf()
    {
        $this->isPrint = false;
        $this->showPrint = true;
    }

    public function vehicleData($customerId)
    {
        if (!empty($customerId)) {
            $this->vehicles = $vehicledata = Vehicle::where('customer_id', $customerId)->get();

            $this->vehicledatacollection = Vehicle::where('customer_id', $customerId)->get()->toArray();
            if (empty($vehicledatacollection)) {
                $this->dispatch('swal:toast', [
                    'type' => 'info',
                    'message' => 'No vehicles found for this customer. Please add a vehicle.'
                ]);
            } else {
                $this->dispatch('swal:toast', [
                    'type' => 'success',
                    'message' => 'Vehicles found successfully.'
                ]);
            }
        } else {
            $this->vehicles = collect();
        }
    }




    public function addVehicleType()
    {

        $valArr = [
            'vehicleType' => ["required"],
        ];

        $this->validate($valArr);

        VehicleType::create([
            'vehicle_type' => $this->vehicleType,
        ]);

        $vehicleTypeData = VehicleType::where('soft_delete', 0)->get();

        $this->vehical_types = $vehicleTypeData;

        $this->vehicleType = '';

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicle type added successfully.',
        ]);

        $this->showVehical = false;
    }


    public function removeVehicleType($index)
    {
        $vehicleType = Vehicletype::find($index);
        $vehicleType->soft_delete = 1;
        if ($vehicleType->save()) {
            $this->vehical_types = Vehicletype::where('soft_delete', 0)->get();
            $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Vehicle type removed successfully.']);
        } else {
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Failed to remove the vehicle type.']);
        }
    }





    public function addBrandsType()
    {
        $valArr = [
            'brandType' => ["required"],
            'vehicle_type_id_data' => ["required"],
        ];

        $this->validate($valArr);

        Vehiclebrand::create([
            'vehicle_type_id' => $this->vehicle_type_id_data,
            'vehicle_brand' => $this->brandType,
        ]);

        $vehicleBrandData = Vehiclebrand::where('vehicle_type_id', $this->vehicle_type_id_data)->where('soft_delete', 0)->get();
        $this->vehical_brands = $vehicleBrandData;
        $this->brandType = '';
        $this->vehicle_type_id_data = '';

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicle Brand added successfully.',
        ]);

        $this->showBrand = false;
    }


    public function removeBrandsType($index)
    {
        $vehicleBrand = VehicleBrand::find($index);
        $vehicleBrand->soft_delete = 1;
        if ($vehicleBrand->save()) {
            $this->vehical_brands = VehicleBrand::where('vehicle_type_id', $this->vehicle_type_id_data)->where('soft_delete', 0)->get();
            $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Vehicle Brand removed successfully.']);
        } else {
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Failed to remove the vehicle Brand.']);
        }
    }

    public function storeVehicle()
    {

        $valArr = [
            'vehicle_type_id' => ["required"],
            'numberPlate' => ["required"],
            'vehicleBrand' => ["required"],
            'modelName' => ["required"],
            'fuel_id' => ["required"],
        ];

        $this->validate($valArr);

        $vehicle = new Vehicle();
        $vehicle->vehicletype_id = $this->vehicle_type_id;
        $vehicle->number_plate = $this->numberPlate;
        $vehicle->vehiclebrand_id = $this->vehicleBrand;
        $vehicle->chassisno = $this->chassisNo;
        $vehicle->modelname = $this->modelName;
        $vehicle->modelyear = $this->modelYear;
        $vehicle->fuel_id = $this->fuel_id;
        $vehicle->gearbox = $this->gearbox;
        $vehicle->gearboxno = $this->gearboxNo;
        $vehicle->engineno = $this->engineNo;
        $vehicle->engine = $this->engine;
        $vehicle->enginesize = $this->keyNo;
        $vehicle->customer_id = $this->customer_name;
        $vehicle->save();

        $this->vehicles = $vehicledata = Vehicle::where('customer_id', $this->customer_name)->get();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicles Added Successfully.'
        ]);
        $this->vehicleDetails = false;
    }



    public function addModelsType()
    {


        $valArr = [
            'modelType' => ["required"],
            'vehicle_brand_id_data' => ["required"],
        ];

        $this->validate($valArr);

        VehicleModel::create([
            'brand_id' => $this->vehicle_brand_id_data,
            'model_name' => $this->modelType,
        ]);

        $vehicleModelData = VehicleModel::where('brand_id', $this->vehicle_brand_id_data)->where('soft_delete', 0)->get();

        $this->vehical_models = $vehicleModelData;

        $this->brandType = '';
        $this->vehicle_brand_id_data = '';

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicle Model added successfully.',
        ]);

        $this->showModel = false;
    }



    public function addFuelsType()
    {
        $valArr = [
            'fuelType' => ["required"],
        ];

        $this->validate($valArr);

        Fueltype::create([
            'fuel_type' => $this->fuelType,
        ]);

        $vehicleFuelData = Fueltype::where('soft_delete', 0)->get();
        $this->fuel_types = $vehicleFuelData;

        $this->fuelType = '';

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Fuel type added successfully.',
        ]);

        $this->showFuel = false;
    }


    public function removeFuelsType($index)
    {
        $fielType = Fueltype::find($index);
        $fielType->soft_delete = 1;
        if ($fielType->save()) {
            $this->fuel_types = Fueltype::where('soft_delete', 0)->get();
            $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Fuel Type Removed successfully.']);
        } else {
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Failed to remove the Fuel Type.']);
        }
    }



    public function vehicleTypeAdd($vehicleTypeId)
    {


        if ($vehicleTypeId) {
            $this->vehical_brands = $vehicleBrands = Vehiclebrand::where('vehicle_type_id', $vehicleTypeId)->get();
            if (empty($vehicleBrands->toArray())) {
                $this->dispatch('swal:toast', ['type' => 'info', 'message' => 'No vehicles Brand found for this Vehicle Type. Please add a vehicle Brand.']);
            }
        } else {
            $this->vehical_brands = [];
        }
    }

    public function vehicleBrandAdd($brandId)
    {

        if ($brandId) {
            $this->vehical_models = $vehicleModel = VehicleModel::where('brand_id', $brandId)->get();
            if (empty($vehicleModel->toArray())) {
                $this->dispatch('swal:toast', ['type' => 'info', 'message' => 'No vehicles Model found for this Vehicle Brand. Please add a vehicle Model.']);
            }
        } else {
            $this->vehical_models = [];
        }
    }



    public function storeCustomer()
    {

        $valArr = [
            'name' => ["required"],
            'lastname' => ["required"],
            'mobile_no' => ["required", "digits:10"],
            'address' => ["required"],
            'country_id' => ["required"],
            'state_id' => ["required"],
            'city_id' => ["required"],
            // 'vehicle_type_id' => ["required"],
            'numberPlate' => ["required"],
            // 'vehicleBrand' => ["required"],
            // 'modelName' => ["required"],
            'fuel_id' => ["required"],
            'birth_date' => ["required"],
            'chassisNo' => ["required"],
            'modelYear' => ["required"],
            'noOfGear' => ["required"],
            'odometerReading' => ["required"],
            'dateOfManufacturing' => ["required"],
            'gearbox' => ["required"],
            'gearboxNo' => ["required"],
            'engineNo' => ["required"],
            'engineSize' => ["required"],
            'engine' => ["required"],
            'keyNo' => ["required"],
            'pickup_address' => ["required"],
            'drop_address' => ["required"],
            'driver_name' => ["required", 'regex:/^[a-zA-Z\s]+$/'],
            'driver_number' => ["required"],
            'gender' => ["required"],
            'email' => ["required"],
        ];

        $this->validate($valArr);

        if (empty($this->modelName) && empty($this->vehicle_type_id) && empty($this->modelName)) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Select the Vehicle using search',
            ]);
            return;
        }

        $customer = new Customer();
        $customer->name = $this->name;
        $customer->lastname = $this->lastname;
        $customer->gender = $this->gender;
        $customer->birth_date = date('Y-m-d', strtotime($this->birth_date));
        $customer->email = $this->email;
        $customer->mobile_no = $this->mobile_no;
        $customer->address = $this->address;
        $customer->country_id = $this->country_id;
        $customer->state_id = $this->state_id;
        $customer->city_id = $this->city_id;
        $customer->user_id = $this->workshopId;
        $customer->gst_number = $this->gst_no;
        $customer->save();

        $vehicle = new Vehicle();
        $vehicle->vehicletype_id = $this->vehicle_type_id;
        $vehicle->number_plate = $this->numberPlate;
        $vehicle->vehiclebrand_id = $this->vehicleBrand;
        $vehicle->chassisno = $this->chassisNo;
        $vehicle->modelname = $this->modelName;
        $vehicle->modelyear = $this->modelYear;
        $vehicle->fuel_id = $this->fuel_id;
        $vehicle->gearbox = $this->gearbox;
        $vehicle->gearboxno = $this->gearboxNo;
        $vehicle->engineno = $this->engineNo;
        $vehicle->engine = $this->engine;
        $vehicle->enginesize = $this->keyNo;
        $vehicle->driver_name = $this->driver_name;
        $vehicle->driver_number = $this->driver_number;
        $vehicle->policy_number = $this->policy_number;
        $vehicle->insurance_name = $this->insurance_name;
        $vehicle->gstin_number = $this->gstin_number;
        $vehicle->pickup_address = $this->pickup_address;
        $vehicle->drop_address = $this->drop_address;
        $vehicle->policy_expiry_date = $this->policy_expiry_date;

        $vehicle->odometerreading = $this->odometerReading;
        $vehicle->nogears = $this->noOfGear;

        $vehicle->customer_id = $customer->id;
        $vehicle->save();

        $this->vehicles = $vehicledata = Vehicle::where('customer_id', $customer->id)->get();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Customer added successfully!',
        ]);

        $this->showModal = false;
    }

    public function customerVoice()
    {
        $this->customerVoices = array_merge($this->selectedItemsCustomerVoice, $this->customerVoices);
        $this->customerVoices = array_filter($this->customerVoices, function ($value) {
            return !empty($value); // This will remove empty values
        });
        $this->customerVoices = array_values($this->customerVoices); // Re-index array after filtering

        // Ensure at least one customer voice is present
        if (empty($this->customerVoices)) {
            $this->customerVoices = [''];
        }

        $valArr = [
            'customerVoices.*' => ["required"],
        ];


        $customMessages = customErrorMsg();
        $this->validate($valArr, $customMessages);


        JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 1)
            ->delete();


        foreach ($this->customerVoices as $voice) {
            JobCardsInspection::create([
                'jobcard_number' => $this->jobcardNumbers,
                'customer_voice' => $voice,
                'is_customer_voice' => 1,
                'user_id' => Auth::guard('workshop')->user()->id,
            ]);
        }

        $cardInspirationCount = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 1)
            ->count();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Customer Voice Added Successfully!',
        ]);

        $this->customerVoiceCount = $cardInspirationCount;

        $this->showCustomerVoice = false;
    }
    public function accessoriesVoice()
    {
        $valArr = [
            'accessoriesVoices.*' => ["required"],
        ];

        JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 2)
            ->delete();

        $customMessages = customErrorMsg();
        $this->validate($valArr, $customMessages);

        foreach ($this->accessoriesVoices as $accessaries) {
            JobCardsInspection::create([
                'jobcard_number' => $this->jobcardNumbers,
                'customer_voice' => $accessaries,
                'is_customer_voice' => 2,
                'user_id' => Auth::guard('workshop')->user()->id,
            ]);
        }

        $cardInspirationCountAccessaries = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 2)
            ->count();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Accessories Added Successfully!',
        ]);

        $this->accessariesCount = $cardInspirationCountAccessaries;

        $this->showAccessoriesVoice = false;
    }
    public function workVoice()
    {
        $valArr = [
            'workVoices.*' => ["required"],
        ];

        $customMessages = customErrorMsg();
        $this->validate($valArr, $customMessages);

        JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 0)
            ->delete();

        foreach ($this->workVoices as $vorknote) {
            JobCardsInspection::create([
                'jobcard_number' => $this->jobcardNumbers,
                'customer_voice' => $vorknote,
                'is_customer_voice' => 0,
                'user_id' => Auth::guard('workshop')->user()->id,
            ]);
        }

        $cardInspirationCountWorkNotes = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 0)
            ->count();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Work Notes Added Successfully!',
        ]);

        $this->workNoteCount = $cardInspirationCountWorkNotes;

        $this->showWorkNote = false;
    }

    public function showDent()
    {
        $this->jobCardsDentImage = $jobCard = JobCardsDentMark::with('Image')->where('jobcard_number', $this->jobcardNumbers)->first();

        if (!empty($jobCard)) {
            $this->imagePath = $jobCard->Image->file;
        }
        $this->showDentCar = true;
        $this->dispatch('show-dent-modal');
    }



    public function confirmDelete($id)
    {
        $this->dentImageId = $id;
        $this->dispatch('swal:confirm', [
            'title' => 'Are you sure?',
            'text' => 'This action cannot be undone.',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
            'action' => 'deleteDentImage',
        ]);
    }

    public function deleteDentImage()
    {
        // Ensure the ID exists
        if ($this->dentImageId) {
            JobCardsDentMark::destroy($this->dentImageId);
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Dent Image deleted successfully!',
            ]);
        } else {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'No Dent Image ID provided.',
            ]);
        }

        $this->showDentCar = false;
    }

    public function saveImage($mergedImageData)
    {

        $imageData = str_replace('data:image/png;base64,', '', $mergedImageData);
        $imageData = str_replace(' ', '+', $imageData);
        $image = base64_decode($imageData);
        $fileName = 'marked_car_' . Str::random(10) . '.png';

        $path = public_path('uploads/' . $fileName);

        file_put_contents($path, $image);

        $carImage = new UploadImage();
        $carImage->file = 'uploads/' . $fileName;
        $carImage->img_id = 0;
        $carImage->save();

        $jobCardsDentMark = new JobCardsDentMark();
        $jobCardsDentMark->jobcard_number = $this->jobcardNumbers;
        $jobCardsDentMark->file_id = $carImage->id;
        $jobCardsDentMark->save();

        $cardInspirationCountDent = JobCardsDentMark::where('jobcard_number', $this->jobcardNumbers)
            ->count();

        $this->jobcarddentCount = $cardInspirationCountDent;


        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Dent Car Added Successfully!',
        ]);

        $this->showDentCar = false;
    }

    public function closeModal()
    {
        $this->resetPage();
        $this->showDentCar = false;
        $this->dispatch('show-dent-modal');
    }

    public function confirmJobCard($status, $id)
    {

        $jobcard = Jobcard::where('id', $id)->first();
        $jobcard->status = $status;
        $jobcard->save();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Job-Card Confirmed Succesfully!',
        ]);
        return redirect()->route('workshop.jobcard');

    }

    public function confirmClosed($status)
    {
        if ($this->balance_amount > 0) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Cannot close the jobcard. Pending balance must be paid first.',
            ]);
            return;
        } else if ($this->balance_amount < 0) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'The amount must be a positive value.',
            ]);
            return;
        }

        $this->validate(['payment_type' => 'required']);

        $this->dispatch('swal:confirm', [
            'title' => 'Are you sure?',
            'text' => 'This action will close it.',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Yes, Close it!',
            'cancelButtonText' => 'Cancel',
            'action' => "closejobcard",
        ]);
    }

    public function closejobcard()
    {
        $this->updateJobCard(3);
    }


    public function updateJobCard($status, $step = "0")
    {

        if ($this->balance_amount < 0) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'The amount must be a positive value.',
            ]);
            return;
        }
        if ($this->advance > 0 && empty($this->payment_type)) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Please select payment type and proceed.',
            ]);
            $this->addError('payment_type', 'This field is required.');
            return;
        } else if ($this->advance > 0 && !empty($this->payment_type) && $this->payment_type != 'cash' && empty($this->transaction_number)) {
            $this->addError('transaction_number', 'This field is required.');
            return;
        }

        $jobcard = JobCard::find($this->jobId);

        $jobstatus = $jobcard->status;
        //dd($jobstatus);
        if ($status == 2 && empty($jobcard->shared_serial)) {
            $serialService = new SharedSerialService();
            [$companyCode, $seriesCode] = $this->sharedSerialCodes();
            $jobcard->shared_serial = $serialService->claimNext($this->workshopId, $companyCode, $seriesCode);
        }

        if (in_array($status, [1, 2], true)) {
            $this->confirmPendingJobCardOrders($jobcard->id);
        }

        if ($jobcard->status == 2) {
            // dd($jobstatus);
            $valArr = [
                'final_discount' => 'required|numeric|min:0',
                'final_paid' => 'required|numeric|min:0',
                'advance' => 'required|numeric|max:' . $this->final_amount,
                'balance_amount' => $status == 3 ? 'required|in:0|numeric' : 'required|numeric',
            ];

            $this->validate(
                $valArr,
                [
                    'final_discount.required' => "Discount Field is required.",
                    'final_paid.required' => "Pay Field is required.",
                    'final_discount.numeric' => "Discount Field should be a valid number.",
                    'final_paid.numeric' => "Pay Field should be a valid number.",
                    'final_discount.min' => "Discount Field should be a valid number.",
                    'final_paid.min' => "Pay Field should be a valid number.",
                    'balance_amount.in' => 'The Pending amount must be zero.',
                    'balance_amount.required' => 'The Pending amount is required.',
                    'balance_amount.numeric' => 'The Pending amount must be a number.',
                ]
            );


            $jobcard->final_discount = $this->final_discount;
            $jobcard->final_paid = $this->final_paid;
            $jobcard->amount = $this->totalAmount;
            $jobcard->discount = $this->total_discount;
            $jobcard->final_amount = $this->final_amount;
            $jobcard->advance = $this->advance;
            $jobcard->balance_amount = $this->balance_amount;
            $jobcard->payment_type = $this->payment_type;
            $jobcard->transaction_number = $this->transaction_number;


            $jobcard->status = $status;
            $jobcard->save();

            if ($status == 3) {
                $SendJobCardPdfMail = new SendJobCardPdfMail;
                $SendJobCardPdfMail->jobcard_id = $jobcard->id;
                $SendJobCardPdfMail->template_type = 2;
                $SendJobCardPdfMail->save();
            }
        }


        $valArr = [
            'totalAmount' => 'required|numeric|min:1',
            'final_amount' => 'required|numeric|min:1',
        ];

        // $customMessages = customErrorMsg();

        // try {
        //     $validatedData = $this->validate($valArr, $customMessages);
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     $errorMessage = $e->validator->errors()->first();
        //     $this->dispatch('toastr-error', [
        //         'message' => $errorMessage,
        //     ]);
        //     return;
        // }
        $customMessages = customErrorMsg();

// Conditionally add mechanic_id validation for In House charges
foreach ($this->extraCharges as $key => $charge) {
    if (isset($charge['charge_type']) && $charge['charge_type'] == 1) { // 1 = In House
        $valArr["extraCharges.$key.mechanic_id"] = 'required';
    }
}

try {
    $validatedData = $this->validate($valArr, $customMessages);
} catch (\Illuminate\Validation\ValidationException $e) {
    $errorMessage = $e->validator->errors()->first();
    $this->dispatch('toastr-error', [
        'message' => $errorMessage,
    ]);
    return;
}


        $items = array_merge(
            array_column($this->spareParts, 'id'),
            array_column($this->lubes, 'id'),
            array_column($this->accessoriess, 'id'),
        );
        $qty = array_merge(
            array_column($this->spareParts, 'quantity'),
            array_column($this->lubes, 'quantity'),
            array_column($this->accessoriess, 'quantity'),
        );

        // Debug: Log items and quantities
        \Log::info("Processing items: " . json_encode($items));
        \Log::info("Quantities: " . json_encode($qty));
        \Log::info("Job Status: {$jobstatus}, Target Status: {$status}");

        $price = array_merge(
            array_column($this->spareParts, 'unit_price'),
            array_column($this->lubes, 'unit_price'),
            array_column($this->accessoriess, 'unit_price'),
        );

        $totalAmount = array_merge(
            array_column($this->spareParts, 'total_amount'),
            array_column($this->lubes, 'total_amount'),
            array_column($this->accessoriess, 'total_amount'),
        );


        $discount = array_merge(
            array_column($this->spareParts, 'discount'),
            array_column($this->lubes, 'discount'),
            array_column($this->accessoriess, 'discount'),
        );

          $discountType = array_merge(
            array_column($this->spareParts, 'discount_type'),
         array_column($this->lubes, 'discount_type'),
               array_column($this->accessoriess, 'discount_type'),
        );

        $finalAmount = array_merge(
            array_column($this->spareParts, 'final_amount'),
            array_column($this->lubes, 'final_amount'),
            array_column($this->accessoriess, 'final_amount'),
        );
        $taxPercentageArr = array_merge(
            array_column($this->spareParts, 'tax_percentage'),
            array_column($this->lubes, 'tax_percentage'),
            array_column($this->accessoriess, 'tax_percentage'),
        );
        $taxTypeArr = array_merge(
            array_column($this->spareParts, 'tax_type'),
            array_column($this->lubes, 'tax_type'),
            array_column($this->accessoriess, 'tax_type'),
        );
        $machanic = $this->mechanic_id;
        $vehicleId = $this->vehicle_id;
        $customer = Customer::with([
            'customerVehicles' => function ($qry) use ($vehicleId) {
                $qry->where('id', $vehicleId);
            }
        ])->find($this->customer_name);

        $error = false;
        $decreaseStockId = [];

        if ($jobstatus != 2 && $status == 2 && !empty($items)) {
            foreach ($items as $itemKey => $itemValue) {
                // Validate stock from spare_parts first, then product_stocks
                $sparePart = SparePart::where('label_id', $itemValue)
                    ->where('user_id', Auth::guard('workshop')->user()->id)
                    ->first();

                // If not found in spare_parts, check product_stocks
                if (!$sparePart) {
                    $sparePart = ProductStock::where('label_id', $itemValue)
                        ->where('user_id', Auth::guard('workshop')->user()->id)
                        ->first();
                }

                if ($sparePart) {
                    // Debug: Log stock check
                    \Log::info("Stock Check - Label ID: {$itemValue}, Required: {$qty[$itemKey]}, Available: {$sparePart->stock}");

                    if ($sparePart->stock < $qty[$itemKey]) {
                        $error = true;
                        \Log::error("Stock insufficient for Label ID: {$itemValue}");
                    } else {
                        // Use the actual model id for stock decrease
                        $decreaseStockId[] = ['model' => get_class($sparePart), 'id' => $sparePart->id, 'qty' => $qty[$itemKey]];
                    }
                } else {
                    $error = true;
                    \Log::error("Spare part not found for Label ID: {$itemValue}");
                }
            }
        }

        if ($error) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Stock is not available for this order. Add stock and try again.',
            ]);
            return true;
        }

        // echo "<pre>";print_r($customer->vehicles->first()->modelname);die;
        if (!empty($jobcard)) {

            $vehicleName = array_filter([
                $customer->customerVehicles->brand ?? '',
                $customer->customerVehicles->variant ?? '',
                $customer->customerVehicles->year ?? '',
                $customer->customerVehicles->modification ?? ''
            ]);

            $selectedVehicleName = implode(' ', $vehicleName);


            $jobcard->customer_id = $this->customer_name;
            $jobcard->customer_name = strtoupper($customer->name . ' ' . $customer->lastname);
            $jobcard->vehicle_id = $vehicleId;
            $jobcard->modification_id = Vehicle::where('id', $vehicleId)->value('modification_id');
            $jobcard->vehical = $selectedVehicleName;
            $jobcard->vehical_number = $customer->customerVehicles->number_plate;
            $jobcard->amount = $this->totalAmount;
            $jobcard->discount = array_sum($discount);
            $jobcard->final_amount = $this->final_amount;
            $jobcard->advance = $this->advance;
            $jobcard->balance_amount = $this->balance_amount;
            $jobcard->km_runing = $this->km_reading;
            $jobcard->fual_level = $this->fual_level;
            $jobcard->supervisor_id = $this->supervisor;
            if ($status != 0) {
                $jobcard->status = $status;
            }
            if (!empty($step)) {
                $jobcard->step = $step;
            }
            $jobcard->sms_alert = $this->smsAlert;
            $jobcard->delivery_date = $this->deliveryDate;
            $jobcard->delivery_time = $this->deliveryTime;
            $jobcard->payment_type = $this->payment_type;
            $jobcard->transaction_number = $this->transaction_number;
            // Also claim shared serial here when moving to completed from this branch
            if ($status == 3 && empty($jobcard->shared_serial)) {
                $serialService = new SharedSerialService();
                [$companyCode, $seriesCode] = $this->sharedSerialCodes();
                $jobcard->shared_serial = $serialService->claimNext($this->workshopId, $companyCode, $seriesCode);
            }

            if (in_array($status, [1, 2], true)) {
                $this->confirmPendingJobCardOrders($jobcard->id);
            }

            $jobcard->save();


            JobCardSparePart::where('jobcard_id', $jobcard->id)->delete();
            if (!empty($items)) {
                if (count($items) > 0) {

                    foreach ($items as $itemKey => $itemValue) {
                        $sparePart = SparePart::where('label_id', $itemValue)->first();
                        $labelName = SparePartLabel::select('title')->find($itemValue);
            $item = new JobCardSparePart;
                        $item->jobcard_id = $jobcard->id;
                        $item->stock_label_id = $itemValue;
                        // product_stock_id is not applicable when using spare_parts stock; set null
                        $item->product_stock_id = null;
                        $item->stock_label_name = $labelName->title;
                        $item->quantity = $qty[$itemKey];
                        $item->price = $price[$itemKey];
                        $item->total_amount = $totalAmount[$itemKey];
                        $item->discount = $discount[$itemKey];
                        //   $item->discount_type = $discountType[$itemKey];
                        $item->discount_type = $discountType[$itemKey] ?? 'fixed';
                        $item->final_amount = $finalAmount[$itemKey];
                        $item->purchase_price = $sparePart->purchase_price ?? 0;
                        $item->tax_type = $taxTypeArr[$itemKey] ?? null;
                        $item->tax_percentage = $taxPercentageArr[$itemKey] ?? "0";

                        // Persist current tax/purchase meta onto JobCardSparePart safely
                        try {
                            $metaPart = SparePart::where('label_id', $itemValue)->where('user_id', $this->workshopId)->first();
                            if (!$metaPart) {
                                $metaStock = ProductStock::where('user_id', $this->workshopId)->where('label_id', $itemValue)->first();
                            }
                            if (property_exists($item, 'purchase_price') && empty($item->purchase_price)) {
                                $item->purchase_price = $metaPart->purchase_price ?? ($metaStock->buy_price ?? null);
                            }
                            // Only fallback to meta if the UI didn't provide a tax type
                            if (property_exists($item, 'tax_type') && ($item->tax_type === null || $item->tax_type === '')) {
                                $item->tax_type = $metaPart->tax_type ?? ($metaStock->tax_type ?? null);
                            }
                            // Only fallback to meta if the UI didn't provide a tax percentage
                            if (property_exists($item, 'tax_percentage') && ($item->tax_percentage === null || $item->tax_percentage === '')) {
                                $item->tax_percentage = $metaPart->tax_percentage ?? ($metaStock->tax_percentage ?? null);
                            }
                        } catch (\Throwable $e) { /* ignore */ }
                        
                        $item->save();
                    }
                }
            }



            JobCardExtraCharge::where('jobcard_id', $jobcard->id)->delete();

            if (isset($this->extraCharges)) {
                foreach ($this->extraCharges as $charge) {

                    // echo "<pre>";print_r($charge);die;
                    $extraCharge = new JobCardExtraCharge;
                    $extraCharge->jobcard_id = $jobcard->id;
                    $extraCharge->label = $charge['label'];
                    $extraCharge->charges = $charge['charge'];
                    $extraCharge->charge_type = $charge['charge_type'];
                    // $extraCharge->machanic_id = $charge['mechanic_id'];
                    $extraCharge->machanic_id = $charge['mechanic_id'] !== '' ? $charge['mechanic_id'] : null;
                    $extraCharge->amount = $charge['amount'];
                    $extraCharge->gst_type = $charge['gst_type'];
                    $extraCharge->gst = $charge['gst_percentage'];
                      $extraCharge->outsource_price = $charge['charge_type'] == 2 ? ($charge['outsource_price'] ?? 0) : null;
                        $extraCharge->qty = isset($charge['qty']) ? (int) $charge['qty'] : 1;

                        //dd($extraCharge);
                    $extraCharge->save();
                }
            }


            if (count($decreaseStockId) > 0) {
                foreach ($decreaseStockId as $decrease) {
                    if ($decrease['model'] === 'App\Models\SparePart') {
                        $sparePart = SparePart::find($decrease['id']);
                        if ($sparePart) {
                            $sparePart->stock = $sparePart->stock - $decrease['qty'];
                            $sparePart->save();
                        }
                    } elseif ($decrease['model'] === 'App\Models\ProductStock') {
                        $productStock = ProductStock::find($decrease['id']);
                        if ($productStock) {
                            $productStock->stock = $productStock->stock - $decrease['qty'];
                            $productStock->save();
                        }
                    }
                }
            }

            if ($step == 1 || ($jobstatus == 1 && $status == 2)) {
                $SendJobCardPdfMail = new SendJobCardPdfMail();
                $SendJobCardPdfMail->jobcard_id = $jobcard->id;
                $SendJobCardPdfMail->template_type = $step == 1 ? 0 : 1;
                $SendJobCardPdfMail->save();
            }

            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Job-Card Update Succesfully!',
            ]);
            return redirect()->route('workshop.jobcard');
        }

        $this->dispatch('swal:toast', [
            'type' => 'error',
            'message' => 'Details Not Found!',
        ]);
    }


    public function sendInvoiceMail($id)
    {

        $newjobcard = JobCard::with([
            'exitNote' => function ($query) {
                $query->select('note', 'job_card_id');
            }
        ])->where('id', $id)->first();

        if (!empty($newjobcard)) {
            if ($newjobcard->status == 2 || $newjobcard->status == 3) {

                $customer = Customer::select('id', 'name', 'lastname', 'mobile_no', 'email', 'address')->where('id', $newjobcard->customer_id)->first();
                $vehicles = Vehicle::select('number_plate', 'chassisno', 'modelname', 'vehiclebrand_id')->where('id', $newjobcard->vehicle_id)->first();
                $jobCardSpareParts = JobCardSparePart::where('jobcard_id', $id)->get();
                $jobCardExtraCharges = JobCardExtraCharge::where('jobcard_id', $id)->get();



                $inspections = JobCardsInspection::select('customer_voice', 'is_customer_voice')->where('jobcard_number', $newjobcard->jobcard_number)->whereIn('is_customer_voice', [1, 0])->get();
                $jobCardCustomerVoice = $inspections->where('is_customer_voice', 1);
                $jobCardAccessories = $inspections->where('is_customer_voice', 0);

                $exitNote = $newjobcard->exitNote;

                $title = 'View Invoice';
                $logo = WorkShopVendor::where('id', Auth::guard('workshop')->user()->id)->first();


                $data = compact('title', 'logo', 'customer', 'newjobcard', 'vehicles', 'jobCardSpareParts', 'jobCardExtraCharges', 'jobCardCustomerVoice', 'jobCardAccessories', 'exitNote');

                Mail::to($customer->email)->send(new InvoiceMail($data));

                $this->dispatch('swal:toast', [
                    'type' => 'success',
                    'message' => "The invoice has been sent to the customer's mail successfully!",
                ]);

                return true;
            } else {

                $customer = Customer::where('id', $newjobcard->customer_id)->first();
                $vehicles = Vehicle::where('id', $newjobcard->vehicle_id)->first();
                $jobCardSpareParts = JobCardSparePart::where('jobcard_id', $id)->get();

                $jobCardExtraCharges = JobCardExtraCharge::where('jobcard_id', $id)->get();
                $jobCardCustomerVoice = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 1)->get();
                $jobCardAccessories = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 2)->get();

                $title = 'View Invoice';
                $logo = WorkShopVendor::where('id', Auth::guard('workshop')->user()->id)->first();


                $data = compact('title', 'logo', 'customer', 'newjobcard', 'vehicles', 'jobCardSpareParts', 'jobCardExtraCharges', 'jobCardCustomerVoice', 'jobCardAccessories');

                Mail::to($customer->email)->send(new EstimateMail($data));

                $this->dispatch('swal:toast', [
                    'type' => 'success',
                    'message' => "The estimate has been sent to the customer's mail successfully!",
                ]);

                return true;
            }
        }

        $this->dispatch('swal:toast', [
            'type' => 'error',
            'message' => "Something wrong found! Please try again.",
        ]);

        return true;
    }

    public function paymentType($value)
    {
        $this->payment_type = $value;
    }

    public function updateNote()
    {
        if (!empty($this->notes)) {

            $this->jobcardData->notes = $this->notes;
            $this->jobcardData->save();
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => "Note update successfully!",
            ]);
        } else {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => "Note is empty!",
            ]);
        }

    }

    public function updatedTaxPercentage($value)
    {
        $this->calculatePrice();
    }

    public function updatedPrice()
    {
        $this->calculatePrice();
    }
    public function updatedTaxType()
    {
        $this->calculatePrice();
    }

    private function calculatePrice()
    {
        $price = 0;
        $taxPercentage = floatval($this->tax_percentage);
        $sellingAmount = floatval($this->price);

        if ($this->tax_type == 'include' && $taxPercentage) {
            $tax = ($sellingAmount * $taxPercentage) / 100;
            $price = round($sellingAmount);
            //dd($price);
        } elseif ($this->tax_type == 'exclude' && $taxPercentage) {
            $tax = ($sellingAmount * $taxPercentage) / 100;
            $price = $sellingAmount + $tax;
           // dd($price);
        } else {
            $price = $sellingAmount;
        }

        $this->total_price = $price;
    }

    /**
     * Ensure each line item carries purchase_price, tax_type, tax_percentage.
     * Looks up from SparePart first, then ProductStock. No-op if already set.
     */
    private function hydrateLineItemMeta(): void
    {
        $applyMeta = function (&$line) {
            $needsPurchase = empty($line['purchase_price']) && $line['purchase_price'] !== 0;
            $needsTaxType = empty($line['tax_type']);
            $needsTaxPercent = !isset($line['tax_percentage']);

            if (!$needsPurchase && !$needsTaxType && !$needsTaxPercent) {
                return;
            }

            $labelId = $line['id'] ?? null;
            if (!$labelId) {
                return;
            }

            $metaPart = SparePart::where('label_id', $labelId)
                ->where('user_id', $this->workshopId)
                ->first();
            $metaStock = null;
            if (!$metaPart) {
                $metaStock = ProductStock::where('user_id', $this->workshopId)
                    ->where('label_id', $labelId)
                    ->first();
            }

            if ($needsPurchase) {
                $line['purchase_price'] = $metaPart->purchase_price ?? ($metaStock->buy_price ?? $line['purchase_price'] ?? null);
            }
            if ($needsTaxType) {
                $line['tax_type'] = $metaPart->tax_type ?? ($metaStock->tax_type ?? ($line['tax_type'] ?? null));
            }
            if ($needsTaxPercent) {
                $line['tax_percentage'] = $metaPart->tax_percentage ?? ($metaStock->tax_percentage ?? ($line['tax_percentage'] ?? null));
            }
        };

        foreach ($this->spareParts as $idx => $sp) {
            $applyMeta($this->spareParts[$idx]);
        }
        foreach ($this->lubes as $idx => $lb) {
            $applyMeta($this->lubes[$idx]);
        }
        foreach ($this->accessoriess as $idx => $ac) {
            $applyMeta($this->accessoriess[$idx]);
        }
    }

//     private function calculatePrice()
// {
//     $basePrice = 0;

//     if ($this->labour_type === 'inhouse') {
//         $basePrice = floatval($this->price);
//     } elseif ($this->labour_type === 'outsource') {
//         $basePrice = floatval($this->price) + floatval($this->outsource_price);
//     }

//     $taxPercentage = floatval($this->tax_percentage);
//     $total = $basePrice;

//     if ($this->tax_type === 'exclude' && $taxPercentage > 0) {
//         $tax = ($basePrice * $taxPercentage) / 100;
//         $total += $tax;
//     }

//     // If tax is included, we assume the price already contains it
//     $this->total_price = round($total, 2);
// }


//     public function storelabourcharge()
//     {
// // dd("jdjf");
//         $validate = [
//             'title' => 'required',
//             'price' => 'required|integer|min:1',
//         ];


//         $this->validate($validate);

//         $staff = LabourCharge::create([
//             'title' => $this->title,
//             'price' => $this->price,
//             'gst' => $this->tax_percentage,
//             'gst_type' => $this->tax_type,
//             'user_id' => $this->workshopId,
//             'total' => $this->total_price,
//             'status' => 1,
//         ]);

//         $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Labour change added successfully!']);
//         $this->reset('title', 'price', 'tax_percentage', 'tax_type', 'total_price');

//         $this->updatedExtraChargesDropdown($staff->id);
//         $this->showLabourCharge = false;
//     }

public function storelabourcharge()
{
    // dd($this->all());
    $rules = [
        'title' => 'required|string',
        'labour_type' => 'required|in:inhouse,outsource',
        'price' => 'required|numeric|min:1',
        'tax_type' => 'nullable|in:include,exclude',
        'tax_percentage' => 'nullable|numeric|min:0|max:100',
    ];

    if ($this->labour_type === 'outsource') {
        $rules['outsource_price'] = 'required|numeric|min:1';
    }

    $this->validate($rules);
    //dd($this->title, $this->labour_type,$this->puchase_price, $this->price,$this->tax_percentage);
    $staff = LabourCharge::create([
        'title' => $this->title,
        'labour_type' => $this->labour_type,
        'puchase_price'=>$this->puchase_price,
        'price' => $this->price,
        'outsource_price' => $this->labour_type === 'outsource' ? $this->outsource_price : null,
        'gst' => $this->tax_percentage,
        'gst_type' => $this->tax_type,
        'user_id' => $this->workshopId,
        'total' => $this->total_price,
        'profit' => $this->labour_type === 'outsource'
    ? ($this->outsource_price - $this->price)
    : null,

        'status' => 1,
    ]);

    $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Labour charge added successfully!']);
    $this->reset('title','puchase_price', 'price', 'outsource_price', 'tax_percentage', 'tax_type', 'labour_type', 'total_price');

    $this->updatedExtraChargesDropdown($staff->id);
    $this->showLabourCharge = false;
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

    /**
     * Test method to verify GST calculations
     * This method can be called to test different GST scenarios
     */
    public function testGstCalculations()
    {
        // Test Case 1: GST Exclude - 10% on 1000
        $qty = 1;
        $amount = 1000;
        $gstPercentage = 10;
        $gstType = 'exclude';

        $baseTotal = $qty * $amount; // 1000
        $gstAmount = ($baseTotal * $gstPercentage) / 100; // 100
        $finalAmount = $baseTotal + $gstAmount; // 1100

        $costAmount = round($gstAmount, 2); // 100 (GST amount)
        $productCost = round($finalAmount + $gstAmount, 2); // 1200 (Total + GST)

        Log::info('Test Case 1 - GST Exclude:', [
            'baseTotal' => $baseTotal,
            'gstAmount' => $gstAmount,
            'finalAmount' => $finalAmount,
            'costAmount' => $costAmount,
            'productCost' => $productCost
        ]);

        // Test Case 2: GST Include - 10% on 1000
        $gstType = 'include';
        $baseTotal = 1000; // This would be the amount after GST is included
        $gstAmount = ($baseTotal * $gstPercentage) / (100 + $gstPercentage); // 90.91 (extracted GST)
        $finalAmount = $baseTotal; // 1000 (amount already includes GST)

        $costAmount = round($gstAmount, 2); // 90.91 (extracted GST)
        $productCost = round($finalAmount - $gstAmount, 2); // 909.09 (Total - GST)

        Log::info('Test Case 2 - GST Include:', [
            'baseTotal' => $baseTotal,
            'gstAmount' => $gstAmount,
            'finalAmount' => $finalAmount,
            'costAmount' => $costAmount,
            'productCost' => $productCost
        ]);

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'GST calculations tested successfully. Check logs for details.',
        ]);
    }

    /**
     * Shared invoice prefix + FY series for job card and counter sale.
     */
    private function sharedSerialCodes(): array
    {
        $vendor = $this->user ?? WorkShopVendor::find($this->workshopId);

        return [
            SharedSerialService::resolveCompanyCode($vendor),
            SharedSerialService::resolveSeriesCode(),
        ];
    }

    /**
     * Publish online-stock orders to the workshop order list after job card confirm/complete.
     */
    /**
     * Vehicle modification for current job card (from job card or linked vehicle).
     */
    private function resolveJobCardModificationId(): ?int
    {
        $jobcard = $this->jobcardData ?? JobCard::find($this->jobId);
        if (!$jobcard) {
            return null;
        }

        if (!empty($jobcard->modification_id)) {
            return (int) $jobcard->modification_id;
        }

        if (!empty($jobcard->vehicle_id)) {
            $modId = Vehicle::where('id', $jobcard->vehicle_id)->value('modification_id');

            return $modId ? (int) $modId : null;
        }

        return null;
    }

    /**
     * Load spare/lube/accessory dropdown options for this job card's vehicle only.
     */
    private function loadWorkshopStockDropdowns(): void
    {
        $modId = $this->resolveJobCardModificationId();

        $query = DB::table('stocks')
            ->join('spare_part_labels', 'stocks.label_id', '=', 'spare_part_labels.id')
            ->where('stocks.user_id', $this->workshopId)
            ->whereNull('stocks.deleted_at')
            ->whereNull('spare_part_labels.deleted_at');

        if ($modId) {
            $query->where(function ($q) use ($modId) {
                $q->where('stocks.forAllVehicles', 1)
                    ->orWhereExists(function ($sub) use ($modId) {
                        $sub->select(DB::raw(1))
                            ->from('spare_part_vehicle_modifications')
                            ->whereColumn('spare_part_vehicle_modifications.spare_part_id', 'stocks.id')
                            ->where('spare_part_vehicle_modifications.vehicle_modification_id', $modId);
                    })
                    ->orWhereExists(function ($sub) use ($modId) {
                        $sub->select(DB::raw(1))
                            ->from('spare_parts')
                            ->whereNull('spare_parts.deleted_at')
                            ->whereColumn('spare_parts.label_id', 'stocks.label_id')
                            ->where(function ($spQ) use ($modId) {
                                $spQ->where('spare_parts.forAllVehicles', 1)
                                    ->orWhereExists(function ($modSub) use ($modId) {
                                        $modSub->select(DB::raw(1))
                                            ->from('spare_part_vehicle_modifications')
                                            ->whereColumn('spare_part_vehicle_modifications.spare_part_id', 'spare_parts.id')
                                            ->where('spare_part_vehicle_modifications.vehicle_modification_id', $modId);
                                    });
                            });
                    });
            });
        }

        $labels = $query->select(
            'stocks.id',
            'stocks.label_id',
            'stocks.category_id',
            'stocks.stock',
            'stocks.price',
            'stocks.buy_price',
            'stocks.tax_type',
            'stocks.tax_percentage',
            DB::raw('spare_part_labels.title as label_title')
        )->get();

        $mergedData = [];
        foreach ($labels as $label) {
            $mergedData[$label->category_id][] = [
                'label_id' => $label->label_id,
                'label_name' => $label->label_title,
                'cat_type' => $label->category_id,
                'product_stock_id' => $label->id,
                'stock' => $label->stock,
                'price' => $label->price,
                'GST_type' => $label->tax_type,
                'GST_percentage' => $label->tax_percentage,
                'purchese_price' => $label->buy_price,
            ];
        }

        $this->accessory = $mergedData[1] ?? [];
        $this->spare = $mergedData[2] ?? [];
        $this->tool = $mergedData[3] ?? [];
        $this->lube = $mergedData[4] ?? [];
    }

    private function shouldPublishJobCardOrders(): bool
    {
        $jobcard = $this->jobcardData ?? JobCard::find($this->jobId);

        return $jobcard && (int) $jobcard->status >= 1;
    }

    private function confirmPendingJobCardOrders(int $jobcardId): void
    {
        $pendingOrders = Order::where('jobcard_id', $jobcardId)
            ->where('is_confim', 0)
            ->get();

        foreach ($pendingOrders as $order) {
            $order->is_confim = 1;
            $order->save();

            // Notify all sparepart vendors that a new order is received
            $vendorIds = \App\Models\OrderItem::where('order_id', $order->id)
                ->pluck('user_id')
                ->unique()
                ->filter();
            foreach ($vendorIds as $vendorId) {
                \App\Models\Notification::create([
                    'user_id' => $vendorId,
                    'order_id' => $order->id,
                    'title'   => '🛒 New Order Received',
                    'message' => "Workshop has placed a new order (Order #{$order->id}). Please review the order items and accept or decline them.",
                    'sound'   => 'order.mp3',
                ]);
            }
        }
    }
}
