<?php

namespace App\Livewire\Workshop;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Notification;
use App\Models\Admin;
use App\Services\RapidApiVehicleService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]
class AppointmentController extends Component
{
    use WithPagination;

    public $isEdit = false;
    public $showModal = false;
    public $showViewModal = false;
    public $showCustomerModal = false;
    public $showVehicleModal = false;
    public $search = '';
    public $statusFilter = '';
    public $dateFilter = '';

    public $appointmentId;
    public $customer_id;
    public $customer_name;
    public $customer_phone;
    public $vehicle_id;
    public $vehicle_number_plate;
    public $appointment_date;
    public $appointment_time;
    public $issue_description;
    public $status = 'pending';
    public $notes;

    public $name, $email, $mobile_no, $address;
    public $lastname, $birth_date, $display_name;
    public $customers = [];
    public $vehicles = [];

    public $workshopId;
    public $states = [];
    public $cities = [];
    public $country_id, $state_id, $city_id;
    public $gst_no;
    public $show_company_name = false, $company_name, $cust_type = 0, $pincode;
    public $brand_name, $variant_name, $selected_year, $modificationId;
    public $brands = [], $variants = [], $years = [], $modifications = [], $all_modifications = [];
    public $selectedBrandId, $selectedModelId, $selectedEngineId;
    public $numberPlate, $chassisNo, $dateOfManufacturing, $engineNo, $pickup_address, $drop_address;
    public $driver_name, $driver_number, $policy_number, $insurance_name, $policy_expiry_date;
    public $selectedVehicleName, $vehicleBrand;
    public $user_title = 'mr';
    public $search_vehicle;
    public $selectedAppointment;

    protected $listeners = ['selectedCustomer','selectVehicleDetails'];

    protected $rules = [
        'vehicle_id' => 'required',
        'customer_id' => 'required',
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'required|string|max:20',
        'appointment_date' => 'required|date|after_or_equal:today',
        'appointment_time' => 'required',
        'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
    ];

    public function mount()
    {
        $this->workshopId = auth()->guard('workshop')->user()->id;
        $this->appointment_date = today()->format('Y-m-d');
        $this->appointment_time = now()->format('H:i');
        $this->loadCustomers();
        // $this->loadVehicles();
    }

    public function render()
    {
        // Fetch customer and vehicle data for info table (like Job Card)
        $customer_data = null;
        $vehicle_data = null;
        if (!empty($this->customer_id)) {
            $customer_data = Customer::find($this->customer_id);
        }
        if (!empty($this->vehicle_id)) {
            $vehicle_data = Vehicle::find($this->vehicle_id);
        }

        $query = Appointment::with(['customer', 'vehicle', 'jobCard'])
            ->where('workshop_id', auth()->guard('workshop')->user()->id);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('customer_name', 'like', '%' . $this->search . '%')
                    ->orWhere('customer_phone', 'like', '%' . $this->search . '%')
                    ->orWhere('vehicle_number_plate', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->dateFilter) {
            $query->whereDate('appointment_date', $this->dateFilter);
        }

        $appointments = $query->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->paginate(10);

        return view('livewire.workshop.appointment-controller', compact('appointments', 'customer_data', 'vehicle_data'));
    }

    public function openModal()
    {
        $this->reset(['appointmentId', 'customer_id', 'customer_name', 'customer_phone', 'vehicle_id', 'vehicle_number_plate', 'appointment_date', 'appointment_time', 'issue_description', 'status', 'notes']);
        $this->isEdit = false;
        $this->showModal = true;
        $this->appointment_date = today()->format('Y-m-d');
        $this->appointment_time = now()->format('H:i');
        $this->dispatch('reinitSelect2');
    }

    public function closeCustomerModal()
    {
        $this->showCustomerModal = false;
    }


