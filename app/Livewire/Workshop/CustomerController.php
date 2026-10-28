<?php

namespace App\Livewire\Workshop;

use App\Models\{City, Staff, Country, State, Branch, Customer, WorkShopVendor, Vehicle};
use App\Models\Appointment;
use App\Models\JobCard;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Services\RapidApiVehicleService;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use App\Models\Modification;

#[Layout('components.layouts.workshop-app')]
class CustomerController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address,$pincode, $user_title = 'mr', $birth_date, $display_name, $branches;
    public $customerId, $workshopId, $add, $countries, $isEdits, $user, $cust_type = 0, $company_name,$search_vehicle,$selectedVehicleName, $brand_name, $variant_name, $selected_year;
    public $brands = [], $variants = [], $years = [], $modifications = [], $all_modifications = [], $customer_name;
    public $vehicle_id, $vehicleBrand, $modelName, $fuel_id, $odometerReading, $numberPlate, $chassisNo, $modelYear, $noOfGear,$engineNo,$dateOfManufacturing;
    public $customer_type,$search_customer_voice,$search_accessory,$search_work_notes,$driver_name,$driver_number,$policy_number,$insurance_name,$gstin_number,$policy_expiry_date,$pickup_address,$drop_address;
    public $states = [];
    public  $gearbox, $gearboxNo, $engineN, $engineSize, $engine, $keyNo, $isOpen, $property_photos = [];
    public $modificationId, $vehicle_type_id;
    public $cities = [], $searchCustomer, $gst_no;
    // API Vehicle Properties
    public $selectedBrandId, $selectedModelId, $selectedEngineId;
    protected $listeners = ['delete'];
    protected $rules = [];

    public function mount()
    {
        $this->countries = Country::all();
        $this->user = Auth::guard('workshop')->user();
        $this->workshopId = $this->user->id;
        $this->branches = Branch::get();
        
        try {
            // Use RapidAPI to get brands
            $vehicleService = new RapidApiVehicleService();
            $brandsList = $vehicleService->getBrandsList();
            
            // Convert to array format for the view
            $this->brands = $brandsList->toArray();
            
            \Log::info('Brands loaded:', ['count' => count($this->brands), 'brands' => $this->brands]);
            
            if (empty($this->brands)) {
                \Log::warning('No brands returned from RapidAPI');
                $this->dispatch('swal:toast', [
                    'type' => 'warning',
                    'message' => 'Unable to load vehicle brands. Please check your API key.',
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Error loading brands: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            $this->brands = [];
        }
    }


    public function render()
    {
        $user = WorkShopVendor::find($this->workshopId);

        $search = trim(preg_replace('/\s+/', ' ', $this->searchCustomer));

         $customers = Customer::where('user_id', ($user->is_user == 0 ? $this->workshopId : $user->parent_id))
        ->with(['user', 'vehicles']);

        if ($search) {
            $customers = $customers->where(function ($query) use ($search) {
                $query->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%$search%"])
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('mobile_no', 'like', '%' . $search . '%')
                    ->orWhere('company_name', 'like', '%' . $search . '%');
            });
        }

        $customers = $customers->orderBy('created_at', 'desc')->paginate(10);


        return view('livewire.workshop.customer', compact('customers'));
    }

    /**
     * Delete a customer and all related data (appointments, job cards, orders, vehicles, etc.).
     * This method is triggered via the Livewire listener `delete`.
     */
    /**
     * Delete a customer and all related data.
     *
     * Livewire listeners invoke methods without automatically injecting parameters.
     * The customer ID is stored in the component's `$customerId` property (set via
     * `confirmDelete`). Therefore the method should not expect a parameter; otherwise
     * the container attempts to resolve it and throws a BindingResolutionException.
     */
    public function delete()
    {
        $customer = Customer::find($this->customerId);
        if (! $customer) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Customer not found.',
            ]);
            return;
        }

        DB::transaction(function () use ($customer) {
            // Delete appointments linked to this customer
            Appointment::where('customer_id', $customer->id)->delete();

            // Delete each job card and its related records
            foreach ($customer->jobCards as $jobCard) {
                // Delete associated order (if any)
                $jobCard->order?->delete();

                // Delete related payments, extra charges, spare parts, etc.
                $jobCard->payments()->delete();
                $jobCard->labours()->delete();
                $jobCard->jobCardSpareParts()->delete();

                // Finally delete the job card itself
                $jobCard->delete();
            }

            // Delete vehicles belonging to the customer
            $customer->vehicles()->delete();

            // Delete the customer record
            $customer->delete();
        });

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Customer and all related data have been deleted.',
        ]);

        // Refresh the list
        $this->resetPage();
    }



    public function create()
    {
        $this->resetForm();
        $this->resetErrorBag();
        $this->isEdit = false;
        $this->showModal = true;
    }
    public function updatedSearchVehicle($id)
    {
        if(empty($id)) {
            $this->selectedVehicleName = '';
            $this->modificationId = null;
            return;
        }

        // Find from all_modifications first, if not find from DB (for edit view)
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
        
        // Try to decode JSON value first
        $brandId = null;
        $decodedValue = @json_decode($value, true);
        
        if ($decodedValue && is_array($decodedValue) && isset($decodedValue['id'])) {
            $brandId = $decodedValue['id'];
            \Log::info('Brand selected', ['brandId' => $brandId, 'name' => $decodedValue['name']]);
        }
        
        if (empty($brandId)) {
            \Log::warning('Could not extract brand ID from value: ' . $value);
            return;
        }
        
        try {
            $this->selectedBrandId = $brandId;
            $vehicleService = new RapidApiVehicleService();
            $modelsList = $vehicleService->getModelsList($brandId);
            
            \Log::info('Models fetched', ['count' => count($modelsList), 'brandId' => $brandId]);
            
            $this->variants = $modelsList->toArray();
        } catch (\Exception $e) {
            \Log::error('Error fetching models: ' . $e->getMessage());
            $this->variants = [];
        }
    }

    public function updatedVariantName($value)
    {
        \Log::info('Variant updated', ['value' => $value, 'type' => gettype($value), 'variants_count' => count($this->variants)]);
        
        $this->selected_year = '';
        $this->years = [];
        $this->modifications = [];
        $this->all_modifications = [];
        $this->search_vehicle = '';
        $this->modificationId = null;
        
        if (empty($value) || !isset($this->variants[$value])) {
            \Log::warning('Variant value invalid', ['value' => $value, 'variants' => count($this->variants)]);
            return;
        }
        
        // Get the variant data from the array using index
        $variant = $this->variants[$value];
        \Log::info('Variant data', ['variant' => $variant]);
        
        $modelId = $variant['id'] ?? null;
        $modelName = $variant['name'] ?? null;
        $modelYearFrom = $variant['modelYearFrom'] ?? null;
        $modelYearTo = $variant['modelYearTo'] ?? null;
        
        if ($modelId && $modelYearFrom) {
            $yearFrom = (int)substr($modelYearFrom, 0, 4);
            $yearTo = $modelYearTo ? (int)substr($modelYearTo, 0, 4) : (int)date('Y');
            
            // Generate year range
            $yearsArray = range($yearFrom, $yearTo);
            $this->years = array_reverse($yearsArray); // Show newest first
            
            \Log::info('Years extracted', [
                'from' => $yearFrom,
                'to' => $yearTo,
                'count' => count($yearsArray),
                'years' => $this->years
            ]);
            
            $this->selectedModelId = $modelId;
            $this->search_vehicle = '';
            $this->selectedVehicleName = $modelName;
            $this->vehicle_id = $modelId;

            // Fetch modifications for this model using API
            try {
                $vehicleService = new RapidApiVehicleService();
                $typesList = $vehicleService->getVehicleTypesList($modelId);
                $this->all_modifications = $typesList->toArray();
                // \Log::info('Modifications fetched', ['count' => count($this->all_modifications), 'modelId' => $modelId]);
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
        
        // Filter modifications by year range (yearFrom <= selectedYear <= yearTo)
        $this->modifications = collect($this->all_modifications)
            ->filter(function($item) use ($selectedYear) {
                $yearFrom = $item['yearFrom'] ?? 0;
                $yearTo = $item['yearTo'] ?? date('Y'); // If no end year, assume it's ongoing
                return $selectedYear >= $yearFrom && $selectedYear <= $yearTo;
            })
            ->values()
            ->toArray();
    }

    public function updatedChassisNo($value)
    {
        $clean = trim(strtoupper($value));
        if (strlen($clean) === 17) {
            $this->fetchVehicleByVin();
        }
    }

    public function fetchVehicleByVin()
    {
        $vin = trim(strtoupper($this->chassisNo));
        if (empty($vin)) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Please enter Chassis No / VIN first.',
            ]);
            return;
        }

        if (strlen($vin) < 5) {
            $this->dispatch('swal:toast', [
                'type' => 'warning',
                'message' => 'Please enter a valid VIN (minimum 5 characters).',
            ]);
            return;
        }

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
                    $yearFrom = (int) substr($modelYearFrom, 0, 4);
                    $yearTo = $modelYearTo ? (int) substr($modelYearTo, 0, 4) : (int) date('Y');

                    $yearsArray = range($yearFrom, $yearTo);
                    $this->years = array_reverse($yearsArray);
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
                    if (!in_array($decodedYear, $this->years)) {
                        array_unshift($this->years, $decodedYear);
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

    public function selectModification($value)
    {
        // For now, this is called when a model is selected, so just treat it as final selection
        $this->search_vehicle = $value;
        $this->vehicle_id = $value;
        
        // The selectedVehicleName is already set in updatedVariantName
    }
    public function updatedCustomerName($vehicleId)
    {


        $this->vehicle_id = $vehicleId;

        return true;
    }


//     public function store()
//     {
// // dd($this->all());
//         $valArr = [
//             'name' => "required",
//             'lastname' => "required",
//             // 'email' => "required",
//             'mobile_no' => "required|digits:10",
//             'pincode' => "required|digits:6",
//             // 'cust_type' => "required",
//             'address' => "required",
//             'country_id' => "required",
//             'state_id' => "required",
//             'city_id' => "required",
//             // 'user_title' => "required",
//             // 'birth_date' => "required",
//         ];

//         $messages = [
//             'name.required' => "The first name field is required.",
//             'lastname.required' => "The last name field is required.",
//         ];

//         $this->validate($valArr, $messages);
//         $customer = new Customer;
//         $customer->name = $this->name;
//         $customer->lastname = $this->lastname;
//      $customer->user_title = $this->user_title ?? null;

// $customer->birth_date = !empty($this->birth_date)
//     ? date('Y-m-d', strtotime($this->birth_date))
//     : null;

// $customer->email = $this->email ?? null;

//         $customer->mobile_no = $this->mobile_no;
//         // $customer->cust_type = $this->cust_type ;
//         $customer->cust_type = $this->cust_type !== '' && $this->cust_type !== null ? (int)$this->cust_type : 0;

//         $customer->company_name = $this->company_name;
//         $customer->address = $this->address;
//         $customer->pincode = $this->pincode;
//         $customer->country_id = $this->country_id;
//         $customer->state_id = $this->state_id;
//         $customer->city_id = $this->city_id;
//         $customer->user_id = $this->workshopId;
//         $customer->gst_number = $this->gst_no;
//         $customer->save();


//         $this->dispatch('swal:toast', [
//             'type' => 'success',
//             'message' => 'Customer added successfully!',
//         ]);

//         $this->resetForm();
//         $this->resetErrorBag();
//         $this->showModal = false;
//     }

public function store()
{
    // Validation rules
    $valArr = [
        'name' => "required",
        // Last name is now optional
        // 'lastname' => "nullable",
        'mobile_no' => "required|digits:10",
        'pincode' => "nullable|digits:6", // optional now
        'address' => "required",
    ];

    $messages = [
        'name.required' => "The first name field is required.",
        // 'lastname.required' => "The last name field is required.",
    ];
    $this->validate($valArr, $messages);

if (empty($this->search_vehicle)) {
    $this->dispatch('swal:toast', [
        'type' => 'error',
        'message' => 'Please select the complete Vehicle details (Modification)',
    ]);
    return;
}


  $customerSerch = Customer::where('mobile_no', $this->mobile_no)->where('user_id',$this->workshopId)->first();

  if (empty($customerSerch)) {
    $customer = new Customer;
    $customer->name = $this->name;
    $customer->lastname = $this->lastname;
    $customer->user_title = $this->user_title ?: null;
    $customer->birth_date = !empty($this->birth_date) ? date('Y-m-d', strtotime($this->birth_date)) : null;
    $customer->email = $this->email ?: null;
    $customer->mobile_no = $this->mobile_no;
    $customer->cust_type = $this->cust_type !== '' && $this->cust_type !== null ? (int)$this->cust_type : 0;
    $customer->company_name = $this->company_name ?: null;
    $customer->address = $this->address;
    $customer->pincode = $this->pincode ?: null;
    $customer->country_id = $this->country_id ?: null;
    $customer->state_id = $this->state_id ?: null;
    $customer->city_id = $this->city_id ?: null;
    $customer->user_id = $this->workshopId;
    $customer->gst_number = $this->gst_no ?: null;
            $customer->save();
  } else {
            $customer = $customerSerch;
  }
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
        $vehicle->number_plate = $this->numberPlate ?? '';
        $vehicle->chassis_no = $this->chassisNo;
        $vehicle->date_of_manufacturing = $this->dateOfManufacturing;
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



        $this->customer_name = $customer->id;
        $this->vehicle_id = $vehicle->id;

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Customer added successfully!',
        ]);

       $this->reset('vehicle_type_id','modelName','selectedVehicleName','states','cities','name','lastname','mobile_no','address','insurance_name','policy_expiry_date','gst_no','country_id','state_id','city_id','email','birth_date','user_title','numberPlate','fuel_id','chassisNo','modelYear','noOfGear','dateOfManufacturing','gearbox','gearboxNo','engineNo','engineSize','engine','keyNo','pickup_address','drop_address','driver_name','driver_number','policy_number');
        $this->showModal = false;
    }




    // public function edit($id)
    // {
    //     $this->resetErrorBag();
    //     $this->isEdit = true;
    //     $customer = Customer::findOrFail($id);

    //     $this->customerId = $customer->id;
    //     $this->name = $customer->name;
    //     $this->lastname = $customer->lastname;
    //     $this->user_title = $customer->user_title;
    //     $this->email = $customer->email;
    //     $this->mobile_no = $customer->mobile_no;
    //     $this->cust_type = $customer->cust_type;
    //     $this->company_name = $customer->company_name;
    //     $this->branch_name = $customer->branch_name;
    //     $this->landline_no = $customer->landline_no;
    //     $this->country_id = $customer->country_id;
    //     $this->state_id = $customer->state_id;
    //     $this->city_id = $customer->city_id;
    //     $this->address = $customer->address;
    //     $this->pincode = $customer->pincode;
    //     $this->birth_date = $customer->birth_date;
    //     $this->display_name = $customer->display_name;
    //     $this->gst_no = $customer->gst_number;
    //     $this->stateData($customer->country_id);
    //     $this->cityData($customer->state_id);

    //     $this->showModal = true;
    // }

