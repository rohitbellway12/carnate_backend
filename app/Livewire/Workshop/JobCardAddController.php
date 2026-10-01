<?php

namespace App\Livewire\Workshop;

use App\Models\Fueltype;
use App\Models\JobCardExtraCharge;
use App\Models\JobCardSparePart;
use App\Models\Modification;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Livewire\WithFileUploads;
use App\Models\{City, WorkShopVendor, Country, State, Branch, Customer, JobCard, JobCardImage, JobCardsInspection, Staff, User, Vehiclebrand};
use App\Models\JobCardsDentMark;
use App\Models\UploadImage;
use App\Services\RapidApiVehicleService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\{Auth, DB, Mail};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use App\Mail\EstimateMail;
use App\Mail\InvoiceMail;

use App\Models\Appointment;
#[Layout('components.layouts.workshop-app')]

class JobCardAddController extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $user_title = 'mr', $birth_date, $display_name, $branches;
    public $staffId, $workshopId, $vehicle_type_id, $vehicle_type_id_data, $search_vehicle, $selectedVehicleName;
    public $states = [];

    public $cities = [];
    public $customers, $supervisors, $country, $vehical_type, $vehical_brand, $fuel_type, $color, $model_name;
    public $showCustomerVoice, $addCustomerVoice, $confirmpassword, $add, $smsAlert, $showPhoto, $addphoto, $accessories, $showAccessoriesVoice, $addAccessoriesVoice, $addWorkNote, $showWorkNote, $images, $addVehicals, $isAddvehicle, $customer_name, $fual_level = 0, $supervisor, $vehiclesName, $vehicledatacollection, $vehicle_brand_id_data, $property_id;

    public $customer_type, $search_customer_voice, $search_accessory, $search_work_notes, $driver_name, $driver_number, $policy_number, $insurance_name, $gstin_number, $policy_expiry_date, $pickup_address, $drop_address;
    public $customerVoices = [];
    public $vehical_types = [];
    public $fuel_types = [];
    public $vehical_models = [];
    public $vehical_brands = [];
    public $carImages = [];

    public $accessoriesVoices = [];
    public $workVoices = [];
    public $vehicles = [];
    public $km_reading = 0;
    public $isAdd = false;
    public $customerVoiceCount = "0";
    public $jobcarddentCount = "0";
    public $photosCount = "0";
    public $accessariesCount = "0";
    public $workNoteCount = "0";
    public $showDentCar = false;
    public $jobcardNumbers;
    public $jobCardsDentImage;
    public $adds = false;

    public $isVehical, $showVehical, $isBrand, $showBrand, $isModel, $showModel, $isFuel, $showFuel, $vehicleDetails;
    public $vehicle_id, $vehicleBrand, $modelName, $fuel_id, $odometerReading, $numberPlate, $chassisNo, $modelYear, $noOfGear;
    public $vehicle_color, $gearbox, $gearboxNo, $engineN, $engineSize, $engine, $keyNo, $engineNo, $isOpen, $property_photos = [];
    public $isEdits = false;
    public $fields = [];
    public $vehicleType = '';
    public $vehicleTypes = [];
    public $brandType = '';
    public $brandTypes = [];
    public $customerVoicesData = [];
    public $modelType = '';
    public $modelTypes = [];
    public $fuelType = '';
    public $fuelTypes = [];

    public $selectedItemsCustomerVoice = [];
    public $selectedItemsAccessoryVoice = [];
    public $selectedItemsWorkNoteVoice = [], $gst_no, $photos;

    public $showCustomerAlert = false, $showCustomerVoiceInput = false, $customerVoiceInpt = "", $customersVoiceData, $showWorkNoteInput = false, $workNotInpt, $worknotVoicesData, $showAccessoriesInput = false, $accessoriesVoicesInput, $accessoryData;
    public $cust_type = 0, $company_name, $show_company_name, $pincode;
    public $brand_name, $variant_name, $selected_year, $modificationId;
    public $brands = [], $variants = [], $years = [], $modifications = [], $all_modifications = [];
    public $selectedBrandId, $selectedModelId;
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
        'user_title' => 'required',
    ];

    public function mount($isAdd = null)
    {
        // echo"hello";die;
        $this->workshopId = Auth::guard('workshop')->user()->id;
        $this->branches = Branch::get();

        $this->customerVoices = !empty($jobCardsInspection)
            ? collect($jobCardsInspection)->pluck('customer_voice')->toArray()
            : [''];
        $this->accessoriesVoices = !empty($jobCardsInspection)
            ? collect($jobCardsInspection)->pluck('ccessorie_voice')->toArray()
            : [''];
        $this->workVoices = !empty($jobCardsInspection)
            ? collect($jobCardsInspection)->pluck('work_voice')->toArray()
            : [''];

        $this->jobcardNumbers = generateHashJobCardNumber(Auth::guard('workshop')->user());
        $this->customers = [];

        // $this->customerVoicesData = DB::table('job_cards_inspections')
        // ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));
        // if (!empty($this->customerVoices)) {
        //     $this->customerVoicesData = $this->customerVoicesData->whereNotIn('customer_voice', $this->customerVoices);
        // }
        // $this->customerVoicesData = $this->customerVoicesData->groupBy('customer_voice')->get();
        $this->fetchCustomerVoicesData();
        $this->fetchWorkNoteVoicesData();
        $this->fetchAccessoryData();

        $this->images = [];

        // $this->supervisors = WorkShopVendor::where('user_type', 21)->where('parent_id', $this->workshopId)->get();
        $this->supervisors = WorkShopVendor::where('parent_id', $this->workshopId)->get();

        if (request()->has('appointment_id')) {
            $appointment = Appointment::find(request()->get('appointment_id'));
            if ($appointment) {
                $this->customer_name = $appointment->customer_id;
                $this->vehicle_id = $appointment->vehicle_id;
                if ($appointment->issue_description) {
                    $this->customerVoices = [$appointment->issue_description];
                    $this->customerVoiceCount = 1;
                }
            }
        }
    }

    private function fetchCustomerVoicesData()
    {
        $this->customerVoicesData = DB::table('job_cards_inspections')->where('is_customer_voice', 1)
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));

        if (!empty($this->customerVoices)) {
            $this->customerVoicesData = $this->customerVoicesData->whereNotIn('customer_voice', $this->customerVoices);
        }

        $this->customerVoicesData = $this->customerVoicesData->groupBy('customer_voice')->orderByRaw('MAX(id) DESC')->get();
    }

    private function fetchWorkNoteVoicesData()
    {
        $this->worknotVoicesData = DB::table('job_cards_inspections')->where('is_customer_voice', 0)
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));

        if (!empty($this->workVoices)) {
            $this->worknotVoicesData = $this->worknotVoicesData->whereNotIn('customer_voice', $this->workVoices);
        }

        $this->worknotVoicesData = $this->worknotVoicesData->groupBy('customer_voice')->orderByRaw('MAX(id) DESC')->get();
    }

    private function fetchAccessoryData()
    {
        $this->accessoryData = DB::table('job_cards_inspections')->where('is_customer_voice', 2)
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));

        if (!empty($this->accessoriesVoices)) {
            $this->accessoryData = $this->accessoryData->whereNotIn('customer_voice', $this->accessoriesVoices);
        }

        $this->accessoryData = $this->accessoryData->groupBy('customer_voice')->orderByRaw('MAX(id) DESC')->get();
    }

    public function render()
    {

        //  echo "<pre>";print_r($this->customerVoicesData);die;

        $vehicle_data = Vehicle::where('id', $this->vehicle_id)->first();
        if (!empty($vehicle_data)) {
            $customer_data = Customer::where('id', $vehicle_data->customer_id)->first();
        } else {
            $customer_data = '';
        }
        $countries = Country::all();

        $this->vehical_types = VehicleType::where('soft_delete', '=', 0)->get();
        $this->fuel_types = Fueltype::where('soft_delete', '=', 0)->get();

        return view('livewire.workshop.jobcard.add', compact('countries', 'vehicle_data', 'customer_data'));
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

        try {
            $vehicleService = new RapidApiVehicleService();
            $this->brands = collect($vehicleService->getBrandsList())->toArray();
        } catch (\Exception $e) {
            \Log::error('Error fetching brands: ' . $e->getMessage());
            $this->brands = [];
        }

        $this->variants = [];
        $this->years = [];
        $this->modifications = [];
        $this->all_modifications = [];

        $this->reset('modificationId', 'show_company_name', 'cust_type', 'search_vehicle', 'vehicle_type_id', 'modelName', 'selectedVehicleName', 'states', 'cities', 'name', 'lastname', 'mobile_no', 'address', 'insurance_name', 'policy_expiry_date', 'gst_no', 'country_id', 'state_id', 'city_id', 'email', 'birth_date', 'user_title', 'numberPlate', 'fuel_id', 'chassisNo', 'modelYear', 'noOfGear', 'vehicle_color', 'gearbox', 'gearboxNo', 'engineNo', 'engineSize', 'engine', 'keyNo', 'pickup_address', 'drop_address', 'driver_name', 'driver_number', 'policy_number', 'brand_name', 'variant_name', 'selected_year');

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


    public function addAccessorie()
    {

        $this->addAccessoriesVoice = false;
        $this->showAccessoriesVoice = true;
    }

    public function addWork()
    {

        $this->addWorkNote = false;
        $this->showWorkNote = true;
    }

    public function addVoice()
    {

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

    public function updateSelectedItemsWorkNotesVoice($value)
    {
        $selectedValue[] = $value;
        $this->workVoices = array_merge($selectedValue, $this->workVoices);
        $this->workVoices = array_filter($this->workVoices, function ($value) {
            return !empty($value);
        });
        $this->workVoices = array_unique(array_values($this->workVoices));

        JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 0)
            ->delete();
        foreach ($this->workVoices as $value) {

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

    public function removeWorkField($index)
    {
        unset($this->workVoices[$index]);
        $this->workVoices = array_values($this->workVoices); // Reindex array
    }

    public function addAccessorieField()
    {
        $this->showAccessoriesInput = true;
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

        $this->vehical_types = Vehicletype::where('soft_delete', '=', 0)->get();
        $this->fuel_types = Fueltype::where('soft_delete', '=', 0)->get();
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



    public function upload_property()
    {
        // Validate the photos field
        // dd($this->photos->getMimeType());
        $this->validate([
            'photos' => 'required|array',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $photoPaths = [];
        $photoIDs = [];

        if (sizeof($this->photos)) {
            foreach ($this->photos as $photo) {
                if (!empty($photo)) {
                    $photoPath = $photo->store("job_card_image/gallery", "public");
                    $photoPaths[] = $photoPath;

                    $fileExtension = $photo->getClientOriginalExtension();
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

            $this->images = UploadImage::whereIn('id', $photoIDs)->get();
            $this->photosCount = $this->images->count();

            $this->isOpen = '';
            $this->property_photos = [];
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Car Image uploaded']);
            $this->showPhoto = false;
        }
    }




    public function removeModelsType($index)
    {
        unset($this->modelTypes[$index]);
        $this->modelTypes = array_values($this->modelTypes);
    }

    public function updated()
    {
        $this->resetErrorBag();
    }


    // public function updatedCustomerName($customerId)
    // { 
    //     // echo "<prE>";print_r($customerId);die;
    //     if (!empty($customerId)) {
    //         $this->vehicles  = $vehicleData = Vehicle::where('customer_id', $customerId)->get();     
    //         if (empty($vehicleData->toArray())) {
    //             $this->dispatch('swal:toast', [
    //                 'type' => 'info', 
    //                 'message' => 'No vehicles found for this customer. Please add a vehicle.'
    //             ]);
    //         }else{
    //             $this->dispatch('swal:toast', [
    //                 'type' => 'success', 
    //                 'message' => 'Vehicles found successfully.'
    //             ]);
    //         }
    //     } else { 
    //         $this->vehicles = collect(); 
    //     }
    // }

    // public function handleSelection($id)
    // {
    //     $this->updatedCustomerName($id);
    // }



    public function updatedSearchCustomerVoice($customerVoice)
    {

        $this->customerVoicesData = DB::table('job_cards_inspections')->where('customer_voice', 'like', '%' . $customerVoice . '%')->where('is_customer_voice', 1)
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));
        if (!empty($this->customerVoices)) {
            $this->customerVoicesData = $this->customerVoicesData->whereNotIn('customer_voice', $this->customerVoices);
        }
        $this->customerVoicesData = $this->customerVoicesData->groupBy('customer_voice')->orderByRaw('MAX(id) DESC')->get();


    }



    public function updatedSearchAccessory($customerVoice)
    {
        $this->accessoryData = DB::table('job_cards_inspections')->where('is_customer_voice', 2)->where('customer_voice', 'like', '%' . $customerVoice . '%')
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));
        if (!empty($this->accessoriesVoices)) {
            $this->accessoryData = $this->accessoryData->whereNotIn('customer_voice', $this->accessoriesVoices);
        }
        $this->accessoryData = $this->accessoryData->groupBy('customer_voice')->orderByRaw('MAX(id) DESC')->get();
    }

    public function updatedSearchWorkNotes($customerVoice)
    {
        $this->worknotVoicesData = DB::table('job_cards_inspections')->where('is_customer_voice', 0)->where('customer_voice', 'like', '%' . $customerVoice . '%')
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));

        if (!empty($this->workVoices)) {
            $this->worknotVoicesData = $this->worknotVoicesData->whereNotIn('customer_voice', $this->workVoices);
        }

        $this->worknotVoicesData = $this->worknotVoicesData->groupBy('customer_voice')->orderByRaw('MAX(id) DESC')->get();
    }



    public function updatedSearchVehicle($id)
    {
        if(empty($id)) {
            $this->selectedVehicleName = '';
            $this->modificationId = null;
            return;
        }

        // Find from all_modifications
        $mod = collect($this->all_modifications)->firstWhere('id', $id);
        
        if($mod){
            $this->modificationId = (object)[
                'id' => $mod['id'],
                'brand_name' => is_array($this->brand_name) ? $this->brand_name['name'] : (collect($this->brands)->firstWhere('id', $this->selectedBrandId)['name'] ?? ''),
                'variant_name' => is_array($this->variant_name) ? $this->variant_name['name'] : (collect($this->variants)->firstWhere('id', $this->selectedModelId)['name'] ?? ''),
                'year' => $this->selected_year,
                'title' => $mod['name']
            ];

            $brand = $this->modificationId->brand_name ?? '';
            $model = $this->modificationId->variant_name ?? '';
            $modName = $this->modificationId->title ?? '';
            
            $yearRange = ($mod['yearFrom'] ?? '') . '-' . ($mod['yearTo'] ?? '');
            $fuel = $mod['fuelType'] ? ' - ' . $mod['fuelType'] : '';

            $this->selectedVehicleName = trim("$brand $model | $modName ($yearRange)$fuel");
        }else{
            $this->selectedVehicleName = '';
        }
    }

    public function updatedCustomerName($vehicleId)
    {
        // When a vehicle is selected, store its ID and load its color for display
        $this->vehicle_id = $vehicleId;

        // Retrieve the vehicle record to get the color (if it exists)
        $vehicle = Vehicle::find($vehicleId);
        if ($vehicle) {
            $this->vehicle_color = $vehicle->vehicle_color ?? '';
        } else {
            $this->vehicle_color = '';
        }

        return true;
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




    public function storeCustomer()
    {
        // dd($this->all());

        $valArr = [
            'cust_type' => "required",
            'name' => ["required_if:cust_type,0", 'nullable', 'regex:/^[a-zA-Z\s]+$/'],
            'lastname' => ['nullable', 'regex:/^[a-zA-Z\s]+$/'],
            'company_name' => ["required_if:cust_type,1", 'nullable', 'regex:/^[a-zA-Z\s]+$/'],
            'mobile_no' => ["required", "min:10"],
            'address' => ["nullable"],
            'country_id' => ["nullable"],
            'state_id' => ["nullable"],
            'city_id' => ["nullable"],
            'email' => ["nullable", "email"],
            'birth_date' => ["nullable"],
            'pincode' => "nullable|digits:6",
            'user_title' => ["required"],
            'numberPlate' => ["required"],
            // 'numberPlate' => ["required", "unique:vehicles,number_plate"],
            'search_vehicle' => ["required"],
            'chassisNo' => ["required"],
        ];

        $this->validate($valArr, [
            'name.required_if' => 'The first name field is required.',
            'company_name.required_if' => 'The company name field is required.',
            'name.regex' => 'The first name field format is invalid.',
            'lastname.regex' => 'The last name field format is invalid.',
            'company_name.regex' => 'The company name field format is invalid.'
        ]);

        if (empty($this->search_vehicle)) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Please select the complete Vehicle details (Modification)',
            ]);
            return;
        }

        $customerSerch = Customer::where('mobile_no', $this->mobile_no)->where('user_id', $this->workshopId)->first();

        // echo "<pre>";print_r($customerSerch);die;
        if (empty($customerSerch)) {
            $customer = new Customer();
            $customer->name = $this->name ?? '';
            $customer->lastname = $this->lastname ?? '';
            $customer->user_title = $this->user_title;
            $customer->birth_date = $this->birth_date ? date('Y-m-d', strtotime($this->birth_date)) : null;
            $customer->email = $this->email ?? '';
            $customer->mobile_no = $this->mobile_no;
            $customer->cust_type = $this->cust_type;
            $customer->company_name = $this->company_name ?? '';
            $customer->address = $this->address ?? '';
            $customer->country_id = $this->country_id ?? '';
            $customer->state_id = $this->state_id ?? '';
            $customer->city_id = $this->city_id ?? '';
            $customer->pincode = $this->pincode ?? '';
            $customer->user_id = $this->workshopId;
            $customer->gst_number = $this->gst_no ?? '';
            $customer->save();
        } else {
            $customer = $customerSerch;
        }

        // Find or create local Modification
        $makerType = \App\Models\MakerType::firstOrCreate(['title' => $this->modificationId->brand_name ?? ''], ['status' => 1]);
        $maker = \App\Models\Maker::firstOrCreate(
            ['title' => $this->modificationId->variant_name ?? '', 'maker_type_id' => $makerType->id],
            ['status' => 1]
        );

        $mod = collect($this->all_modifications)->firstWhere('id', $this->search_vehicle);
        $fuelType = $mod ? ($mod['fuelType'] ?? null) : null;
        $typeEngineName = $mod ? ($mod['name'] ?? null) : null;
        
        $startYear = substr($mod['yearFrom'] ?? '', 0, 4);
        $endYear = substr($mod['yearTo'] ?? '', 0, 4);
        $yearRange = $startYear;
        if (!empty($endYear)) {
            $yearRange .= ' / ' . $endYear;
        }

        $localModification = \App\Models\Modification::updateOrCreate(
            [
                'brand_name' => $this->modificationId->brand_name ?? '',
                'variant_name' => $this->modificationId->variant_name ?? '',
                'title' => $this->modificationId->title ?? '',
                'year' => $yearRange ?: ($this->selected_year ?? date('Y')),
            ],
            [
                'engine_name' => $typeEngineName,
                'fuel_type' => $fuelType,
                'brand_id' => $makerType->id,
                'variant_id' => $maker->id,
                'status' => 1,
            ]
        );

        $vehicle = new Vehicle();
        $vehicle->modification_id = $localModification->id;
        $vehicle->brand = $this->modificationId->brand_name ?? null;
        $vehicle->variant = $this->modificationId->variant_name ?? null;
        $vehicle->year = $this->selected_year ?? null;
        $vehicle->modification = $this->modificationId->title ?? null;
        $vehicle->number_plate = $this->numberPlate;
        $vehicle->chassis_no = $this->chassisNo;
        $vehicle->vehicle_color = $this->vehicle_color;
        $vehicle->engineno = $this->engineNo;
        $vehicle->driver_name = $this->driver_name;
        $vehicle->driver_number = $this->driver_number;
        $vehicle->policy_number = $this->policy_number;
        $vehicle->insurance_name = $this->insurance_name;
        $vehicle->pickup_address = $this->pickup_address;
        $vehicle->drop_address = $this->drop_address;
        $vehicle->gstin_number = $this->gst_no;
        $vehicle->policy_expiry_date = $this->policy_expiry_date;
        $vehicle->customer_id = $customer->id;
        $vehicle->save();

        $this->customers = [];

        $this->customer_name = $customer->id;
        $this->vehicle_id = $vehicle->id;

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Customer added successfully!',
        ]);

        $this->reset('vehicle_type_id', 'modelName', 'selectedVehicleName', 'states', 'cities', 'name', 'lastname', 'mobile_no', 'address', 'insurance_name', 'policy_expiry_date', 'gst_no', 'country_id', 'state_id', 'city_id', 'email', 'birth_date', 'user_title', 'numberPlate', 'fuel_id', 'chassisNo', 'modelYear', 'noOfGear', 'vehicle_color', 'gearbox', 'gearboxNo', 'engineNo', 'engineSize', 'engine', 'keyNo', 'pickup_address', 'drop_address', 'driver_name', 'driver_number', 'policy_number');
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

        // Insert customer voices
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

        $this->customerVoicesData = DB::table('job_cards_inspections')
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'))
            ->groupBy('customer_voice')
            ->get();

        $this->customerVoiceCount = $cardInspirationCount;
        $this->showCustomerVoice = false;
    }


    public function addphoto()
    {

        $this->validate([
            'images.*' => 'image|max:1024',
        ]);

        foreach ($this->images as $image) {
            $image->store('images', 'public');
        }

        session()->flash('success', 'Images uploaded successfully!');

        $this->reset(['images', 'showPhoto']);
    }



    public function accessoriesVoice()
    {

        $this->accessoriesVoices = array_merge($this->selectedItemsAccessoryVoice, $this->accessoriesVoices);
        $this->accessoriesVoices = array_filter($this->accessoriesVoices, function ($value) {
            return !empty($value); // This will remove empty values
        });
        $this->accessoriesVoices = array_values($this->accessoriesVoices); // Re-index array after filtering


        // Ensure at least one customer voice is present
        if (empty($this->accessoriesVoices)) {
            $this->accessoriesVoices = [''];
        }

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

        $this->workVoices = array_merge($this->selectedItemsWorkNoteVoice, $this->workVoices);
        $this->workVoices = array_filter($this->workVoices, function ($value) {
            return !empty($value);
        });
        $this->workVoices = array_values($this->workVoices);


        if (empty($this->workVoices)) {
            $this->workVoices = [''];
        }


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
        $this->showDentCar = true;
        $this->dispatch('show-dent-modal');
    }

    public function saveImage($mergedImageData)
    {
        $imageData = str_replace('data:image/png;base64,', '', $mergedImageData);
        $imageData = str_replace(' ', '+', $imageData);
        $image = base64_decode($imageData);
        $fileName = 'marked_car_' . Str::random(10) . '.png';

        $path = public_path('uploads/' . $fileName);

        file_put_contents($path, $image);

        $carImage = new UploadImage;
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

        $this->jobCardsDentImage = $jobCardsDentMark;

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

    public function selectedCustomer($customer)
    {
        $this->vehicle_id = $customer;
    }


    public function createJobCard()
    {


        $vehicleData = Vehicle::where('id', $this->vehicle_id)->first();
        $this->customer_name = $vehicleData->customer_id ?? '';
        $valArr = [
            'customer_name' => "required",
            'vehicle_id' => "required",
            'km_reading' => "nullable|min:0",

        ];

        $this->validate($valArr);


        $customer = Customer::with([
            'vehicles' => function ($query) {
                $query->where('id', $this->vehicle_id);
            }
        ])->find($this->customer_name);


        $vehicleName = array_filter([
            $vehicleData->brand ?? '',
            $vehicleData->variant ?? '',
            $vehicleData->year ?? '',
            $vehicleData->modification ?? ''
        ]);

        $selectedVehicleName = implode(' ', $vehicleName);

        $jobcard = new JobCard();
        $jobcard->jobcard_number = $this->jobcardNumbers;
        
        $jobcard->customer_id = $this->customer_name;
        $jobcard->modification_id = $vehicleData->modification_id;
        $jobcard->customer_name = strtoupper($customer->name . ' ' . $customer->lastname);
        $jobcard->cust_type = $customer->cust_type ?? 0;
        $jobcard->company_name = $customer->company_name ?? '';
        $jobcard->vehicle_id = $this->vehicle_id ?? 0;
        $jobcard->vehical = $selectedVehicleName ?? 0;
        $jobcard->vehical_number = $vehicleData->number_plate ?? 0;
        $jobcard->entry_date = Carbon::now();
        $jobcard->amount = $this->total_amount ?? 0;
        $jobcard->discount = $this->total_discount ?? 0;
        $jobcard->final_amount = $this->final_amount ?? 0;
        $jobcard->advance = $this->advance ?? 0;
        $jobcard->balance_amount = $this->balance_amount ?? 0;
        $jobcard->km_runing = $this->km_reading ?? 0;
        $jobcard->fual_level = $this->fual_level ?? 0;
        $jobcard->supervisor_id = $this->supervisor ?? 0;
        $jobcard->sms_alert = $this->sms_alert ?? 0;
        $jobcard->delivery_date = $this->delivery_date ?? Carbon::now();
        $jobcard->delivery_time = $this->delivery_time ?? Carbon::now();
        $jobcard->user_id = Auth::guard('workshop')->user()->id;
        $jobcard->save();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Job-Card Added Successfully!',
        ]);

        return redirect()->route('workshop.jobcard');
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
        $this->user_title = '';
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

    public function deleteDentImage()
    {
        $JobCardsDentMark = JobCardsDentMark::where('jobcard_number', $this->jobcardNumbers)->get();

        foreach ($JobCardsDentMark as $value) {
            UploadImage::find($value->file_id)?->delete();
        }

        JobCardsDentMark::where('jobcard_number', $this->jobcardNumbers)->delete();

        $this->reset('jobCardsDentImage', 'jobcarddentCount');

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Dent Car Image Successfully deleted!',
        ]);

        $this->showDentCar = false;
    }

    public function updatedCustType($value)
    {
        if ($value == 1) {
            $this->show_company_name = true;
        } else {
            $this->show_company_name = false;
        }
        $this->reset('company_name', 'name', 'user_title', 'lastname');
    }

    public function updatedBrandName($value)
    {
        $brand = json_decode($value, true);
        $brandId = $brand['id'] ?? null;
        $brandName = $brand['name'] ?? null;
        
        $this->selectedBrandId = $brandId;
        $this->vehicleBrand = $brandName;

        $this->variant_name = '';
        $this->selected_year = '';
        $this->modificationId = null;
        $this->search_vehicle = '';
        $this->selectedVehicleName = '';
        
        $this->years = [];
        $this->modifications = [];
        $this->all_modifications = [];

        if ($brandId) {
            try {
                $vehicleService = new RapidApiVehicleService();
                $modelsList = $vehicleService->getModelsList($brandId);
                $this->variants = collect($modelsList)->toArray();
            } catch (\Exception $e) {
                \Log::error('Error fetching models: ' . $e->getMessage());
                $this->variants = [];
            }
        } else {
            $this->variants = [];
        }
    }

    public function updatedVariantName($value)
    {
        $this->selected_year = '';
        $this->years = [];
        $this->modifications = [];
        $this->all_modifications = [];
        $this->search_vehicle = '';
        $this->modificationId = null;
        
        if (empty($value) && $value !== '0' && $value !== 0) {
            return;
        }

        $variant = $this->variants[$value] ?? null;
        
        if ($variant) {
            $modelId = $variant['id'] ?? null;
            $modelName = $variant['name'] ?? null;
            $modelYearFrom = $variant['modelYearFrom'] ?? null;
            $modelYearTo = $variant['modelYearTo'] ?? null;
            
            if ($modelId && $modelYearFrom) {
                $startYear = (int)substr($modelYearFrom, 0, 4);
                $endYear = $modelYearTo ? (int)substr($modelYearTo, 0, 4) : (int)date('Y');
                
                $yearRange = [];
                for ($year = $endYear; $year >= $startYear; $year--) {
                    $yearRange[] = [
                        'value' => $year,
                        'label' => $year
                    ];
                }
                $this->years = $yearRange;
            }
            
            $this->selectedModelId = $modelId;
            $this->search_vehicle = '';
            $this->selectedVehicleName = $modelName;
            $this->vehicle_id = $modelId;

            // Fetch modifications for this model using API
            try {
                $vehicleService = new RapidApiVehicleService();
                $typesList = $vehicleService->getVehicleTypesList($modelId);
                $this->all_modifications = $typesList->toArray();
            } catch (\Exception $e) {
                \Log::error('Error fetching modifications: ' . $e->getMessage());
                $this->all_modifications = [];
            }
        }
    }

    public function updatedSelectedYear($value)
    {
        $this->search_vehicle = '';
        $this->modificationId = null;
        $this->selectedVehicleName = '';
        
        if (empty($value) || empty($this->all_modifications)) {
            $this->modifications = [];
            return;
        }
        
        $selectedYear = (int)$value;
        
        $this->modifications = collect($this->all_modifications)
            ->filter(function($item) use ($selectedYear) {
                $yearFrom = $item['yearFrom'] ?? 0;
                $yearTo = $item['yearTo'] ?? date('Y');
                return $selectedYear >= $yearFrom && $selectedYear <= $yearTo;
            })
            ->values()
            ->toArray();
    }
}