    public function loadCustomers()
    {
        $this->customers = Customer::with('vehicles')->where('user_id', $this->workshopId)->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
        $this->variant_name = '';
        $this->selected_year = '';
        $this->search_vehicle = '';
        $this->modificationId = null;
        $this->modifications = [];
        $this->years = [];
        $this->variants = [];
        
        if (empty($value)) {
            return;
        }
        
        $brandId = null;
        $decodedValue = @json_decode($value, true);
        
        if ($decodedValue && is_array($decodedValue) && isset($decodedValue['id'])) {
            $brandId = $decodedValue['id'];
        }
        
        if (empty($brandId)) {
            return;
        }
        
        try {
            $this->selectedBrandId = $brandId;
            $vehicleService = new RapidApiVehicleService();
            $modelsList = $vehicleService->getModelsList($brandId);
            $this->variants = $modelsList->toArray();
        } catch (\Exception $e) {
            \Log::error('Error fetching models in AppointmentController: ' . $e->getMessage());
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

            try {
                $vehicleService = new RapidApiVehicleService();
                $typesList = $vehicleService->getVehicleTypesList($modelId);
                $this->all_modifications = $typesList->toArray();
            } catch (\Exception $e) {
                \Log::error('Error fetching modifications in AppointmentController: ' . $e->getMessage());
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

    public function fetchVehicleByVin()
    {
        $vin = trim(strtoupper($this->chassisNo ?? ''));
        if (empty($vin)) {
            $this->addError('chassisNo', 'Please enter 17-digit Chassis No (VIN).');
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Please enter 17-digit Chassis No / VIN first.',
            ]);
            return;
        }

        if (strlen($vin) !== 17) {
            $this->addError('chassisNo', 'Chassis No (VIN) must be exactly 17 characters. You entered ' . strlen($vin) . ' characters.');
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Chassis No (VIN) must be exactly 17 characters. (Entered: ' . strlen($vin) . ')',
            ]);
            return;
        }

        $this->resetErrorBag('chassisNo');

        // 🔹 RESET previous vehicle details so old/fake data is never retained!
        $this->variant_name = '';
        $this->selected_year = '';
        $this->search_vehicle = '';
        $this->modificationId = null;
        $this->selectedVehicleName = '';
        $this->vehicle_id = null;
        $this->selectedModelId = null;
        $this->years = [];
        $this->modifications = [];
        $this->all_modifications = [];