// public function edit($id)
// {
//     $this->resetErrorBag();
//     $this->isEdit = true;

//     $customer = Customer::findOrFail($id);
//     $this->customerId = $customer->id;
//     $this->name = $customer->name;
//     $this->lastname = $customer->lastname;
//     $this->user_title = $customer->user_title;
//     $this->email = $customer->email;
//     $this->mobile_no = $customer->mobile_no;
//     $this->cust_type = $customer->cust_type;
//     $this->company_name = $customer->company_name;
//     $this->branch_name = $customer->branch_name;
//     $this->landline_no = $customer->landline_no;
//     $this->country_id = $customer->country_id;
//     $this->state_id = $customer->state_id;
//     $this->city_id = $customer->city_id;
//     $this->address = $customer->address;
//     $this->pincode = $customer->pincode;
//     $this->birth_date = $customer->birth_date;
//     $this->display_name = $customer->display_name;
//     $this->gst_no = $customer->gst_number;

//     $this->stateData($customer->country_id);
//     $this->cityData($customer->state_id);

//     // Load related vehicle
//     $vehicle = Vehicle::where('customer_id', $customer->id)->latest()->first();
//     if ($vehicle) {
//         $this->vehicle_id = $vehicle->id;
//         $this->modificationId = $vehicle->modification_id;
//         $this->numberPlate = $vehicle->number_plate;
//         $this->chassisNo = $vehicle->chassis_no;
//         $this->engineNo = $vehicle->engineno;
//         $this->driver_name = $vehicle->driver_name;
//         $this->driver_number = $vehicle->driver_number;
//         $this->policy_number = $vehicle->policy_number;
//         $this->insurance_name = $vehicle->insurance_name;
//         $this->pickup_address = $vehicle->pickup_address;
//         $this->drop_address = $vehicle->drop_address;
//         $this->policy_expiry_date = $vehicle->policy_expiry_date;
//         $this->dateOfManufacturing = $vehicle->date_of_manufacturing;
//     }

