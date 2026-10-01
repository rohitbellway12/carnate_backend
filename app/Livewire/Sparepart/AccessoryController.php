<?php

namespace App\Livewire\Sparepart;

use App\Models\{Accessory, Category, Maker, Modification, ProductStock, Unit, SparePartLabel, SparePartSupplier, SparePartVehicleModification, StockHistory, UploadImage};
use App\Services\SparePartCategoryService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('components.layouts.spare-part-app')]
class AccessoryController extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $brand, $unit, $stock, $description, $image_id, $imagePreview, $imageId, $uploadedImageId, $uniqueId;
    public $accessoryId, $sparepartId, $reflectedPrice, $showAccessoryModel, $sparePartLabels, $accessory_label, $modifications;
    public $forAllVehicles = false;
    public $suitable_for = [];
    public $suitableForData = [];
    public $commission = 0;
    public $purchase_amount = 0;
    public $discount_type = 1;
    public $price = 0;
    public $amount = 0;
    public $discount = 0;
    public $hsn_code, $rack_no;

    public $tax_type, $tax_percentage, $category, $searchfilter, $customerPrice = 0, $selling_amount = 0, $part_number;
    public $imageName, $imageImage, $image;
    public $units, $categories;
    public $part_image_url;
    public $api_compatible_vehicles = [];
    protected $listeners = ['delete', 'vehicleAdded' => 'addSuitableVehicle', 'removeVehicle' => 'removeSuitableVehicle'];
    public $supplier_id;
    public $suppliers;
    public $brandFilter = '';
    public $online_price = 0, $offline_price = 0;
    protected $rules = [
        'name' => 'required',
        'price' => 'required|numeric|min:1',
        'amount' => 'required|numeric|min:0',
        'customerPrice' => 'required|numeric|min:1',
        'reflectedPrice' => 'required|numeric|min:1',
        'selling_amount' => 'required|numeric|min:1',
        'unit' => 'required|integer',
        'stock' => 'required|integer|min:1',
        'brand' => 'nullable|string',
        // 'suitable_for' => 'nullable|string',
        'discount' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
        'category' => 'required|integer',
        // 'category' => 'nullable|integer',
        'purchase_amount' => 'required|integer',
    ];

    public function mount()
    {
        $this->sparepartId = Auth::guard('sparepart')->user()->id;
        $this->resetForm();

        $this->commission = getCommission(1);
        $this->sparePartLabels = SparePartLabel::select('id', 'title')->where('spare_part_type', 1)->get();

        $this->modifications = Modification::where('status', 1)->get();
        $this->imageName = '';
        $this->imageImage = '';

        $this->units = Unit::all();

        //   $this->suppliers = SparePartSupplier::all();
        $this->suppliers = SparePartSupplier::orderBy('id', 'desc')
            ->where('user_id', Auth::guard('sparepart')->id())
            ->get();
        $this->categories = SparePartCategoryService::getDropdownCategories();
    }

    /**
     * Computed property to get the count of selected compatible vehicles.
     * Livewire automatically makes getter methods available as properties
     * using the camelCase name without the "get" prefix and "Property" suffix.
     */
    public function getSuitableForCountProperty()
    {
        return is_array($this->suitable_for) ? count($this->suitable_for) : 0;
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

    public function render()
    {
        $accessories = Accessory::with('label', 'unit')
            ->where('spare_part_type', 1)
            ->where('user_id', $this->sparepartId)
            ->orderBy('id', 'desc');

        if ($this->searchfilter) {
            $search = trim($this->searchfilter);
            $accessories->where(function ($query) use ($search) {
                $query->whereHas('label', function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                    ->OrwhereHas('unit', function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->orWhere('brand', 'like', '%' . $search . '%')
                    ->orWhere('hsn_code', 'like', '%' . $search . '%')
                    ->orWhere('rack_no', 'like', '%' . $search . '%');
            });
        }

        $accessories = $accessories->paginate(10);

        // Load all modifications similar to workshop ProductStockController
        $modifications = Modification::where('status', 1)->get();

        // Include selected modifications that may have been recently added
        if (!empty($this->suitable_for)) {
            $selectedMods = Modification::whereIn('id', $this->suitable_for)->get();
            foreach ($selectedMods as $mod) {
                // Add to modifications collection if not already present
                if (!$modifications->contains('id', $mod->id)) {
                    $modifications->push($mod);
                }
            }
        }

        // ---------- Return View ----------
        return view('livewire.sparepart.accessory', [
            'accessories' => $accessories,
            'modifications' => $modifications,
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
        $this->reset('selling_amount', 'tax_type', 'category', 'part_number', 'forAllVehicles');
        $this->reflectedPrice = 0;
        $this->customerPrice = 0;
        $this->part_image_url = null;
        $this->api_compatible_vehicles = [];
    }

    public function store()
    {
        $this->validate([
            'supplier_id' => 'required|exists:spare_part_suppliers,id',
        ]);
        $this->validate();

        // Automatically populate suitable_for with all available vehicles
        if (empty($this->suitable_for)) {
            if (!empty($this->api_compatible_vehicles)) {
                // If API vehicles are available, use their IDs
                $this->suitable_for = collect($this->api_compatible_vehicles)->pluck('vehicleId')->toArray();
            } elseif (!empty($this->modifications)) {
                // If modifications are available, use their IDs
                $this->suitable_for = $this->modifications->pluck('id')->toArray();
            }
        }

        if (empty($this->suitable_for)) {
            $this->addError('suitable_for', "No compatible vehicles found");
            return;
        }


        // Start logging
        $logData = [
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'action' => 'store_accessory',
            'user_id' => $this->sparepartId,
            'accessory_name' => $this->name,
            'part_number' => $this->part_number,
            'forAllVehicles' => $this->forAllVehicles,
            'suitable_for_selected' => $this->suitable_for,
            'api_compatible_vehicles_count' => count($this->api_compatible_vehicles),
        ];

        // Handle API image if present and no manual image uploaded
        if (empty($this->image) && !empty($this->part_image_url)) {
            $imageContents = @file_get_contents($this->part_image_url);
            if ($imageContents !== false) {
                $imageName = 'uploads/' . uniqid('api_img_') . '.' . pathinfo(parse_url($this->part_image_url, PHP_URL_PATH), PATHINFO_EXTENSION);
                $fullPath = public_path($imageName);
                file_put_contents($fullPath, $imageContents);
                $upload = UploadImage::create(["file" => $imageName]);
                $this->image_id = $upload->id;
            }
        }

        if (!empty($this->image)) {
            $this->image_id = $this->image->id;
        }

        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $this->name],
            ['title' => $this->name, 'spare_part_type' => 1]
        );

        // Prepare suitable_for string for spare_parts table
        $suitableForString = '';
        $selectedVehicleIds = [];
        $vehicleProcessingLog = [];

        if ($this->forAllVehicles) {
            $suitableForString = 'All Vehicles';
            $selectedVehicleIds = Modification::where('status', 1)->pluck('id')->toArray();
            $vehicleProcessingLog[] = 'For All Vehicles selected - using all active modifications';
        } else {
            // Handle API vehicles - save them to modifications table if they don't exist
            $vehicleNames = [];
            foreach ($this->suitable_for as $vehicleId) {
                $vehicleLog = [
                    'vehicle_id' => $vehicleId,
                    'processing_type' => 'unknown'
                ];

                // Check if this is an API vehicle (not a modification ID)
                $apiVehicle = collect($this->api_compatible_vehicles)->firstWhere('vehicleId', $vehicleId);

                if ($apiVehicle) {
                    $vehicleLog['processing_type'] = 'api_vehicle';
                    $vehicleLog['api_data'] = $apiVehicle;

                    // This is an API vehicle - save to modifications table
                    $modification = Modification::firstOrCreate(
                        [
                            'title' => $apiVehicle['manufacturerName'] . ' ' . $apiVehicle['modelName'],
                            'brand_name' => $apiVehicle['manufacturerName'],
                            'variant_name' => $apiVehicle['modelName'],
                            'year' => $apiVehicle['year'] ?? date('Y'),
                        ],
                        [
                            'brand_id' => 1, // Default brand ID
                            'variant_id' => 1, // Default variant ID
                            'status' => 1,
                        ]
                    );

                    $vehicleLog['modification_created'] = true;
                    $vehicleLog['modification_id'] = $modification->id;
                    $vehicleLog['modification_data'] = $modification->toArray();

                    $selectedVehicleIds[] = $modification->id;
                    $vehicleNames[] = $apiVehicle['manufacturerName'] . ' ' . $apiVehicle['modelName'] . ' ' . ($apiVehicle['year'] ?? '');
                } else {
                    $vehicleLog['processing_type'] = 'existing_modification';

                    // This is an existing modification ID
                    $selectedVehicleIds[] = $vehicleId;
                    $modification = Modification::find($vehicleId);
                    if ($modification) {
                        $vehicleLog['modification_found'] = true;
                        $vehicleLog['modification_data'] = $modification->toArray();
                        $vehicleNames[] = $modification->brand_name . ' ' . $modification->variant_name . ' ' . $modification->year;
                    } else {
                        $vehicleLog['modification_found'] = false;
                        $vehicleLog['error'] = 'Modification not found';
                    }
                }

                $vehicleProcessingLog[] = $vehicleLog;
            }
            $suitableForString = implode(', ', $vehicleNames);
        }

        $logData['vehicle_processing_log'] = $vehicleProcessingLog;
        $logData['suitable_for_string'] = $suitableForString;
        $logData['selected_vehicle_ids'] = $selectedVehicleIds;

        $accessory = Accessory::create([
            'name' => $this->name,
            'user_id' => $this->sparepartId,
            'spare_part_type' => 1,
            'label_id' => $sparePartLabel->id,
            'brand' => $this->brand ?? '',
            'price' => $this->customerPrice,
            'amount' => $this->price,
            'unit_id' => $this->unit,
            'suitable_for' => $suitableForString, // Save as string like before
            'discount' => $this->discount ?? 0,
            'stock' => $this->stock,
            'hsn_code' => $this->hsn_code,
            'rack_no' => $this->rack_no,
            'description' => $this->description ?? '',
            'image' => $this->image_id,
            'purchase_price' => $this->purchase_amount,
            'tax_type' => $this->tax_type,
            'tax_percentage' => $this->tax_percentage,
            'category_id' => $this->category,
            'selling_amount' => $this->selling_amount,
            'discount_type' => $this->discount_type,
            'platform_charge' => $this->commission,
            'forAllVehicles' => $this->forAllVehicles ? 1 : 0,
            'part_number' => $this->part_number ?? 0,
            'supplier_id' => $this->supplier_id,
        ]);

        $logData['accessory_created'] = true;
        $logData['accessory_id'] = $accessory->id;
        $logData['accessory_data'] = $accessory->toArray();

        $stockProduct = ProductStock::where(['label_id' => $sparePartLabel->id, 'price' => $this->price, 'user_id' => $this->sparepartId])->first();

        if (empty($stockProduct)) {
            $stockProducts = new ProductStock;
            $stockProducts->label_id = $sparePartLabel->id;
            $stockProducts->category_id = 1;
            $stockProducts->stock = $this->stock;
            $stockProducts->price = $this->price;
            $stockProducts->user_id = $this->sparepartId;
            $stockProducts->save();
        } else {
            $stockProduct->stock = $stockProduct->stock + $this->stock;
            $stockProduct->price = $this->price;
            $stockProduct->save();
        }

        $stockHistory = new StockHistory();
        $stockHistory->label_id = $sparePartLabel->id;
        $stockHistory->spare_part_id = $accessory->id;
        $stockHistory->category = 1;
        $stockHistory->user_id = $this->sparepartId;
        $stockHistory->last_stock = $this->stock;
        $stockHistory->current_stock = $this->stock;
        $stockHistory->stock_type = 'addition';
        $stockHistory->remarks = "Stock add by spare part vendor.";
        $stockHistory->save();

        // Save to pivot table for relationship
        $pivotLog = [];
        foreach ($selectedVehicleIds as $vehicleId) {
            $pivotRecord = SparePartVehicleModification::create([
                'spare_part_id' => $accessory->id,
                'vehicle_modification_id' => $vehicleId
            ]);
            $pivotLog[] = [
                'pivot_id' => $pivotRecord->id,
                'spare_part_id' => $accessory->id,
                'vehicle_modification_id' => $vehicleId
            ];
        }

        $logData['pivot_records_created'] = $pivotLog;

        // Write to log file
        $logFile = storage_path('logs/vehicle_saving.log');
        $logEntry = json_encode($logData, JSON_PRETTY_PRINT) . "\n" . str_repeat('-', 80) . "\n";
        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Accessory added successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $accessory = Accessory::findOrFail($id);

        $this->accessoryId = $accessory->id;
        $this->name = $accessory->name;
        $this->brand = $accessory->brand;
        $this->selling_amount = $accessory->selling_amount;
        $this->unit = $accessory->unit_id;
        $this->hsn_code = $accessory->hsn_code;
        $this->rack_no = $accessory->rack_no;
        $this->discount = $accessory->discount;
        $this->stock = $accessory->stock;
        $this->description = $accessory->description;
        $this->image_id = $accessory->image;
        $this->tax_type = $accessory->tax_type;
        $this->tax_percentage = $accessory->tax_percentage;
        $this->purchase_amount = $accessory->purchase_price;
        $this->category = $accessory->category_id;
        SparePartCategoryService::ensureCategoryInDropdown($this->categories, (int) $accessory->category_id);
        $this->discount_type = $accessory->discount_type;
        $this->customerPrice = $accessory->price;
        $this->part_number = $accessory->part_number;
        $this->supplier_id = $accessory->supplier_id;

        $image = UploadImage::find($accessory->image);
        $this->image = $image ? $image : null;
        $this->imageImage = $image ? $image->file : null;

        $this->showModal = true;
        $this->reflectedPrice = $accessory->amount;
        $this->price = $accessory->amount;
        $this->calculatePrice();

        if ($accessory->forAllVehicles == 1) {
            $this->forAllVehicles = true;
            $this->suitable_for = [];
        } else {
            // Load from pivot table
            $sparePartVehicleModification = SparePartVehicleModification::where('spare_part_id', $accessory->id)->get();
            $this->suitable_for = $sparePartVehicleModification->pluck('vehicle_modification_id')->toArray();
        }
    }

    /**
     * Listener for the VehicleSelector component.
     * The VehicleSelector emits "vehicleAdded" with the selected modification ID.
     * We simply push that ID into the $suitable_for array so it will be saved
     * when the accessory is stored.
     */
    /**
     * Listener for the VehicleSelector component.
     * Adds the selected modification ID to the compatible vehicles list.
     * Additionally, ensures the newly added modification is present in the
     * `$modifications` collection so that it can be displayed immediately in
     * the "Selected Compatible Vehicles" badge list.
     */
    public function addSuitableVehicle($modificationId)
    {
        // Ensure $suitable_for is an array and avoid duplicate IDs
        if (!is_array($this->suitable_for)) {
            $this->suitable_for = [];
        }
        if (!in_array($modificationId, $this->suitable_for)) {
            $this->suitable_for[] = $modificationId;
        }

        // Load the Modification model (if it exists) and add it to the
        // `$modifications` collection used by the view. This mirrors the
        // behaviour in the workshop stock page where newly added vehicles are
        // instantly visible.
        if ($modificationId) {
            $mod = Modification::find($modificationId);
            if ($mod) {
                // $this->modifications is an Eloquent Collection; ensure we
                // don't duplicate entries.
                if (!$this->modifications->contains('id', $mod->id)) {
                    $this->modifications->push($mod);
                }
            }
        }
    }

    /**
     * Remove a vehicle id from the selected list.
     * Called from the UI via wire:click="removeVehicle({{ $vehId }})".
     */
    public function removeSuitableVehicle($modificationId)
    {
        $this->suitable_for = array_filter($this->suitable_for, function ($id) use ($modificationId) {
            return $id != $modificationId;
        });
        // Re-index array to keep numeric keys sequential (optional)
        $this->suitable_for = array_values($this->suitable_for);
    }

    /**
     * Remove a vehicle by index from the selected list.
     * Called from the UI via wire:click="removeCompatibleVehicle({{ $index }})".
     */
    public function removeCompatibleVehicle($index)
    {
        if (isset($this->suitable_for[$index])) {
            unset($this->suitable_for[$index]);
        }
        // Re-index array to keep numeric keys sequential
        $this->suitable_for = array_values($this->suitable_for);
    }

    public function update()
    {
        $this->validate();

        // Automatically populate suitable_for with all available vehicles if empty
        if (empty($this->suitable_for)) {
            if (!empty($this->api_compatible_vehicles)) {
                // If API vehicles are available, use their IDs
                $this->suitable_for = collect($this->api_compatible_vehicles)->pluck('vehicleId')->toArray();
            } elseif (!empty($this->modifications)) {
                // If modifications are available, use their IDs
                $this->suitable_for = $this->modifications->pluck('id')->toArray();
            }
        }


        if (empty($this->suitable_for)) {
            $this->addError('suitable_for', "No compatible vehicles found");
            return;
        }

        // Start logging
        $logData = [
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'action' => 'update_accessory',
            'user_id' => $this->sparepartId,
            'accessory_id' => $this->accessoryId,
            'accessory_name' => $this->name,
            'part_number' => $this->part_number,
            'forAllVehicles' => $this->forAllVehicles,
            'suitable_for_selected' => $this->suitable_for,
            'api_compatible_vehicles_count' => count($this->api_compatible_vehicles),
        ];

        $accessory = Accessory::findOrFail($this->accessoryId);

        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $this->name],
            ['title' => $this->name, 'spare_part_type' => 1]
        );

        SparePartVehicleModification::where('spare_part_id', $accessory->id)->delete();

        // Prepare suitable_for string for spare_parts table
        $suitableForString = '';
        $selectedVehicleIds = [];
        $vehicleProcessingLog = [];

        if ($this->forAllVehicles == 1) {
            $suitableForString = 'All Vehicles';
            $selectedVehicleIds = Modification::where('status', 1)->pluck('id')->toArray();
            $vehicleProcessingLog[] = 'For All Vehicles selected - using all active modifications';
        } else {
            // Handle API vehicles - save them to modifications table if they don't exist
            $vehicleNames = [];
            foreach ($this->suitable_for as $vehicleId) {
                $vehicleLog = [
                    'vehicle_id' => $vehicleId,
                    'processing_type' => 'unknown'
                ];

                // Check if this is an API vehicle (not a modification ID)
                $apiVehicle = collect($this->api_compatible_vehicles)->firstWhere('vehicleId', $vehicleId);

                if ($apiVehicle) {
                    $vehicleLog['processing_type'] = 'api_vehicle';
                    $vehicleLog['api_data'] = $apiVehicle;

                    // This is an API vehicle - save to modifications table
                    $modification = Modification::firstOrCreate(
                        [
                            'title' => $apiVehicle['manufacturerName'] . ' ' . $apiVehicle['modelName'],
                            'brand_name' => $apiVehicle['manufacturerName'],
                            'variant_name' => $apiVehicle['modelName'],
                            'year' => $apiVehicle['year'] ?? date('Y'),
                        ],
                        [
                            'brand_id' => 1, // Default brand ID
                            'variant_id' => 1, // Default variant ID
                            'status' => 1,
                        ]
                    );

                    $vehicleLog['modification_created'] = true;
                    $vehicleLog['modification_id'] = $modification->id;
                    $vehicleLog['modification_data'] = $modification->toArray();

                    $selectedVehicleIds[] = $modification->id;
                    $vehicleNames[] = $apiVehicle['manufacturerName'] . ' ' . $apiVehicle['modelName'] . ' ' . ($apiVehicle['year'] ?? '');
                } else {
                    $vehicleLog['processing_type'] = 'existing_modification';

                    // This is an existing modification ID
                    $selectedVehicleIds[] = $vehicleId;
                    $modification = Modification::find($vehicleId);
                    if ($modification) {
                        $vehicleLog['modification_found'] = true;
                        $vehicleLog['modification_data'] = $modification->toArray();
                        $vehicleNames[] = $modification->brand_name . ' ' . $modification->variant_name . ' ' . $modification->year;
                    } else {
                        $vehicleLog['modification_found'] = false;
                        $vehicleLog['error'] = 'Modification not found';
                    }
                }

                $vehicleProcessingLog[] = $vehicleLog;
            }
            $suitableForString = implode(', ', $vehicleNames);
        }

        $logData['vehicle_processing_log'] = $vehicleProcessingLog;
        $logData['suitable_for_string'] = $suitableForString;
        $logData['selected_vehicle_ids'] = $selectedVehicleIds;

        // Handle API image if present and no manual image uploaded
        if (empty($this->image) && !empty($this->part_image_url)) {
            $imageContents = @file_get_contents($this->part_image_url);
            if ($imageContents !== false) {
                $imageName = 'uploads/' . uniqid('api_img_') . '.' . pathinfo(parse_url($this->part_image_url, PHP_URL_PATH), PATHINFO_EXTENSION);
                $fullPath = public_path($imageName);
                file_put_contents($fullPath, $imageContents);
                $upload = UploadImage::create(["file" => $imageName]);
                $this->image_id = $upload->id;
            }
        }

        if (!empty($this->image)) {
            $this->image_id = $this->image->id;
        }

        $accessory->update([
            'name' => $this->name,
            'user_id' => $this->sparepartId,
            'spare_part_type' => 1,
            'label_id' => $sparePartLabel->id,
            'brand' => $this->brand ?? '',
            'price' => $this->customerPrice,
            'purchase_price' => $this->purchase_amount,
            'amount' => $this->reflectedPrice,
            'hsn_code' => $this->hsn_code,
            'rack_no' => $this->rack_no,
            'unit_id' => $this->unit,
            'suitable_for' => $suitableForString, // Save as string like before
            'discount' => $this->discount ?? 0,
            'stock' => $this->stock,
            'description' => $this->description ?? '',
            'image' => $this->image_id,
            'tax_type' => $this->tax_type,
            'tax_percentage' => $this->tax_percentage,
            'category_id' => $this->category,
            'selling_amount' => $this->selling_amount,
            'discount_type' => $this->discount_type,
            'platform_charge' => $this->commission,
            'forAllVehicles' => $this->forAllVehicles ? 1 : 0,
            'part_number' => $this->part_number ?? 0,
            'supplier_id' => $this->supplier_id,
        ]);

        $logData['accessory_updated'] = true;
        $logData['accessory_data'] = $accessory->fresh()->toArray();

        // Save to pivot table for relationship
        $pivotLog = [];
        foreach ($selectedVehicleIds as $vehicleId) {
            $pivotRecord = SparePartVehicleModification::create([
                'spare_part_id' => $accessory->id,
                'vehicle_modification_id' => $vehicleId
            ]);
            $pivotLog[] = [
                'pivot_id' => $pivotRecord->id,
                'spare_part_id' => $accessory->id,
                'vehicle_modification_id' => $vehicleId
            ];
        }

        $logData['pivot_records_created'] = $pivotLog;

        // Write to log file
        $logFile = storage_path('logs/vehicle_saving.log');
        $logEntry = json_encode($logData, JSON_PRETTY_PRINT) . "\n" . str_repeat('-', 80) . "\n";
        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Accessory updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function updated()
    {
        $this->resetErrorBag();
    }

    public function confirmDelete($id)
    {
        $this->accessoryId = $id;
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

    public function delete()
    {
        Accessory::destroy($this->accessoryId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Accesory deleted successfully!']);
    }


    #[On('imageUploaded')]
    public function handleImageUploaded($payload)
    {
        $this->uploadedImageId = $payload['imageId'];
        $this->uniqueId = $payload['uniqueId'];
        $uniq = $payload['uniqueId'];

        $this->$uniq = $this->uploadedImageId;

        if ($this->isEdit) {
            $this->editImage();
        }
    }

    public function editImage()
    {
        $accessory = Accessory::where('id', $this->accessoryId)->first();
        $accessory->update([
            'image' => $this->image_id ?? 0,
        ]);
    }


    public function addAccessoryLabel()
    {
        $this->showAccessoryModel = true;
    }


    public function accessoryLabelStore()
    {

        $valArr = [
            'accessory_label' => ["required"],
        ];

        $this->validate($valArr);




        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $this->accessory_label],
            ['title' => $this->accessory_label, 'spare_part_type' => 1]
        );



        $this->sparePartLabels = SparePartLabel::select('id', 'title')->where('spare_part_type', 1)->get();
        $this->name = $this->accessory_label;

        $this->dispatch('swal:toast', ['message' => 'Accessory Label added successfully!']);
        $this->resetForm();
        $this->accessory_label = '';
        $this->showAccessoryModel = false;
    }


    private function resetForm()
    {
        $this->name = '';
        $this->brand = '';
        $this->price = '';
        $this->unit = null;
        //$this->suitable_for = '';
        $this->suitable_for = [];
        $this->discount = '';
        $this->stock = '';
        $this->hsn_code = '';
        $this->rack_no = '';
        $this->purchase_amount = '';
        $this->description = '';
        $this->image_id = null;
        $this->imagePreview = null;
        $this->image = '';
        $this->imageName = '';
        $this->accessoryId = null;
        $this->amount = 0;
        $this->tax_percentage = 0;
        $this->reflectedPrice = 0;
        $this->customerPrice = 0;
        $this->selling_amount = 0;
        $this->part_number = '';
        $this->supplier_id = '';
        $this->online_price = 0;
        $this->offline_price = 0;
    }

    public function updatedSellingAmount($value)
    {
        // $price = floatval($value) - floatval($this->discount);
        // $this->price = $price;
        // $this->reflectedPrice = $price - (($price * $this->commission) / 100);
        $this->calculatePrice();
    }
    public function updatedDiscount($value)
    {
        $this->calculatePrice();
    }

    public function updatedDiscountType($value)
    {
        $this->calculatePrice();
    }

    public function updatedTaxType($value)
    {
        // $this->calculatePrice();
    }

    public function updatedTaxPercentage($value)
    {
        $this->calculatePrice();
    }

    private function calculatePrice()
    {
        $price = 0;

        // Ensure all properties are floats
        $sellingAmount = floatval($this->selling_amount);
        $taxPercentage = floatval($this->tax_percentage);
        $discount = floatval($this->discount);
        $commission = floatval($this->commission);

        if ($this->tax_type == 'exclude' && $taxPercentage) {
            $tax = ($sellingAmount * $taxPercentage) / 100;
            $price = $sellingAmount + $tax;
        } else {
            $price = $sellingAmount;
        }

        $this->offline_price = $price;

        if ($this->discount_type == 1) {
            $price -= $discount;
        } elseif ($this->discount_type == 2) {
            $discountAmount = ($price * $discount) / 100;
            $price -= $discountAmount;
        }

        $this->reflectedPrice = $this->price = $price;
        $totalCommission = ($price * $commission) / 100;
        $this->customerPrice = $price + $totalCommission;
        $this->online_price = $price;
    }


    public function updateSuitableFor($selectedValues)
    {

        $this->suitable_for = $selectedValues;

    }

    public function resetFilter()
    {
        $this->searchfilter = '';
    }

    public function updatedResetfilter()
    {
        $this->resetPage();
    }

    public function updatedImage()
    {
        if (!empty($this->image)) {
            $this->imageName = $this->image->store("uploads", "public_root");
            $uploadid = UploadImage::create([
                "file" => $this->imageName,
            ]);
            $this->image = $uploadid;
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Image uploaded',]);
    }

    public function updatedSearchfilter()
    {
        $this->resetPage();
    }

}