        try {
            $vehicleService = new RapidApiVehicleService();
            $vinData = $vehicleService->checkVinTecdoc($vin);

            if (empty($vinData)) {
                $this->brand_name = '';
                $this->selectedBrandId = null;
                $this->vehicleBrand = '';
                $this->variants = [];
                $this->dispatch('sync-searchable-selects');
                $this->dispatch('swal:toast', [
                    'type' => 'warning',
                    'message' => 'VIN not found in catalog. Please select vehicle details manually.',
                ]);
                return;
            }

            // Ensure brands are loaded
            if (empty($this->brands)) {
                $this->brands = collect($vehicleService->getBrandsList())->toArray();
            }

            $matchedManu = null;
            if (!empty($vinData['matchingManufacturers']['array'])) {
                $matchedManu = $vinData['matchingManufacturers']['array'][0] ?? null;
            }

            if (!$matchedManu) {
                $this->brand_name = '';
                $this->selectedBrandId = null;
                $this->vehicleBrand = '';
                $this->variants = [];
                $this->dispatch('sync-searchable-selects');
                $this->dispatch('swal:toast', [
                    'type' => 'warning',
                    'message' => 'No matching manufacturer found for this VIN in catalog.',
                ]);
                return;
            }

            $manuId = $matchedManu['manuId'] ?? null;
            $manuName = $matchedManu['manuName'] ?? '';

            // Find brand in $this->brands
            $matchedBrand = collect($this->brands)->first(function ($b) use ($manuId, $manuName) {
                $bId = is_array($b) ? ($b['id'] ?? null) : ($b->id ?? null);
                $bName = is_array($b) ? ($b['name'] ?? null) : ($b->name ?? null);
                return ($manuId && $bId == $manuId) || (strcasecmp($bName ?? '', $manuName) === 0);
            });

            if (!$matchedBrand) {
                $matchedBrand = ['id' => $manuId, 'name' => $manuName];
                $this->brands[] = $matchedBrand;
            }

            $this->brand_name = json_encode($matchedBrand);
            $this->selectedBrandId = $manuId;
            $this->vehicleBrand = is_array($matchedBrand) ? ($matchedBrand['name'] ?? $manuName) : $matchedBrand->name;

            // Fetch models for this manufacturer
            $modelsList = $vehicleService->getModelsList($manuId);
            $this->variants = collect($modelsList)->toArray();

            $matchedModel = null;
            if (!empty($vinData['matchingModels']['array'])) {
                $matchedModel = $vinData['matchingModels']['array'][0] ?? null;
            }

            if (!$matchedModel) {
                // Only Brand is detected! Keep Model, Year, Modification blank!
                $this->variant_name = '';
                $this->selected_year = '';
                $this->search_vehicle = '';
                $this->modificationId = null;
                $this->selectedVehicleName = '';
                $this->years = [];
                $this->modifications = [];
                $this->all_modifications = [];

                $this->dispatch('sync-searchable-selects');
                $this->dispatch('swal:toast', [
                    'type' => 'info',
                    'message' => "Brand '{$this->vehicleBrand}' detected. Model & Variant are not in catalog, please select manually.",
                ]);
                return;
            }

            $modelId = $matchedModel['modelId'] ?? null;
            $modelName = $matchedModel['modelName'] ?? '';

            // Find variant index in $this->variants
            $foundVariantIndex = null;
            foreach ($this->variants as $index => $v) {
                if (($modelId && ($v['id'] ?? null) == $modelId) || (strcasecmp($v['name'] ?? '', $modelName) === 0)) {
                    $foundVariantIndex = $index;
                    break;
                }
            }

            if ($foundVariantIndex === null && $modelId) {
                $this->variants[] = [
                    'id' => $modelId,
                    'name' => $modelName,
                    'modelYearFrom' => null,
                    'modelYearTo' => null,
                ];
                $foundVariantIndex = count($this->variants) - 1;
            }

            if ($foundVariantIndex !== null) {
                $this->variant_name = (string) $foundVariantIndex;
                $variant = $this->variants[$foundVariantIndex];

                $modelYearFrom = $variant['modelYearFrom'] ?? null;
                $modelYearTo = $variant['modelYearTo'] ?? null;

                if ($modelYearFrom) {
                    $startYear = (int) substr($modelYearFrom, 0, 4);
                    $endYear = $modelYearTo ? (int) substr($modelYearTo, 0, 4) : (int) date('Y');

                    $yearRange = [];
                    for ($year = $endYear; $year >= $startYear; $year--) {
                        $yearRange[] = [
                            'value' => $year,
                            'label' => $year
                        ];
                    }
                    $this->years = $yearRange;
                } else {
                    $this->years = [];
                }

                $this->selectedModelId = $modelId;
                $this->selectedVehicleName = $variant['name'] ?? $modelName;
                $this->vehicle_id = $modelId;

                // Decode VIN year from 10th character
                $decodedYear = RapidApiVehicleService::decodeVinYear($vin);
                if ($decodedYear) {
                    $this->selected_year = $decodedYear;
                    $yearExists = collect($this->years)->firstWhere('value', $decodedYear);
                    if (!$yearExists) {
                        array_unshift($this->years, ['value' => $decodedYear, 'label' => $decodedYear]);
                    }
                }

                // Fetch all modifications for this model
                $typesList = $vehicleService->getVehicleTypesList($modelId);
                $this->all_modifications = collect($typesList)->toArray();

                // Check matching vehicles from VIN check
                $matchingVehicles = $vinData['matchingVehicles']['array'] ?? [];
                if (!empty($matchingVehicles)) {
                    $matchingVehicleIds = collect($matchingVehicles)->pluck('vehicleId')->map(fn($id) => (int)$id)->toArray();

                    $filteredMods = collect($this->all_modifications)->filter(function ($m) use ($matchingVehicleIds) {
                        return in_array((int)($m['id'] ?? 0), $matchingVehicleIds);
                    })->values()->toArray();

                    if (!empty($filteredMods)) {
                        $this->modifications = $filteredMods;
                    } else {
                        $this->modifications = collect($matchingVehicles)->map(function ($mv) {
                            return [
                                'id' => $mv['vehicleId'] ?? null,
                                'name' => $mv['vehicleTypeDescription'] ?? ($mv['carName'] ?? ''),
                                'fuelType' => '',
                                'yearFrom' => '',
                                'yearTo' => '',
                            ];
                        })->values()->toArray();
                    }

                    if (!empty($this->modifications)) {
                        $this->search_vehicle = $this->modifications[0]['id'];
                        $this->updatedSearchVehicle($this->search_vehicle);
                    }
                } else {
                    if (!empty($this->selected_year)) {
                        $this->updatedSelectedYear($this->selected_year);
                    } else {
                        $this->modifications = $this->all_modifications;
                    }

                    if (!empty($this->modifications)) {
                        $this->search_vehicle = $this->modifications[0]['id'];
                        $this->updatedSearchVehicle($this->search_vehicle);
                    }
                }

                $this->dispatch('sync-searchable-selects');

                $this->dispatch('swal:toast', [
                    'type' => 'success',
                    'message' => "Vehicle details successfully auto-filled from VIN!",
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Error in fetchVehicleByVin: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Failed to decode VIN: ' . $e->getMessage(),
            ]);
        }
    }