//     $this->showModal = true;
// }

    // public function update()
    // {

    //     $valArr = [
    //         'name' => ["required"],
    //         'lastname' => ["required"],
    //         // 'email' => ["required"],
    //         'mobile_no' => "required|digits:10",
    //         'pincode' => "required|digits:6",
    //         'cust_type' => ["required"],
    //         'address' => ["required"],
    //         'country_id' => ["required"],
    //         'state_id' => ["required"],
    //         'city_id' => ["required"],

    //     ];

    //     $this->validate($valArr);


    //     $customer = Customer::find($this->customerId);
    //     $customer->name = $this->name;
    //     $customer->lastname = $this->lastname;
    //     $customer->user_title = $this->user_title;
    //     $customer->birth_date = date('Y-m-d', strtotime($this->birth_date));
    //     $customer->email = $this->email;
    //     $customer->mobile_no = $this->mobile_no;
    //     $customer->cust_type = $this->cust_type;
    //     $customer->company_name = $this->company_name;
    //     $customer->address = $this->address;
    //     $customer->pincode = $this->pincode;
    //     $customer->country_id = $this->country_id;
    //     $customer->state_id = $this->state_id;
    //     $customer->city_id = $this->city_id;
    //     $customer->user_id = $this->workshopId;
    //     $customer->gst_number = $this->gst_no;
    //     $customer->save();


    //     $this->dispatch('swal:toast', [
    //         'type' => 'success',
    //         'message' => 'Customer updated successfully!',
    //     ]);

    //     $this->showModal = false;
    // }

