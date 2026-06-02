<?php

namespace App\Livewire\Sparepart;

use App\Models\{Maker, MakerType, Category, Part, Unit, SparePartLabel, UploadImage, SparePartVehicleModification, Modification, ProductStock, StockHistory};
use App\Services\SparePartCategoryService;
use App\Services\RapidApiVehicleService;
use App\Models\SparePartSupplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]
class PartsController extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false, $selectAll = false, $isView = false;
    public $name, $brand, $unit, $stock, $description, $image_id, $imagePreview, $imageId, $uploadedImageId, $uniqueId, $part_number, $sp_type;
    public $partId, $sparepartId, $reflectedPrice, $showPartModel, $sparePartLabels, $part_label;
    public $articleId, $oemNumbers = [], $oem_list, $brandFilter = '';

    public $forAllVehicles = false;
    public $suitable_for = [];
    public $suitableForData = [];

    public $commission = 0;
    public $price = 0;
    public $amount = 0;
    public $discount = 0;

    public $purchase_amount = 0;
    public $discount_type = 1;

    public $tax_type, $tax_percentage;
    public $hsn_code, $rack_no, $category, $customerPrice = 0, $selling_amount = 0;
    public $online_price = 0, $offline_price = 0;
    public $imageName, $imageImage, $image, $searchfilter;
    public $brand_name, $variant_name, $selected_year, $modification_id;
    public $brands = [], $variants = [], $years = [], $filter_modifications = [], $modifications = [];
    protected $listeners = ['delete'];
    public $units, $categories;
    /** @var string[] Top-level product group names from TecDoc API (Body, Electrics, …) */
    public array $apiRootCategoryNames = [];
    public $part_image_url;
    public $api_compatible_vehicles = [];
    public $apiCategoryName;

    public $supplier_id;
    public $suppliers;
    protected $rules = [
        'name' => 'required',
        'purchase_amount' => 'required|numeric|min:1',
        'selling_amount' => 'required|numeric|min:1',
        'unit' => 'required|integer',
        'stock' => 'required|integer|min:0',
        'brand' => 'nullable|string',
        // 'suitable_for' => 'nullable|string',
        'discount' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
        // 'image_id' => 'nullable|string',
        // 'part_number' => 'required',
        'sp_type' => 'required',
        'category' => 'nullable|integer',
    ];

    public function mount()
    {
        $this->sparepartId = Auth::guard('sparepart')->user()->id;
        $this->resetForm();
        $this->commission = getCommission(2);
        $this->sparePartLabels = SparePartLabel::select('id', 'title')->where('spare_part_type', 2)->get();
        $this->imageName = '';
        $this->imageImage = '';

        // Load brands from local DB
        try {
            $this->brands = Modification::where('status', 1)
                ->select('brand_name as name')
                ->distinct()
                ->pluck('name')
                ->toArray();
        } catch (\Exception $e) {
            \Log::error('Error loading local brands: ' . $e->getMessage());
            $this->brands = [];
        }

        $this->variants = [];
        $this->years = [];

        $this->units = Unit::all();
        SparePartCategoryService::syncParentsFromApi();
        $this->apiRootCategoryNames = SparePartCategoryService::getRootNames();
        $this->categories = SparePartCategoryService::getDropdownCategories();
        $this->suppliers = SparePartSupplier::orderBy('id', 'desc')
            ->where('user_id', Auth::guard('sparepart')->id())
            ->get();
    }

    public function updatedBrandName($value)
    {
        $this->variant_name = '';
        $this->selected_year = '';
        $this->modification_id = '';
        $this->variants = [];
        $this->years = [];
        $this->filter_modifications = [];

        if (empty($value)) return;

        try {
            $this->variants = Modification::where('status', 1)
                ->where('brand_name', $value)
                ->select('variant_name as name')
                ->distinct()
                ->pluck('name')
                ->toArray();
        } catch (\Exception $e) {
            \Log::error('Error fetching variants: ' . $e->getMessage());
            $this->variants = [];
        }
    }

    public function updatedVariantName($value)
    {
        $this->selected_year = '';
        $this->modification_id = '';
        $this->years = [];
        $this->filter_modifications = [];

        if (empty($value) || empty($this->brand_name)) return;

        try {
            // Fetch distinct year strings from the local modifications table
            $this->years = Modification::where('status', 1)
                ->where('brand_name', $this->brand_name)
                ->where('variant_name', $value)
                ->select('year')
                ->distinct()
                ->pluck('year')
                ->map(function ($year) {
                    return ['value' => $year, 'label' => $year];
                })
                ->toArray();
        } catch (\Exception $e) {
            \Log::error('Error fetching years: ' . $e->getMessage());
            $this->years = [];
        }
    }

    public function updatedSelectedYear($value)
    {
        $this->modification_id = '';
        $this->filter_modifications = [];

        if (empty($value) || empty($this->brand_name) || empty($this->variant_name)) return;

        try {
            $this->filter_modifications = Modification::where('status', 1)
                ->where('brand_name', $this->brand_name)
                ->where('variant_name', $this->variant_name)
                ->where('year', 'like', '%' . $value . '%')
                ->select('id', 'title as name')
                ->distinct()
                ->get()
                ->toArray();
        } catch (\Exception $e) {
            \Log::error('Error fetching filter modifications: ' . $e->getMessage());
            $this->filter_modifications = [];
        }
    }

    public function resetFilter()
    {
        $this->reset([
            'searchfilter',
            'brand_name',
            'variant_name',
            'selected_year',
            'modification_id'
        ]);
        $this->variants = [];
        $this->years = [];
        $this->filter_modifications = [];
    }

    public function updatedForAllVehicles($value)
    {
        if ($value) {
            $this->suitable_for = [];
            $this->forAllVehicles = true;
        } else {
            $this->forAllVehicles = false;
        }
    }

    public function render()
    {
        $parts = Part::with('label', 'unit')->where('spare_part_type', 2)->where('user_id', $this->sparepartId);

        if ($this->brand_name || $this->variant_name || $this->selected_year || $this->modification_id) {
            $parts->whereHas('modifications', function ($q) {
                // Extract actual brand name from JSON
                if (!empty($this->brand_name)) {
                    $decodedBrand = @json_decode($this->brand_name, true);
                    $actualBrandName = (is_array($decodedBrand) && isset($decodedBrand['name'])) ? $decodedBrand['name'] : $this->brand_name;
                    $q->where('brand_name', $actualBrandName);
                }
                
                // Extract actual variant name from index
                if (!empty($this->variant_name) && $this->variant_name !== '') {
                    $variant = $this->variants[$this->variant_name] ?? null;
                    $actualVariantName = is_array($variant) ? ($variant['name'] ?? '') : ($variant->name ?? $this->variant_name);
                    $q->where('variant_name', $actualVariantName);
                }
                
                // Year might be stored as "2010 / 2012", so use LIKE
                if (!empty($this->selected_year)) {
                    $q->where('year', 'like', '%' . $this->selected_year . '%');
                }
                
                // Extract modification title from API array
                if (!empty($this->modification_id)) {
                    $mod = collect($this->filter_modifications)->firstWhere('id', $this->modification_id);
                    if ($mod) {
                        $q->where('title', $mod['name'] ?? '');
                    } else {
                        // Fallback if not found in array (maybe it's a local ID)
                        $q->where('modifications.id', $this->modification_id);
                    }
                }
            });
        }

        if ($this->searchfilter) {
            $search = trim($this->searchfilter);
            $parts->where(function ($query) use ($search) {
                $query->whereHas('label', function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                ->orWhereHas('unit', function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                ->orWhereHas('modifications', function ($query) use ($search) {
                    $query->where('brand_name', 'like', '%' . $search . '%')
                        ->orWhere('variant_name', 'like', '%' . $search . '%')
                        ->orWhere('title', 'like', '%' . $search . '%')
                        ->orWhere('year', 'like', '%' . $search . '%')
                        ->orWhere('engine_name', 'like', '%' . $search . '%');
                })
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('brand', 'like', '%' . $search . '%')
                ->orWhere('part_number', 'like', '%' . $search . '%')
                ->orWhere('hsn_code', 'like', '%' . $search . '%')
                ->orWhere('rack_no', 'like', '%' . $search . '%')
                ->orWhere('suitable_for', 'like', '%' . $search . '%');
            });
        }

        $parts = $parts->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.sparepart.part', [
            'parts' => $parts,
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->isView = false;
        $this->showModal = true;
        $this->reset('selling_amount', 'tax_type', 'category', 'part_number', 'forAllVehicles', 'suitable_for');
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
                $this->suitable_for = collect($this->api_compatible_vehicles)->pluck('id')->toArray();
            } else {
                // If modifications are available, use active modification IDs
                $this->suitable_for = Modification::where('status', 1)->pluck('id')->toArray();
            }
        }

        if (empty($this->suitable_for)) {
            $this->addError('suitable_for', "No compatible vehicles found. Please select at least one.");
            return;
        }

        // Start logging
        $logData = [
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'action' => 'store_part',
            'user_id' => $this->sparepartId,
            'part_name' => $this->name,
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

        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $this->name],
            ['title' => $this->name, 'spare_part_type' => 2]
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
                $apiVehicle = collect($this->api_compatible_vehicles)->firstWhere('id', $vehicleId);

                if ($apiVehicle) {
                    $vehicleLog['processing_type'] = 'api_vehicle';
                    $vehicleLog['api_data'] = $apiVehicle;

                                        // Dynamic Brand and Variant creation
                    $makerType = MakerType::firstOrCreate(['title' => $apiVehicle['manufacturerName']], ['status' => 1]);
                    $maker = Maker::firstOrCreate(
                        ['title' => $apiVehicle['modelName'], 'maker_type_id' => $makerType->id],
                        ['status' => 1]
                    );

                    // Detect fuel type dynamically from typeEngineName
                    $fuelType = null;
                    $engineNameLower = strtolower($apiVehicle['typeEngineName'] ?? '');
                    if (str_contains($engineNameLower, 'diesel') || str_contains($engineNameLower, 'cdi') || str_contains($engineNameLower, 'crdi') || str_contains($engineNameLower, 'tdi') || str_contains($engineNameLower, 'ddis') || str_contains($engineNameLower, 'dci') || preg_match('/\b\d+ d\b/', $engineNameLower)) {
                        $fuelType = 'Diesel';
                    } elseif (str_contains($engineNameLower, 'petrol') || str_contains($engineNameLower, 'tsi') || str_contains($engineNameLower, 'tfsi') || str_contains($engineNameLower, 'vti') || str_contains($engineNameLower, 'gdi') || str_contains($engineNameLower, 'mpfi') || preg_match('/\b\d+ i\b/', $engineNameLower)) {
                        $fuelType = 'Petrol';
                    }

                    $titleText = $apiVehicle['typeEngineName'] ?? $apiVehicle['engineName'] ?? $apiVehicle['engine'] ?? ($apiVehicle['manufacturerName'] . ' ' . $apiVehicle['modelName']);

                    // Save to modifications table
                    $modification = Modification::updateOrCreate(
                        [
                            'brand_name' => $apiVehicle['manufacturerName'],
                            'variant_name' => $apiVehicle['modelName'],
                            'title' => $titleText,
                            'year' => $apiVehicle['year'] ?? date('Y'),
                        ],
                        [
                            'engine_name' => $apiVehicle['typeEngineName'] ?? null,
                            'fuel_type' => $fuelType,
                            'brand_id' => $makerType->id,
                            'variant_id' => $maker->id,
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
            // Smart truncation to avoid SQL "Data too long" error
            if (count($vehicleNames) > 10) {
                $suitableForString = "Multiple Vehicles (" . count($vehicleNames) . ")";
            } else {
                $suitableForString = implode(', ', $vehicleNames);
            }
        }

        $logData['vehicle_processing_log'] = $vehicleProcessingLog;
        $logData['suitable_for_string'] = $suitableForString;
        $logData['selected_vehicle_ids'] = $selectedVehicleIds;

        $part = Part::create([
             'name'=>$this->name,
            'user_id' => $this->sparepartId,
            'spare_part_type' => 2,
            'label_id' => $sparePartLabel->id,
            'brand' => $this->brand ?? '',
            'price' => $this->customerPrice,
            'amount' => $this->price,
            'unit_id' => $this->unit,
            'suitable_for' => $suitableForString, // Save as string like before
            'hsn_code' => $this->hsn_code,
            'rack_no' => $this->rack_no,
            'discount' => $this->discount ?? 0,
            'stock' => $this->stock,
            'description' => $this->description ?? '',
            'image' => $this->image_id,
            'part_number' => $this->part_number,
            'sp_type' => $this->sp_type,
            'purchase_price' => $this->purchase_amount,
            'tax_type' => $this->tax_type,
            'tax_percentage' => $this->tax_percentage,
            'category_id' => $this->category,
            'selling_amount' => $this->selling_amount,
            'discount_type' => $this->discount_type,
            'platform_charge' => $this->commission,
            'forAllVehicles' => $this->forAllVehicles ? 1 : 0,
             'supplier_id' => $this->supplier_id,
        ]);

        $logData['part_created'] = true;
        $logData['part_id'] = $part->id;
        $logData['part_data'] = $part->toArray();

        $stockProduct = ProductStock::where(['label_id' => $sparePartLabel->id, 'price' => $this->price, 'user_id' => $this->sparepartId])->first();

        if (empty($stockProduct)) {
            $stockProducts = new ProductStock;
            $stockProducts->label_id = $sparePartLabel->id;
            $stockProducts->category_id = 2;
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
        $stockHistory->spare_part_id = $part->id;
        $stockHistory->category = 2;
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
                'spare_part_id' => $part->id,
                'vehicle_modification_id' => $vehicleId
            ]);
            $pivotLog[] = [
                'pivot_id' => $pivotRecord->id,
                'spare_part_id' => $part->id,
                'vehicle_modification_id' => $vehicleId
            ];
        }

        $logData['pivot_records_created'] = $pivotLog;

        // Write to log file
        $logFile = storage_path('logs/vehicle_saving.log');
        $logEntry = json_encode($logData, JSON_PRETTY_PRINT) . "\n" . str_repeat('-', 80) . "\n";
        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Part added successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $this->isView = false;
        $part = Part::findOrFail($id);

        $this->partId = $part->id;
        $this->name = $part->name;
        $this->brand = $part->brand;
        $this->unit = $part->unit_id;
        $this->discount = $part->discount;
        $this->tax_type = $part->tax_type;
        $this->tax_percentage = $part->tax_percentage;
        $this->purchase_amount = $part->purchase_price;
        $this->stock = $part->stock;
        $this->description = $part->description;
        $this->image_id = $part->image;
        $this->hsn_code = $part->hsn_code;
        $this->rack_no = $part->rack_no;
        $this->part_number = $part->part_number;
        $this->sp_type = $part->sp_type;
        $this->category = $part->category_id;

        // Load category name for display in the Auto-detected Category field
        if ($part->category_id) {
            $cat = \App\Models\Category::find($part->category_id);
            $this->apiCategoryName = $cat ? $cat->title : '';
            SparePartCategoryService::ensureCategoryInDropdown($this->categories, (int) $part->category_id);
        }

        $this->reflectedPrice = $part->amount;
        $this->selling_amount = $part->selling_amount;
        $this->discount_type = $part->discount_type;
        $this->customerPrice = $part->price;
        $this->price = $part->amount;
        $this->supplier_id = $part->supplier_id;

        // Extract Article ID and OEM list from description if they exist
        if (!empty($this->description)) {
            if (preg_match('/Article ID: (\d+)/', $this->description, $matches)) {
                $this->articleId = $matches[1];
            }
            
            if (preg_match('/OEM CROSS-REFERENCES:\n(.*?)(?=\n\n|\nPRODUCT DETAILS:|$)/s', $this->description, $matches)) {
                $oemSection = $matches[1];
                $oemLines = explode("\n", trim($oemSection));
                $oems = [];
                foreach ($oemLines as $line) {
                    $oems[] = ltrim($line, '- ');
                }
                $this->oem_list = implode(', ', $oems);
            }
        }

        $image = UploadImage::find($part->image);
        $this->imageImage = $image ? $image->file : null;

        $this->showModal = true;

        if ($part->forAllVehicles == 1) {
            $this->forAllVehicles = true;
            $this->suitable_for = [];
        } else {
            // Load from pivot table
            $sparePartVehicleModification = SparePartVehicleModification::where('spare_part_id', $part->id)->get();
            $this->suitable_for = $sparePartVehicleModification->pluck('vehicle_modification_id')->toArray();
            
            // Load modifications so they display in the edit/view modal
            if (!empty($this->suitable_for)) {
                $this->modifications = \App\Models\Modification::whereIn('id', $this->suitable_for)->get();
            } else {
                $this->modifications = collect();
            }
        }

        $this->calculatePrice();
    }

    public function view($id)
    {
        $this->edit($id);
        $this->isEdit = false;
        $this->isView = true;
    }

    public function update()
    {
        $this->validate([
            'supplier_id' => 'required|exists:spare_part_suppliers,id',
        ]);
        $this->validate();

         // Automatically populate suitable_for with all available vehicles if empty
         if (empty($this->suitable_for)) {
            if (!empty($this->api_compatible_vehicles)) {
                // If API vehicles are available, use their IDs
                $this->suitable_for = collect($this->api_compatible_vehicles)->pluck('id')->toArray();
            } else {
                // If modifications are available, use active modification IDs
                $this->suitable_for = Modification::where('status', 1)->pluck('id')->toArray();
            }
        }


        if (empty($this->suitable_for)) {
            $this->addError('suitable_for', "No compatible vehicles found");
            return;
        }

        // Start logging
        $logData = [
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'action' => 'update_part',
            'user_id' => $this->sparepartId,
            'part_id' => $this->partId,
            'part_name' => $this->name,
            'part_number' => $this->part_number,
            'forAllVehicles' => $this->forAllVehicles,
            'suitable_for_selected' => $this->suitable_for,
            'api_compatible_vehicles_count' => count($this->api_compatible_vehicles),
        ];

        $part = Part::findOrFail($this->partId);

        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $this->name],
            ['title' => $this->name, 'spare_part_type' => 2]
        );

        SparePartVehicleModification::where('spare_part_id', $part->id)->delete();

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
                $apiVehicle = collect($this->api_compatible_vehicles)->firstWhere('id', $vehicleId);

                if ($apiVehicle) {
                    $vehicleLog['processing_type'] = 'api_vehicle';
                    $vehicleLog['api_data'] = $apiVehicle;

                                        // Dynamic Brand and Variant creation
                    $makerType = MakerType::firstOrCreate(['title' => $apiVehicle['manufacturerName']], ['status' => 1]);
                    $maker = Maker::firstOrCreate(
                        ['title' => $apiVehicle['modelName'], 'maker_type_id' => $makerType->id],
                        ['status' => 1]
                    );

                    // Detect fuel type dynamically from typeEngineName
                    $fuelType = null;
                    $engineNameLower = strtolower($apiVehicle['typeEngineName'] ?? '');
                    if (str_contains($engineNameLower, 'diesel') || str_contains($engineNameLower, 'cdi') || str_contains($engineNameLower, 'crdi') || str_contains($engineNameLower, 'tdi') || str_contains($engineNameLower, 'ddis') || str_contains($engineNameLower, 'dci') || preg_match('/\b\d+ d\b/', $engineNameLower)) {
                        $fuelType = 'Diesel';
                    } elseif (str_contains($engineNameLower, 'petrol') || str_contains($engineNameLower, 'tsi') || str_contains($engineNameLower, 'tfsi') || str_contains($engineNameLower, 'vti') || str_contains($engineNameLower, 'gdi') || str_contains($engineNameLower, 'mpfi') || preg_match('/\b\d+ i\b/', $engineNameLower)) {
                        $fuelType = 'Petrol';
                    }

                    $titleText = $apiVehicle['typeEngineName'] ?? $apiVehicle['engineName'] ?? $apiVehicle['engine'] ?? ($apiVehicle['manufacturerName'] . ' ' . $apiVehicle['modelName']);

                    // Save to modifications table
                    $modification = Modification::updateOrCreate(
                        [
                            'brand_name' => $apiVehicle['manufacturerName'],
                            'variant_name' => $apiVehicle['modelName'],
                            'title' => $titleText,
                            'year' => $apiVehicle['year'] ?? date('Y'),
                        ],
                        [
                            'engine_name' => $apiVehicle['typeEngineName'] ?? null,
                            'fuel_type' => $fuelType,
                            'brand_id' => $makerType->id,
                            'variant_id' => $maker->id,
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
            // Smart truncation to avoid SQL "Data too long" error
            if (count($vehicleNames) > 10) {
                $suitableForString = "Multiple Vehicles (" . count($vehicleNames) . ")";
            } else {
                $suitableForString = implode(', ', $vehicleNames);
            }
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
            // If it's still a temporary file (unlikely due to updatedImage), handle it
            if (method_exists($this->image, 'store')) {
                $this->imageName = $this->image->store("uploads", "public_root");
                $uploadid = UploadImage::create(["file" => $this->imageName]);
                $this->image_id = $uploadid->id;
            }
        }

        $part->update([
             'name'=>$this->name,
            'user_id' => $this->sparepartId,
            'spare_part_type' => 2,
            'label_id' => $sparePartLabel->id,
            'brand' => $this->brand ?? '',
            'price' => $this->customerPrice,
            'amount' => $this->reflectedPrice,
            'hsn_code' => $this->hsn_code,
            'rack_no' => $this->rack_no,
            'unit_id' => $this->unit,
            'suitable_for' => $suitableForString, // Save as string like before
            'discount' => $this->discount ?? 0,
            'stock' => $this->stock,
            'description' => $this->description ?? '',
            'image' => $this->image_id,
            'part_number' => $this->part_number,
            'sp_type' => $this->sp_type,
            'purchase_price' => $this->purchase_amount,
            'tax_type' => $this->tax_type,
            'tax_percentage' => $this->tax_percentage,
            'category_id' => $this->category,
            'selling_amount' => $this->selling_amount,
            'discount_type' => $this->discount_type,
            'platform_charge' => $this->commission,
            'forAllVehicles' => $this->forAllVehicles ? 1 : 0,
            'supplier_id' => $this->supplier_id,
        ]);

        $logData['part_updated'] = true;
        $logData['part_data'] = $part->fresh()->toArray();

        // Save to pivot table for relationship
        $pivotLog = [];
        foreach ($selectedVehicleIds as $vehicleId) {
            $pivotRecord = SparePartVehicleModification::create([
                'spare_part_id' => $part->id,
                'vehicle_modification_id' => $vehicleId
            ]);
            $pivotLog[] = [
                'pivot_id' => $pivotRecord->id,
                'spare_part_id' => $part->id,
                'vehicle_modification_id' => $vehicleId
            ];
        }

        $logData['pivot_records_created'] = $pivotLog;

        // Write to log file
        $logFile = storage_path('logs/vehicle_saving.log');
        $logEntry = json_encode($logData, JSON_PRETTY_PRINT) . "\n" . str_repeat('-', 80) . "\n";
        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Part updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }


    public function confirmDelete($id)
    {
        $this->partId = $id;
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
        Part::destroy($this->partId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Part deleted successfully!']);
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
        $part = Part::where('id', $this->partId)->first();
        $part->update([
            'image' => $this->image_id ?? 0,

        ]);
    }




    public function addPartLabel()
    {
        $this->showPartModel = true;
    }


    public function partLabelStore()
    {

        $valArr = [
            'part_label' => ["required"],
        ];

        $this->validate($valArr);


        $category = SparePartLabel::create([
            'title' => $this->part_label,
            'spare_part_type' => 2,
        ]);

        $this->sparePartLabels = SparePartLabel::select('id', 'title')->where('spare_part_type', 2)->get();

        $this->dispatch('swal:toast', ['message' => 'Part Label added successfully!']);
        $this->resetForm();
        $this->part_label = '';
        $this->showPartModel = false;
    }
    private function resetForm()
    {
        $this->name = '';
        $this->brand = '';
        $this->sp_type = '';
        $this->part_number = '';
        $this->price = '';
        $this->unit = null;
        $this->suitable_for = [];
        $this->suitableForData = [];
        $this->discount = 0;
        $this->discount_type = 1;
        $this->purchase_amount = 0;
        $this->hsn_code = '';
        $this->rack_no = '';
        $this->stock = 0;
        $this->description = '';
        $this->image_id = null;
        $this->imagePreview = null;
        $this->image = '';
        $this->imageName = '';
        $this->partId = null;
        $this->amount = 0;
        $this->tax_percentage = 0;
        $this->tax_type = '';
        $this->reflectedPrice = 0;
        $this->customerPrice = 0;
        $this->part_image_url = null;
        $this->api_compatible_vehicles = [];
        $this->articleId = '';
        $this->oem_list = '';
        $this->brandFilter = '';
        $this->selling_amount = 0;
        $this->category = '';
        $this->supplier_id = '';
        $this->forAllVehicles = false;
        $this->isEdit = false;
        $this->isView = false;
        $this->imageImage = '';
        $this->imageId = null;
        $this->uploadedImageId = null;
        $this->oemNumbers = [];
        $this->online_price = 0;
        $this->offline_price = 0;
        $this->apiCategoryName = '';
        $this->selectAll = false;
    }

    public function updatedSellingamount($value)
    {
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
        $this->calculatePrice();
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
            // If include or no tax, the selling amount is the total price
            $price = $sellingAmount;
        }

        $this->offline_price = $price;

        if ($this->discount_type == 1) {
            $price -= $discount;
        } elseif ($this->discount_type == 2) {
            $discountAmount = ($price * $discount) / 100;
            $price -= $discountAmount;
        }
        
        $this->online_price = $price;

        $this->reflectedPrice = $this->price = $price;
        
        $totalCommission = ($price * $commission) / 100;
        $this->customerPrice = $price;
    }

    public function updateSuitableFor($selectedValues)
    {
        $this->suitable_for = $selectedValues;
    }

    public function updatedImage()
    {
        if (!empty($this->image)) {
            $this->imageName = $this->image->store("uploads", "public_root");
            $uploadid = UploadImage::create([
                "file" => $this->imageName,
            ]);
            $this->image_id = $uploadid->id;
            $this->imageImage = $uploadid->file;
            $this->image = null; // Clear to prevent blade error
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Image uploaded',]);
    }

    public function updatedResetfilter()
    {
        $this->resetPage();
    }

    public function updated()
    {
        $this->resetErrorBag();
    }

    public function updatedSearchfilter(){
        $this->resetPage();
    }


    private function resetApiData()
    {
        $this->name = '';
        $this->brand = '';
        $this->articleId = '';
        $this->oem_list = '';
        $this->description = '';
        $this->part_image_url = null;
        $this->api_compatible_vehicles = [];
        $this->oemNumbers = [];
        $this->apiCategoryName = '';
    }
    public function updatedPartNumber($value)
    {
        $value = trim($value);
        if (strlen($value) < 3) {
            $this->resetApiData();
            return;
        }

        $this->isSearching = true;

        try {
            $cleanValue = preg_replace('/[^A-Za-z0-9]/', '', $value);
            $searchResponse = Http::timeout(30)->withHeaders([
                'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
                'X-RapidAPI-Key' => config('services.rapidapi.key'),
            ])->get('https://auto-parts-catalog.p.rapidapi.com/artlookup/search-for-cross-numbers/lang-id/4/article-type/ArticleNumber/article-no/' . $cleanValue);

            if ($searchResponse->successful() && !empty($searchResponse->json()['articles'])) {
                $article = $searchResponse->json()['articles'][0];
                $this->articleId = $article['articleId'] ?? null;
                
                $baseName = $article['articleProductName'] ?? 'Unknown Part';
                $brand = $article['supplierName'] ?? '';
                $artNo = $article['articleNo'] ?? $value;
                
                $this->name = "{$baseName} {$brand} {$artNo}";
                $this->brand = $brand;
                $this->part_image_url = $article['s3image'] ?? null;

                if ($this->articleId && !$this->resolveArticleCategory((int) $this->articleId)) {
                    $this->apiCategoryName = '';
                    $this->category = '';
                    Log::warning('Could not resolve parent category for article: ' . $this->articleId);
                }
                
                Log::info('Fetched Article: ' . json_encode($article));

                // Step 2: OEM FETCH - Get OEM numbers using POST endpoint (Modular)
                $rawOems = [];
                if ($this->articleId) {
                    $oemResponse = Http::timeout(30)->withHeaders([
                        'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
                        'X-RapidAPI-Key' => config('services.rapidapi.key'),
                        'Content-Type' => 'application/json',
                    ])->post('https://auto-parts-catalog.p.rapidapi.com/articles/get-oems-by-list-of-articles-ids', [
                        'articleIds' => [(int)$this->articleId]
                    ]);

                    if ($oemResponse->successful() && !empty($oemResponse->json())) {
                        $oemResult = $oemResponse->json();
                        if (!empty($oemResult['articles'][0]['oemNo'])) {
                            foreach ($oemResult['articles'][0]['oemNo'] as $oem) {
                                $rawOems[] = [
                                    'manufacturerName' => $oem['oemBrand'] ?? 'OEM',
                                    'oemNumber' => $oem['oemDisplayNo'] ?? 'N/A'
                                ];
                            }
                        }
                    }
                }

                if (!empty($rawOems)) {
                    $oemStrings = [];
                    foreach ($rawOems as $o) {
                        $oemStrings[] = $o['manufacturerName'] . ': ' . $o['oemNumber'];
                    }
                    $this->oem_list = implode(', ', array_unique($oemStrings));
                    Log::info('Final OEM List: ' . $this->oem_list);
                } else {
                    $this->oem_list = 'No OEM Numbers Found';
                    Log::warning('No OEMs found for ID: ' . $this->articleId);
                }

                $descriptionParts = [];
                $descriptionParts[] = "--- TECHNICAL SPECIFICATIONS ---";
                $descriptionParts[] = "Article ID: " . ($this->articleId ?? 'N/A');
                
                if (!empty($rawOems)) {
                    $descriptionParts[] = "\nOEM CROSS-REFERENCES:";
                    foreach ($rawOems as $oem) {
                        $descriptionParts[] = "- " . $oem['manufacturerName'] . ": " . $oem['oemNumber'];
                    }
                }
                $this->description = implode("\n", $descriptionParts);
                // Step 5: Compatible Vehicles
                $this->api_compatible_vehicles = []; 
                Log::info('Fetching Compatibility for Article ID: ' . $this->articleId);
                
                $compResponse = Http::timeout(30)->withHeaders([
                    'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
                    'X-RapidAPI-Key' => config('services.rapidapi.key'),
                ])->get('https://auto-parts-catalog.p.rapidapi.com/articles/article-complete-details/type-id/1', [
                    'langId' => 4,
                    'countryFilterId' => 119,
                    'articleId' => $this->articleId
                ]);

                Log::info('Comp Response Status: ' . $compResponse->status());
                if ($compResponse->successful()) {
                    $compData = $compResponse->json();

                    // Confirmed by API test: root key is 'article', vehicles are in 'compatibleCars'
                    $root = $compData['article'] ?? $compData['articleDetails'] ?? null;

                    // Confirmed vehicle array key is 'compatibleCars'
                    $linkedVehicles = $root['compatibleCars'] ?? $root['linkedVehicles'] ?? [];

                    Log::info('Found compatible vehicles: ' . count($linkedVehicles));

                    foreach ($linkedVehicles as $v) {
                        $engineName = $v['typeEngineName'] ?? $v['engineName'] ?? $v['engine'] ?? '';
                        
                        $startYear = substr($v['constructionIntervalStart'] ?? $v['year'] ?? '', 0, 4);
                        $endYear = substr($v['constructionIntervalEnd'] ?? '', 0, 4);
                        
                        if (!empty($startYear)) {
                            $yearRange = $startYear;
                            if (!empty($endYear)) {
                                $yearRange .= ' / ' . $endYear;
                            }
                        } else {
                            $yearRange = date('Y');
                        }

                        $this->api_compatible_vehicles[] = [
                            'id'               => $v['vehicleId'] ?? $v['id'],
                            'manufacturerName' => $v['manufacturerName'] ?? $v['brand'] ?? 'Unknown',
                            'modelName'        => $v['modelName'] ?? $v['model'] ?? 'Standard',
                            'typeEngineName'   => $engineName,
                            'year'             => $yearRange,
                        ];
                    }
                    
                    // Auto-select fetched compatible vehicles
                    $this->suitable_for = array_column($this->api_compatible_vehicles, 'id');
                    $this->selectAll = true;
                    
                } else {
                    Log::error('Comp Fetch Failed: ' . $compResponse->body());
                }
                
                $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Details & Compatibility synchronized!']);
            } else {
                $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'No part found.']);
            }
        } catch (\Exception $e) {
            Log::error('API Error: ' . $e->getMessage());
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'API Connection error.']);
        } finally {
            $this->isSearching = false;
        }
    }


    /**
     * Resolve parent category (Body, Electrics, …) from get-article-categories API.
     */
    private function resolveArticleCategory(int $articleId): bool
    {
        $headers = [
            'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
            'X-RapidAPI-Key'  => config('services.rapidapi.key'),
        ];

        $categoriesResponse = Http::timeout(30)->withHeaders($headers)
            ->get('https://auto-parts-catalog.p.rapidapi.com/articles/get-article-categories/article-id/' . $articleId . '/lang-id/4');

        if (!$categoriesResponse->successful()) {
            return false;
        }

        $categories = $categoriesResponse->json();
        if (!is_array($categories) || empty($categories)) {
            return false;
        }

        $primaryCategoryId = null;
        $singularResponse = Http::timeout(30)->withHeaders($headers)
            ->get('https://auto-parts-catalog.p.rapidapi.com/articles/get-article-category/article-id/' . $articleId . '/lang-id/4');

        if ($singularResponse->successful() && !empty($singularResponse->json()['categoryId'])) {
            $primaryCategoryId = (int) $singularResponse->json()['categoryId'];
        }

        $selected = collect($categories)->first(
            fn ($cat) => $primaryCategoryId && (int) ($cat['categoryId'] ?? 0) === $primaryCategoryId
        ) ?? $categories[0];

        $specificName = trim($selected['categoryName'] ?? '');
        $this->apiRootCategoryNames = SparePartCategoryService::getRootNames();
        $topLevel = $this->extractRootCategoryName($selected['categoryParentName'] ?? []);

        if ($topLevel === '' && $specificName !== '') {
            $topLevel = $specificName;
        }

        if ($topLevel === '') {
            return false;
        }

        $this->apiCategoryName = $topLevel;
        $this->saveOrFindCategory($topLevel, $specificName);

        return true;
    }

    /**
     * Pick the top-level parent (Body, Electrics, …) from categoryParentName chain.
     */
    private function extractRootCategoryName(array $categoryParentName): string
    {
        if (empty($categoryParentName)) {
            return '';
        }

        $roots = $this->apiRootCategoryNames;
        if (!empty($roots)) {
            foreach (array_reverse($categoryParentName) as $parent) {
                if (!is_array($parent)) {
                    continue;
                }
                $name = trim($parent['categoryName'] ?? '');
                if ($name !== '' && in_array($name, $roots, true)) {
                    return $name;
                }
            }
        }

        $root = end($categoryParentName);

        return is_array($root) ? trim($root['categoryName'] ?? '') : '';
    }

    /**
     * Match or create local category using top-level parent name from API.
     */
    private function saveOrFindCategory(string $topLevel, string $specificName = ''): void
    {
        $topLevel = trim($topLevel);
        if ($topLevel === '') {
            return;
        }

        $cat = Category::where('title', $topLevel)->first();

        if (!$cat) {
            $cat = Category::where('title', 'like', $topLevel)->first();
        }

        if (!$cat) {
            $cat = Category::create(['title' => $topLevel]);
            Log::info('Created new parent category: ' . $topLevel);
            SparePartCategoryService::ensureCategoryInDropdown($this->categories, $cat->id);
        }

        $this->category = $cat->id;
        Log::info('Category set to: [' . $cat->id . '] ' . $cat->title . ($specificName ? ' (sub: ' . $specificName . ')' : ''));
    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            if (!empty($this->api_compatible_vehicles)) {
                $this->suitable_for = array_column($this->api_compatible_vehicles, 'id');
            } else {
                $this->suitable_for = Modification::where('status', 1)->pluck('id')->toArray();
            }
        } else {
            $this->suitable_for = [];
        }
    }

}