    public function updatedModificationId($value)
    {
        $this->search_vehicle = $value;
        $mod = \App\Models\Modification::find($value);
        if ($mod) {
            $this->selectedVehicleName = $mod->brand_name . ' ' . $mod->variant_name . ' ' . $mod->year . ' ' . $mod->title;
            $this->modificationId = $mod;
        } else {
            $this->selectedVehicleName = '';
            $this->modificationId = null;
        }
    }

    public function stateData($countryId)
    {
        if ($countryId) {
            $this->states = \App\Models\State::where('country_id', $countryId)->get();
        } else {
            $this->states = [];
        }
    }

    public function cityData($stateId)
    {
        if ($stateId) {
            $this->cities = \App\Models\City::where('state_id', $stateId)->get();
        } else {
            $this->cities = [];
        }
    }

    public function updatedSearchVehicle($id)
    {
        if(empty($id)) {
            $this->selectedVehicleName = '';
            $this->modificationId = null;
            return;
        }

        $mod = collect($this->all_modifications)->firstWhere('id', $id);
        
        if($mod){
            $brandName = '';
            $brandDecoded = @json_decode($this->brand_name, true);
            if ($brandDecoded && is_array($brandDecoded)) {
                $brandName = $brandDecoded['name'] ?? '';
            } else if (is_array($this->brand_name)) {
                $brandName = $this->brand_name['name'] ?? '';
            }
            
            if (empty($brandName) && $this->selectedBrandId) {
                $brandName = collect($this->brands)->firstWhere('id', $this->selectedBrandId)['name'] ?? '';
            }

            $variantName = '';
            if (isset($this->variants[$this->variant_name])) {
                $variantName = $this->variants[$this->variant_name]['name'] ?? '';
            }

            $this->modificationId = (object)[
                'id' => $mod['id'],
                'brand_name' => $brandName,
                'variant_name' => $variantName,
                'year' => $this->selected_year,
                'title' => $mod['name']
            ];

            $brand = $this->modificationId->brand_name ?? '';
            $model = $this->modificationId->variant_name ?? '';
            $modName = $this->modificationId->title ?? '';
            
            $yearRange = ($mod['yearFrom'] ?? '') . '-' . ($mod['yearTo'] ?? '');
            $fuel = $mod['fuelType'] ? ' - ' . $mod['fuelType'] : '';

            $this->selectedVehicleName = trim("$brand $model | $modName ($yearRange)$fuel");
        } else {
            $localMod = \App\Models\Modification::find($id);
            if ($localMod) {
                $this->modificationId = $localMod;
                $this->selectedVehicleName = trim("{$localMod->brand_name} {$localMod->variant_name} | {$localMod->title} ({$localMod->year})");
            } else {
                $this->selectedVehicleName = '';
            }
        }
    }