public function edit($id)
{
    $this->resetErrorBag();
    $this->isEdit = true;
    $this->customerId = $id;

    // Load customer with their vehicles
    $customer = Customer::with('vehicles')->findOrFail($id);

    // Set customer properties
    $this->name = $customer->name;
    $this->lastname = $customer->lastname;
    $this->user_title = $customer->user_title;
    $this->email = $customer->email;
    $this->mobile_no = $customer->mobile_no;
    $this->cust_type = $customer->cust_type;
    $this->company_name = $customer->company_name;
    $this->address = $customer->address;
    $this->country_id = $customer->country_id;
    $this->state_id = $customer->state_id;
    $this->city_id = $customer->city_id;
    $this->pincode = $customer->pincode;
    $this->birth_date = $customer->birth_date ? date('Y-m-d', strtotime($customer->birth_date)) : null;
    $this->gst_no = $customer->gst_number;

    // Load states and cities based on country/state
    $this->stateData($customer->country_id);
    $this->cityData($customer->state_id);

    // Load vehicle data if exists
    if ($customer->vehicles->isNotEmpty()) {
        $vehicle = $customer->vehicles->first();
        $this->vehicle_id = $vehicle->id;
        $this->search_vehicle = $vehicle->modification_id;
        $this->numberPlate = $vehicle->number_plate;
        $this->chassisNo = $vehicle->chassis_no;
        $this->engineNo = $vehicle->engineno;
        $this->dateOfManufacturing = $vehicle->date_of_manufacturing;
        $this->pickup_address = $vehicle->pickup_address;
        $this->drop_address = $vehicle->drop_address;
        $this->driver_name = $vehicle->driver_name;
        $this->driver_number = $vehicle->driver_number;
        $this->policy_number = $vehicle->policy_number;
        $this->insurance_name = $vehicle->insurance_name;
        $this->policy_expiry_date = $vehicle->policy_expiry_date;

        // Fetch API modifications to populate dropdowns correctly if possible
        try {
            $brandNameStr = is_object($vehicle) ? $vehicle->brand : '';
            $variantNameStr = is_object($vehicle) ? $vehicle->variant : '';
            $this->brand_name = collect($this->brands)->firstWhere('name', $brandNameStr)['id'] ?? null;
            if ($this->brand_name) {
                $this->updatedBrandName(json_encode(['id' => $this->brand_name, 'name' => $brandNameStr]));
                $variantIndex = collect($this->variants)->search(function ($item) use ($variantNameStr) {
                    return $item['name'] === $variantNameStr;
                });
                if ($variantIndex !== false) {
                    $this->variant_name = $variantIndex;
                    $this->updatedVariantName($variantIndex);
                    $this->selected_year = $vehicle->year;
                    $this->updatedSelectedYear($vehicle->year);
                    $this->search_vehicle = $vehicle->modification_id;
                    $this->updatedSearchVehicle($vehicle->modification_id);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error loading old vehicle API data: ' . $e->getMessage());
        }
    }

    $this->showModal = true;
}

public function update()
{
    // Validation rules
        $valArr = [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            // Last name is now optional; keep regex if provided
            'lastname' => ['nullable', 'regex:/^[a-zA-Z\s]+$/'],
            'mobile_no' => ['required', 'min:10'],
            'address' => ['required'],
            'search_vehicle' => ['required'],
            // 'numberPlate' => ['required'],
            // 'chassisNo' => ['required'],
        ];

    $this->validate($valArr, [
        'name.required' => 'First name is required',
        'lastname.required' => 'Last name is required',
        'mobile_no.required' => 'Mobile number is required',
        'address.required' => 'Address is required',
        'search_vehicle.required' => 'Please select a vehicle',
        // 'numberPlate.required' => 'Vehicle number plate is required',
        // 'chassisNo.required' => 'Chassis number is required',
    ]);

    // Update customer
    $customer = Customer::findOrFail($this->customerId);
    $customer->update([
        'name' => $this->name,
        'lastname' => $this->lastname,
        'user_title' => $this->user_title,
        'email' => $this->email,
        'mobile_no' => $this->mobile_no,
        'cust_type' => $this->cust_type,
        'company_name' => $this->company_name,
        'address' => $this->address,
        'country_id' => $this->country_id,
        'state_id' => $this->state_id,
        'city_id' => $this->city_id,
        'pincode' => $this->pincode,
        'birth_date' => $this->birth_date ? date('Y-m-d', strtotime($this->birth_date)) : null,
        'gst_number' => $this->gst_no,
    ]);

    // Find or create vehicle
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

    $vehicleData = [
        'modification_id' => $localModification->id,
        'brand' => $this->modificationId->brand_name ?? null,
        'variant' => $this->modificationId->variant_name ?? null,
        'year' => $this->selected_year ?? null,
        'modification' => $this->modificationId->title ?? null,
        'number_plate' => $this->numberPlate,
        'chassis_no' => $this->chassisNo,
        'engineno' => $this->engineNo,
        'date_of_manufacturing' => $this->dateOfManufacturing,
        'pickup_address' => $this->pickup_address,
        'drop_address' => $this->drop_address,
        'driver_name' => $this->driver_name,
        'driver_number' => $this->driver_number,
        'policy_number' => $this->policy_number,
        'insurance_name' => $this->insurance_name,
        'policy_expiry_date' => $this->policy_expiry_date,
        'gstin_number' => $this->gst_no,
    ];

    if ($this->vehicle_id) {
        // Update existing vehicle
        Vehicle::where('id', $this->vehicle_id)->update($vehicleData);
    } else {
        // Create new vehicle
        $customer->vehicles()->create($vehicleData);
    }

    $this->dispatch('swal:toast', [
        'type' => 'success',
        'message' => 'Customer updated successfully!',
    ]);
       $this->reset('vehicle_type_id','modelName','selectedVehicleName','states','cities','name','lastname','mobile_no','address','insurance_name','policy_expiry_date','gst_no','country_id','state_id','city_id','email','birth_date','user_title','numberPlate','fuel_id','chassisNo','modelYear','noOfGear','dateOfManufacturing','gearbox','gearboxNo','engineNo','engineSize','engine','keyNo','pickup_address','drop_address','driver_name','driver_number','policy_number','search_vehicle');

    $this->showModal = false;
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

    public function confirmDelete($id)
    {
        $this->customerId = $id;
        $this->dispatch('swal:confirm', [
            'title' => 'Are you sure?',
            'text' => 'This action cannot be undone.',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
            'action' => 'delete',
        ]);
    }

    // public function delete()
    // {
    //     Customer::destroy($this->customerId);
    //     $this->dispatch('swal:toast', ['message' => 'Customer deleted successfully!']);
    // }

  private function resetForm()
{
    // Reset all properties at once instead of individually
    $this->reset([
        'name',
        'lastname',
        'user_title',
        'email',
        'password',
        'mobile_no',
        'cust_type',
        'company_name',
        'branch_name',
        'landline_no',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'pincode',
        'birth_date',
        'display_name',
        'gst_no',
        'customerId',
        'vehicle_id',
        'search_vehicle',
        'modificationId',
        'selectedVehicleName',
        'brand_name',
        'variant_name',
        'selected_year',
        'insurance_name',
        'policy_expiry_date',
        'numberPlate',
        'fuel_id',
        'chassisNo',
        'modelYear',
        'noOfGear',
        'dateOfManufacturing',
        'gearbox',
        'gearboxNo',
        'engineNo',
        'engineSize',
        'engine',
        'keyNo',
        'pickup_address',
        'drop_address',
        'driver_name',
        'driver_number',
        'policy_number'
    ]);

    // Reset these arrays separately as they might need to be initialized
    $this->states = [];
    $this->cities = [];
    $this->variants = [];
    $this->years = [];
    $this->modifications = [];
}

    public function resetFilter()
    {
        $this->searchCustomer = '';
    }

}
