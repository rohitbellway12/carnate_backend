<?php

namespace App\Livewire\Sparepart;

use App\Models\{Category, Lubricant, Unit, SparePartLabel, UploadImage, SparePartVehicleModification, Modification, ProductStock, StockHistory};
use App\Models\SparePartSupplier;
use App\Services\SparePartCategoryService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('components.layouts.spare-part-app')]

class LubricantController extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $brand, $unit, $stock, $description, $image_id, $imagePreview, $imageId, $uploadedImageId, $uniqueId, $category;
    public $lubricantId, $sparepartId, $reflectedPrice = 0, $showLubricantModel, $sparePartLabels, $lubricant_label, $modifications; // For edit and delete actions
    public $commission = 0;
    public $price = 0;
    public $amount = 0;
    public $discount = 0;

    public $forAllVehicles = false;
    public $suitable_for = [];
    public $suitableForData = [];
    // Listen for vehicle selection events from the VehicleSelector component
    // and for removal actions. The 'delete' listener is kept for the existing
    // delete confirmation flow.
    protected $listeners = [
        'delete',
        'vehicleAdded' => 'addSuitableVehicle',
        'removeVehicle' => 'removeSuitableVehicle',
    ];

    public $purchase_amount = 0;
    public $discount_type = 1;
    public $hsn_code, $rack_no;
    public $tax_type, $tax_percentage, $customerPrice = 0, $selling_amount = 0;
    public $license_id, $licenseName, $licenseImage, $license_image, $searchfilter;
    public $units, $categories;
    public $part_image_url;
    public $api_compatible_vehicles = [];
    public $part_number;
    public $supplier_id;
    public $suppliers;
    public $brandFilter = '';
    public $online_price = 0, $offline_price = 0;
    protected $rules = [
        'name' => 'required',
        'purchase_amount' => 'required|numeric|min:1',
        'selling_amount' => 'required|numeric|min:1',
        'unit' => 'required|integer',
        'category' => 'required|integer',
        'stock' => 'required|integer|min:0',
        'brand' => 'nullable|string',
        // 'suitable_for' => 'nullable|string',
        'discount' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
        // 'image_id' => 'nullable|string',
    ];

    /**
     * Computed property to expose the count of selected compatible vehicles.
     * Livewire automatically makes getter methods available as properties
     * using the camelCase name without the "get" prefix and "Property" suffix.
     */
    public function getSuitableForCountProperty()
    {
        return is_array($this->suitable_for) ? count($this->suitable_for) : 0;
    }

    public function mount()
    {
        $this->sparepartId = Auth::guard('sparepart')->user()->id;
        $this->resetForm();
        $this->commission = getCommission(4);
        $this->sparePartLabels = SparePartLabel::select('id', 'title')->where('spare_part_type', 4)->get();
        $this->modifications = Modification::where('status', 1)->get();

        $this->licenseName = '';
        $this->licenseImage = '';

        $this->units = Unit::all();
        // $this->categories = Category::all();
        //  $this->suppliers = SparePartSupplier::all();
        $this->suppliers = SparePartSupplier::orderBy('id', 'desc')
    ->where('user_id', Auth::guard('sparepart')->id())
    ->get();
        $this->categories = SparePartCategoryService::getDropdownCategories();
    }

    public function updatedForAllVehicles($value)
    {
        if ($value) {
            $this->suitable_for = [];
        }
    }

    /**
     * Add a vehicle ID to the compatible list.
     * Also ensure the modification is present in the $modifications collection
     * so that the view can display its details immediately.
     */
    public function addSuitableVehicle($modificationId)
    {
        if (!is_array($this->suitable_for)) {
            $this->suitable_for = [];
        }
        if (!in_array($modificationId, $this->suitable_for)) {
            $this->suitable_for[] = $modificationId;
        }

        // Add the Modification model to the collection for immediate UI update
        $mod = Modification::find($modificationId);
        if ($mod && !$this->modifications->contains('id', $mod->id)) {
            $this->modifications->push($mod);
        }
    }

    /**
     * Remove a vehicle ID from the compatible list.
     */
    public function removeSuitableVehicle($modificationId)
    {
        $this->suitable_for = array_filter($this->suitable_for, function ($id) use ($modificationId) {
            return $id != $modificationId;
        });
        $this->suitable_for = array_values($this->suitable_for);
    }

    /**
     * Remove a vehicle by its index (used by the badge close button).
     */
    public function removeCompatibleVehicle($index)
    {
        if (isset($this->suitable_for[$index])) {
            unset($this->suitable_for[$index]);
        }
        $this->suitable_for = array_values($this->suitable_for);
    }
    public function render()
    {
        $lubricants = Lubricant::where('spare_part_type', 4);

        if ($this->searchfilter) {
            $search = trim($this->searchfilter);
            $lubricants->where(function ($query) use ($search) {
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
        $lubricants = $lubricants->where('user_id', $this->sparepartId)->orderBy('created_at', 'desc')->paginate(10);

        // return view('livewire.sparepart.lubricant', compact('lubricants'));
          $modifications = Modification::query()
            ->when($this->brandFilter, function ($query) {
                $query->where('brand_name', 'like', '%' . $this->brandFilter . '%');
            })
            ->get();

        // ---------- Return View ----------
        return view('livewire.sparepart.lubricant', [
            'lubricants' => $lubricants,
            'modifications' => $modifications,
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;

        $this->reset('selling_amount', 'tax_type', 'category', 'forAllVehicles', 'suitable_for', 'part_number');
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

        // if (!$this->forAllVehicles && empty($this->suitable_for)) {
        //     $this->addError('suitable_for', "The Vehicle field is required");
        //     return;
        // }

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
            'action' => 'store_lubricant',
            'user_id' => $this->sparepartId,
            'lubricant_name' => $this->name,
            'part_number' => $this->part_number,
            'forAllVehicles' => $this->forAllVehicles,
            'suitable_for_selected' => $this->suitable_for,
            'api_compatible_vehicles_count' => count($this->api_compatible_vehicles),
        ];

        // Handle API image if present and no manual image uploaded
        if (empty($this->license_image) && !empty($this->part_image_url)) {
            $imageContents = @file_get_contents($this->part_image_url);
            if ($imageContents !== false) {
                $imageName = 'uploads/' . uniqid('api_img_') . '.' . pathinfo(parse_url($this->part_image_url, PHP_URL_PATH), PATHINFO_EXTENSION);
                $fullPath = public_path($imageName);
                file_put_contents($fullPath, $imageContents);
                $upload = UploadImage::create(["file" => $imageName]);
                $this->license_id = $upload->id;
            }
        }

        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $this->name],
            ['title' => $this->name, 'spare_part_type' => 4]
        );

        if (!empty($this->license_image)) {
            $this->license_id = $this->license_image->id;
        }

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

        $lubricant = Lubricant::create([
             'name'=>$this->name,
            'user_id' => $this->sparepartId,
            'spare_part_type' => 4,
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
            'image' => $this->license_id,
            'category_id' => $this->category,
            'purchase_price' => $this->purchase_amount,
            'tax_type' => $this->tax_type,
            'tax_percentage' => $this->tax_percentage,
            'selling_amount' => $this->selling_amount,
            'discount_type' => $this->discount_type,
            'platform_charge' => $this->commission,
            'forAllVehicles' => $this->forAllVehicles ?? 0,
            'part_number' => $this->part_number ?? 0,
             'supplier_id' => $this->supplier_id,
        ]);

        $logData['lubricant_created'] = true;
        $logData['lubricant_id'] = $lubricant->id;
        $logData['lubricant_data'] = $lubricant->toArray();

        $stockProduct = ProductStock::where(['label_id' => $sparePartLabel->id, 'price' => $this->price, 'user_id' => $this->sparepartId])->first();

        if (empty($stockProduct)) {
            $stockProducts = new ProductStock;
            $stockProducts->label_id = $sparePartLabel->id;
            $stockProducts->category_id = 4;
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
        $stockHistory->spare_part_id = $lubricant->id;
        $stockHistory->category = 4;
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
                'spare_part_id' => $lubricant->id,
                'vehicle_modification_id' => $vehicleId
            ]);
            $pivotLog[] = [
                'pivot_id' => $pivotRecord->id,
                'spare_part_id' => $lubricant->id,
                'vehicle_modification_id' => $vehicleId
            ];
        }

        $logData['pivot_records_created'] = $pivotLog;

        // Write to log file
        $logFile = storage_path('logs/vehicle_saving.log');
        $logEntry = json_encode($logData, JSON_PRETTY_PRINT) . "\n" . str_repeat('-', 80) . "\n";
        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Lubricant added successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $lubricant = Lubricant::findOrFail($id);

        $this->lubricantId = $lubricant->id;
        $this->name = $lubricant->name;
        $this->brand = $lubricant->brand;
        $this->price = $lubricant->amount;
        $this->selling_amount = $lubricant->selling_amount;
        $this->unit = $lubricant->unit_id;
        $this->discount = $lubricant->discount;
        $this->stock = $lubricant->stock;
        $this->description = $lubricant->description;
        $this->image_id = $lubricant->image;
        $this->category = $lubricant->category_id;
        SparePartCategoryService::ensureCategoryInDropdown($this->categories, (int) $lubricant->category_id);
        $this->tax_type = $lubricant->tax_type;
        $this->tax_percentage = $lubricant->tax_percentage;
        $this->purchase_amount = $lubricant->purchase_price;
        $this->hsn_code = $lubricant->hsn_code;
        $this->rack_no = $lubricant->rack_no;
        $this->discount_type = $lubricant->discount_type;
        $this->customerPrice = $lubricant->price;
        $this->part_number = $lubricant->part_number;
        $this->supplier_id = $lubricant->supplier_id;
        $image = UploadImage::find($lubricant->image);
        // echo "<pre>"; print_r($image->toArray()); die;
        $this->license_image = $image ? $image : null;
        $this->licenseImage = $image ? $image->file : null;
        $this->showModal = true;

        $this->reflectedPrice = $lubricant->amount;
        $this->price = $lubricant->amount;
        $this->calculatePrice();

        if ($lubricant->forAllVehicles == 1) {
            $this->forAllVehicles = true;
            $this->suitable_for = [];
        } else {
            // Load from pivot table
            $sparePartVehicleModification = SparePartVehicleModification::where('spare_part_id', $lubricant->id)->get();
            $this->suitable_for = $sparePartVehicleModification->pluck('vehicle_modification_id')->toArray();
        }
    }

    public function update()
    {
        $this->validate();

        // if (!$this->forAllVehicles && empty($this->suitable_for)) {
        //     $this->addError('suitable_for', "The Vehicle field is required");
        //     return;
        // }

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
            'action' => 'update_lubricant',
            'user_id' => $this->sparepartId,
            'lubricant_id' => $this->lubricantId,
            'lubricant_name' => $this->name,
            'part_number' => $this->part_number,
            'forAllVehicles' => $this->forAllVehicles,
            'suitable_for_selected' => $this->suitable_for,
            'api_compatible_vehicles_count' => count($this->api_compatible_vehicles),
        ];

        $lubricant = Lubricant::findOrFail($this->lubricantId);

        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $this->name],
            ['title' => $this->name, 'spare_part_type' => 4]
        );

        SparePartVehicleModification::where('spare_part_id', $lubricant->id)->delete();

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
        if (empty($this->license_image) && !empty($this->part_image_url)) {
            $imageContents = @file_get_contents($this->part_image_url);
            if ($imageContents !== false) {
                $imageName = 'uploads/' . uniqid('api_img_') . '.' . pathinfo(parse_url($this->part_image_url, PHP_URL_PATH), PATHINFO_EXTENSION);
                $fullPath = public_path($imageName);
                file_put_contents($fullPath, $imageContents);
                $upload = UploadImage::create(["file" => $imageName]);
                $this->license_id = $upload->id;
            }
        }

        if (!empty($this->license_image)) {
            $this->license_id = $this->license_image->id;
        }

        $lubricant->update([
             'name'=>$this->name,
            'user_id' => $this->sparepartId,
            'spare_part_type' => 4,
            'label_id' => $sparePartLabel->id,
            'brand' => $this->brand ?? '',
            'price' => $this->customerPrice,
            'amount' => $this->reflectedPrice,
            'unit_id' => $this->unit,
            'suitable_for' => $suitableForString, // Save as string like before
            'discount' => $this->discount ?? 0,
            'stock' => $this->stock,
            'hsn_code' => $this->hsn_code,
            'rack_no' => $this->rack_no,
            'description' => $this->description ?? '',
            'image' => $this->license_id,
            'category_id' => $this->category,
            'tax_type' => $this->tax_type,
            'tax_percentage' => $this->tax_percentage,
            'purchase_price' => $this->purchase_amount,
            'selling_amount' => $this->selling_amount,
            'discount_type' => $this->discount_type,
            'platform_charge' => $this->commission,
            'forAllVehicles' => $this->forAllVehicles ?? 0,
            'part_number' => $this->part_number ?? 0,
             'supplier_id' => $this->supplier_id,
        ]);

        $logData['lubricant_updated'] = true;
        $logData['lubricant_data'] = $lubricant->fresh()->toArray();

        // Save to pivot table for relationship
        $pivotLog = [];
        foreach ($selectedVehicleIds as $vehicleId) {
            $pivotRecord = SparePartVehicleModification::create([
                'spare_part_id' => $lubricant->id,
                'vehicle_modification_id' => $vehicleId
            ]);
            $pivotLog[] = [
                'pivot_id' => $pivotRecord->id,
                'spare_part_id' => $lubricant->id,
                'vehicle_modification_id' => $vehicleId
            ];
        }

        $logData['pivot_records_created'] = $pivotLog;

        // Write to log file
        $logFile = storage_path('logs/vehicle_saving.log');
        $logEntry = json_encode($logData, JSON_PRETTY_PRINT) . "\n" . str_repeat('-', 80) . "\n";
        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Lubricant updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }


    public function confirmDelete($id)
    {
        $this->lubricantId = $id;
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
        // echo "<prE>";print_r()
        Lubricant::destroy($this->lubricantId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Lubricant deleted successfully!']);
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
        $lubricant = Lubricant::where('id', $this->lubricantId)->first();
        $lubricant->update([
            'image' => $this->image_id ?? 0,

        ]);
    }




    public function addLubricantLabel()
    {
        $this->showLubricantModel = true;
    }


    public function lubricantLabelStore()
    {

        $valArr = [
            'lubricant_label' => ["required"],
        ];

        $this->validate($valArr);


        $category = SparePartLabel::create([
            'title' => $this->lubricant_label,
            'spare_part_type' => 4,
        ]);

        $this->sparePartLabels = SparePartLabel::select('id', 'title')->where('spare_part_type', 4)->get();


        $this->dispatch('swal:toast', ['message' => 'Lubricant Label added successfully!']);
        $this->resetForm();
        $this->lubricant_label = '';
        $this->showLubricantModel = false;
    }

    private function resetForm()
    {
        $this->name = '';
        $this->category = '';
        $this->brand = '';
        $this->price = '';
        $this->unit = null;
        // $this->suitable_for = '';
        $this->suitable_for = [];
        $this->discount = '';
        $this->stock = '';
        $this->description = '';
        $this->image_id = null;
        $this->purchase_amount = '';
        $this->imagePreview = null;
        $this->image = '';
        $this->imageName = '';
        $this->lubricantId = null;
        $this->hsn_code = '';
        $this->rack_no = '';
        $this->amount = 0;
        $this->tax_percentage = 0;
        $this->reflectedPrice = 0;
        $this->customerPrice = 0;
        $this->selling_amount = 0;
        $this->part_image_url = null;
        $this->api_compatible_vehicles = [];
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
    // public function updatedDiscount($value){
    //     $price = floatval($this->amount) - floatval($value);
    //     $this->price = $price;
    //     $this->reflectedPrice = $price - (($price * $this->commission) / 100);
    // }

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
        $this->calculatePrice();
    }

    public function updatedTaxPercentage($value)
    {
        $this->calculatePrice();
    }

    private function calculatePrice()
    {
        $price = 0;
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

    public function updatedLicenseImage()
    {
        if (!empty($this->license_image)) {
            $this->licenseName = $this->license_image->store("uploads", "public_root");
            $uploadid = UploadImage::create([
                "file" => $this->licenseName,
            ]);
            $this->license_image = $uploadid;
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'License Image uploaded',]);
    }

    public function resetFilter()
    {
        $this->searchfilter = '';
        $this->resetPage();
    }
    public function updated()
    {
        $this->resetErrorBag();
    }

    public function updatedSearchfilter()
    {
        $this->resetPage();
    }

    public function checkVehicleLog()
    {
        $logFile = storage_path('logs/vehicle_saving.log');

        if (!file_exists($logFile)) {
            return "Log file not found. No vehicle saving activities recorded yet.";
        }

        $logContent = file_get_contents($logFile);
        $logEntries = explode(str_repeat('-', 80), $logContent);

        $recentEntries = array_slice($logEntries, -5); // last 5 vehical

        $formattedLog = "=== Recent Vehicle Saving Activities ===\n\n";

        foreach ($recentEntries as $entry) {
            if (trim($entry)) {
                $data = json_decode($entry, true);
                if ($data) {
                    $formattedLog .= "Timestamp: " . $data['timestamp'] . "\n";
                    $formattedLog .= "Action: " . $data['action'] . "\n";
                    $formattedLog .= "Lubricant: " . $data['lubricant_name'] . "\n";
                    $formattedLog .= "For All Vehicles: " . ($data['forAllVehicles'] ? 'Yes' : 'No') . "\n";
                    $formattedLog .= "Suitable For String: " . $data['suitable_for_string'] . "\n";
                    $formattedLog .= "Selected Vehicle IDs: " . implode(', ', $data['selected_vehicle_ids']) . "\n";

                    if (isset($data['vehicle_processing_log'])) {
                        $formattedLog .= "Vehicle Processing:\n";
                        foreach ($data['vehicle_processing_log'] as $vehicle) {
                            $formattedLog .= "- Vehicle ID: " . $vehicle['vehicle_id'] . " (Type: " . $vehicle['processing_type'] . ")\n";
                            if (isset($vehicle['modification_created']) && $vehicle['modification_created']) {
                                $formattedLog .= "  * New modification created with ID: " . $vehicle['modification_id'] . "\n";
                            }
                        }
                    }

                    $formattedLog .= str_repeat('-', 40) . "\n\n";
                }
            }
        }

        return $formattedLog;
    }

}