    public function selectVehicleDetails($data)
    {
        $vehicleId = is_array($data) ? ($data['vehicleId'] ?? null) : $data;
        if (!$vehicleId) return;
        
        $this->vehicle_id = $vehicleId;
        $vehicle_data = Vehicle::find($vehicleId);
        if ($vehicle_data) {
            $this->customer_id = $vehicle_data->customer_id;
            $customer = Customer::find($this->customer_id);
            if ($customer) {
                $this->customer_name = trim(($customer->name ?? '') . ' ' . ($customer->lastname ?? ''));
                $this->customer_phone = $customer->mobile_no ?? '';
            }
            $this->vehicle_number_plate = $vehicle_data->number_plate;
        }
        
        $this->resetValidation(['vehicle_id', 'customer_id', 'customer_name', 'customer_phone']);
    }

    public function selectedCustomer($customer)
    {
        $this->selectVehicleDetails($customer);
    }

    public function addCustomer()
    {
        $this->showCustomerModal = true;
        
        try {
            $vehicleService = new RapidApiVehicleService();
            $this->brands = collect($vehicleService->getBrandsList())->toArray();
        } catch (\Exception $e) {
            \Log::error('Error loading brands in AppointmentController: ' . $e->getMessage());
            $this->brands = [];
        }
        
        $this->variants = [];
        $this->years = [];
        $this->modifications = [];
        $this->all_modifications = [];

        $this->reset('modificationId', 'show_company_name', 'cust_type', 'search_vehicle', 'selectedVehicleName', 'states', 'cities', 'name', 'lastname', 'mobile_no', 'address', 'insurance_name', 'policy_expiry_date', 'gst_no', 'country_id', 'state_id', 'city_id', 'email', 'birth_date', 'user_title', 'numberPlate', 'chassisNo', 'dateOfManufacturing', 'engineNo', 'pickup_address', 'drop_address', 'driver_name', 'driver_number', 'policy_number', 'brand_name', 'variant_name', 'selected_year', 'selectedBrandId', 'selectedModelId', 'selectedEngineId');
    }

    public function openCustomerModal()
    {
        $this->addCustomer();
    }

    public function storeCustomer()
    {
        $valArr = [
            'cust_type' => "required",
            'name' => ["required_if:cust_type,0", 'nullable', 'regex:/^[a-zA-Z\s]+$/'],
            'lastname' => ["required_if:cust_type,0", 'nullable', 'regex:/^[a-zA-Z\s]+$/'],
            'company_name' => ["required_if:cust_type,1", 'nullable', 'regex:/^[a-zA-Z\s]+$/'],
            'mobile_no' => ["required", "min:10"],
            'address' => ["nullable"],
            'email' => ["nullable", "email"],
            'birth_date' => ["nullable"],
            'user_title' => ["required"],
            'numberPlate' => ["required"],
            'search_vehicle' => ["required"],
            'chassisNo' => ["required"],
        ];

        $this->validate($valArr, [
            'name.required_if' => 'The first name field is required.',
            'lastname.required_if' => 'The last name field is required.',
            'company_name.required_if' => 'The company name field is required.',
        ]);

        if (empty($this->search_vehicle)) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Please select the complete Vehicle details (Modification)',
            ]);
            return;
        }

        $customerSerch = Customer::where('mobile_no', $this->mobile_no)->where('user_id', $this->workshopId)->first();

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
        $vehicle->date_of_manufacturing = $this->dateOfManufacturing;
        $vehicle->engineno = $this->engineNo;
        $vehicle->driver_name = $this->driver_name;
        $vehicle->driver_number = $this->driver_number;
        $vehicle->policy_number = $this->policy_number;
        $vehicle->insurance_name = $this->insurance_name;
        $vehicle->pickup_address = $this->pickup_address;
        $vehicle->drop_address = $this->drop_address;
        $vehicle->policy_expiry_date = $this->policy_expiry_date;
        $vehicle->customer_id = $customer->id;
        $vehicle->save();

        $this->customer_id = $customer->id;
        $this->customer_name = trim(($customer->name ?? '') . ' ' . ($customer->lastname ?? ''));
        $this->customer_phone = $customer->mobile_no;
        $this->vehicle_id = $vehicle->id;
        $this->vehicle_number_plate = $vehicle->number_plate;

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Customer and Vehicle added successfully!',
        ]);

        $this->showCustomerModal = false;
    }

    public function openVehicleModal()
    {
        $this->reset(['number_plate', 'chassis_no', 'brand', 'variant', 'year', 'modification']);
        $this->showVehicleModal = true;
    }

    public function closeVehicleModal()
    {
        $this->showVehicleModal = false;
    }

    public function storeVehicle()
    {
        $this->validate([
            'number_plate' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        $vehicle = Vehicle::create([
            'number_plate' => $this->number_plate,
            'chassis_no' => $this->chassis_no,
            'brand' => $this->brand,
            'variant' => $this->variant,
            'year' => $this->year,
            'modification' => $this->modification,
        ]);

        $this->vehicle_id = $vehicle->id;
        $this->vehicle_number_plate = $vehicle->number_plate;

        $this->loadVehicles();
        $this->closeVehicleModal();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicle added successfully!',
        ]);
    }

    public function selectCustomer($customerId)
    {
        $customer = Customer::find($customerId);
        if ($customer) {
            $this->customer_id = $customer->id;
            $this->customer_name = trim(($customer->name ?? '') . ' ' . ($customer->lastname ?? ''));
            $this->customer_phone = $customer->mobile_no ?? '';
            // Auto-select customer's vehicle
            $vehicle = Vehicle::where('customer_id', $customer->id)->first();
            if ($vehicle) {
                $this->vehicle_id = $vehicle->id;
                $this->vehicle_number_plate = $vehicle->number_plate ?? '';
            }
        }
    }

    public function selectVehicle($vehicleId)
    {
        $vehicle = Vehicle::find($vehicleId);
        $this->vehicle_id = $vehicle->id;
        $this->vehicle_number_plate = $vehicle->number_plate;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        try {
            $this->validate();

            $appointment = Appointment::create([
                'workshop_id' => auth()->guard('workshop')->user()->id,
                'customer_id' => $this->customer_id,
                'customer_name' => $this->customer_name,
                'customer_phone' => $this->customer_phone,
                'vehicle_id' => $this->vehicle_id,
                'vehicle_number_plate' => $this->vehicle_number_plate,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'issue_description' => $this->issue_description,
                'status' => $this->status,
                'notes' => $this->notes,
            ]);

            Notification::create([
                'user_id' => auth()->guard('workshop')->user()->id,
                'order_id' => null,
                'title' => '📅 New Appointment',
                'message' => "New appointment #{$appointment->id} created for {$appointment->customer_name} on {$appointment->appointment_date} at {$appointment->appointment_time}.",
                'sound' => 'appointment.mp3',
            ]);

            $adminIds = Admin::where('role_type', 21)->pluck('id');
            foreach ($adminIds as $adminId) {
                Notification::create([
                    'user_id' => $adminId,
                    'order_id' => null,
                    'title' => '📅 New Appointment',
                    'message' => "New appointment #{$appointment->id} created for customer {$appointment->customer_name} on {$appointment->appointment_date}.",
                    'sound' => 'appointment.mp3',
                ]);
            }

            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Appointment added successfully!',
            ]);

            $this->reset(['appointmentId', 'customer_id', 'customer_name', 'customer_phone', 'vehicle_id', 'vehicle_number_plate', 'appointment_date', 'appointment_time', 'issue_description', 'status', 'notes']);
            $this->showModal = false;
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        $appointment = Appointment::find($id);
        $this->appointmentId = $appointment->id;
        $this->customer_id = $appointment->customer_id;
        $this->customer_name = $appointment->customer_name;
        $this->customer_phone = $appointment->customer_phone;
        $this->vehicle_id = $appointment->vehicle_id;
        $this->vehicle_number_plate = $appointment->vehicle_number_plate;
        $this->appointment_date = $appointment->appointment_date->format('Y-m-d');
        $this->appointment_time = $appointment->appointment_time->format('H:i');
        $this->issue_description = $appointment->issue_description;
        $this->status = $appointment->status;
        $this->notes = $appointment->notes;

        $this->isEdit = true;
        $this->showModal = true;
        $this->dispatch('reinitSelect2');
    }

    public function update()
    {
        try {
            $this->validate();

            $appointment = Appointment::find($this->appointmentId);
            $appointment->update([
                'customer_id' => $this->customer_id,
                'customer_name' => $this->customer_name,
                'customer_phone' => $this->customer_phone,
                'vehicle_id' => $this->vehicle_id,
                'vehicle_number_plate' => $this->vehicle_number_plate,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'issue_description' => $this->issue_description,
                'status' => $this->status,
                'notes' => $this->notes,
            ]);

            Notification::create([
                'user_id' => auth()->guard('workshop')->user()->id,
                'order_id' => null,
                'title' => '✏️ Appointment Updated',
                'message' => "Appointment #{$appointment->id} details have been updated for {$appointment->customer_name}.",
                'sound' => 'appointment.mp3',
            ]);

            $adminIds = Admin::where('role_type', 21)->pluck('id');
            foreach ($adminIds as $adminId) {
                Notification::create([
                    'user_id' => $adminId,
                    'order_id' => null,
                    'title' => '✏️ Appointment Updated',
                    'message' => "Appointment #{$appointment->id} details have been updated for customer {$appointment->customer_name}.",
                    'sound' => 'appointment.mp3',
                ]);
            }

            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Appointment updated successfully!',
            ]);

            $this->showModal = false;
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function delete($id)
    {
        Appointment::find($id)->delete();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Appointment deleted successfully!',
        ]);
    }

    public function resetFilters()
    {
        $this->reset(['search', 'statusFilter', 'dateFilter']);
    }
    public function convertToJobCard($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment) {
            return redirect()->route('workshop.jobcardadd', [
                'appointment_id' => $appointment->id
            ]);
        }
    }
    public function view($id)
    {
        $this->selectedAppointment = Appointment::with(['customer', 'vehicle'])->find($id);
        if ($this->selectedAppointment) {
            $this->appointmentId = $this->selectedAppointment->id;
            $this->customer_id = $this->selectedAppointment->customer_id;
            $this->customer_name = $this->selectedAppointment->customer_name;
            $this->customer_phone = $this->selectedAppointment->customer_phone;
            $this->vehicle_id = $this->selectedAppointment->vehicle_id;
            $this->vehicle_number_plate = $this->selectedAppointment->vehicle_number_plate;
            $this->appointment_date = $this->selectedAppointment->appointment_date->format('Y-m-d');
            $this->appointment_time = $this->selectedAppointment->appointment_time->format('H:i');
            $this->issue_description = $this->selectedAppointment->issue_description;
            $this->status = $this->selectedAppointment->status;
            $this->notes = $this->selectedAppointment->notes;
            
            $this->showViewModal = true;
        }
    }

    public function updateStatus($newStatus)
    {
        $appointment = Appointment::find($this->appointmentId);
        if ($appointment) {
            $appointment->status = $newStatus;
            $appointment->save();
            $this->status = $newStatus;

            Notification::create([
                'user_id' => auth()->guard('workshop')->user()->id,
                'order_id' => null,
                'title' => '🔄 Appointment Status Updated',
                'message' => "Appointment #{$appointment->id} status changed to '{$newStatus}' for {$appointment->customer_name}.",
                'sound' => 'appointment.mp3',
            ]);

            $adminIds = Admin::where('role_type', 21)->pluck('id');
            foreach ($adminIds as $adminId) {
                Notification::create([
                    'user_id' => $adminId,
                    'order_id' => null,
                    'title' => '🔄 Appointment Status Updated',
                    'message' => "Appointment #{$appointment->id} status changed to '{$newStatus}' for customer {$appointment->customer_name}.",
                    'sound' => 'appointment.mp3',
                ]);
            }

            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Status updated successfully!',
            ]);
        }
    }

    public function closeViewModal()
    {
        $this->showViewModal = false;
    }
}
