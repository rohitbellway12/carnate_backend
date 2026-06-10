<?php

namespace App\Livewire\Workshop;

use Livewire\Component;
use App\Services\RapidApiVehicleService;
use App\Models\Modification;
use App\Models\Maker;
use App\Models\MakerType;

class VehicleSelector extends Component
{
    public $brands = [], $variants = [], $years = [], $modifications = [], $all_modifications = [];
    public $brand_name, $variant_name, $selected_year, $search_vehicle, $selectedVehicleName;
    
    // API coordinate properties
    public $selectedBrandId, $selectedModelId, $modificationId;

    public function mount()
    {
        try {
            $vehicleService = new RapidApiVehicleService();
            $brandsList = $vehicleService->getBrandsList();
            $this->brands = $brandsList->toArray();
        } catch (\Exception $e) {
            \Log::error('Error loading brands in VehicleSelector: ' . $e->getMessage());
            $this->brands = [];
        }
    }

    public function render()
    {
        return view('livewire.workshop.vehicle-selector');
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
        $this->selectedVehicleName = '';
        
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
            \Log::error('Error fetching models in VehicleSelector: ' . $e->getMessage());
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
        $this->selectedVehicleName = '';
        
        if ($value === '' || !isset($this->variants[$value])) {
            return;
        }
        
        $variant = $this->variants[$value];
        $modelId = $variant['id'] ?? null;
        $modelName = $variant['name'] ?? null;
        $modelYearFrom = $variant['modelYearFrom'] ?? null;
        $modelYearTo = $variant['modelYearTo'] ?? null;
        
        if ($modelId && $modelYearFrom) {
            $yearFrom = (int)substr($modelYearFrom, 0, 4);
            $yearTo = $modelYearTo ? (int)substr($modelYearTo, 0, 4) : (int)date('Y');
            
            $yearsArray = range($yearFrom, $yearTo);
            $this->years = array_reverse($yearsArray);
            
            $this->selectedModelId = $modelId;
            $this->selectedVehicleName = $modelName;

            try {
                $vehicleService = new RapidApiVehicleService();
                $typesList = $vehicleService->getVehicleTypesList($modelId);
                $this->all_modifications = $typesList->toArray();
            } catch (\Exception $e) {
                \Log::error('Error fetching modifications in VehicleSelector: ' . $e->getMessage());
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

    public function updatedSearchVehicle($id)
    {
        if(empty($id)) {
            $this->selectedVehicleName = '';
            $this->modificationId = null;
            return;
        }

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
            $localMod = Modification::find($id);
            if ($localMod) {
                $this->modificationId = $localMod;
                $this->selectedVehicleName = trim("{$localMod->brand_name} {$localMod->variant_name} | {$localMod->title} ({$localMod->year})");
            } else {
                $this->selectedVehicleName = '';
            }
        }
    }

    public function addVehicle()
    {
        if (empty($this->search_vehicle) || !$this->modificationId) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Please select the complete vehicle details (Modification) first.',
            ]);
            return;
        }

        // Create/retrieve MakerType (Brand)
        $makerType = MakerType::firstOrCreate(
            ['title' => $this->modificationId->brand_name ?? ''],
            ['status' => 1]
        );

        // Create/retrieve Maker (Model)
        $maker = Maker::firstOrCreate(
            ['title' => $this->modificationId->variant_name ?? '', 'maker_type_id' => $makerType->id],
            ['status' => 1]
        );

        // Get matching modification details from all modifications
        $mod = collect($this->all_modifications)->firstWhere('id', $this->search_vehicle);
        $fuelType = $mod ? ($mod['fuelType'] ?? null) : null;
        $typeEngineName = $mod ? ($mod['name'] ?? null) : null;
        
        $startYear = substr($mod['yearFrom'] ?? '', 0, 4);
        $endYear = substr($mod['yearTo'] ?? '', 0, 4);
        $yearRange = $startYear;
        if (!empty($endYear)) {
            $yearRange .= ' / ' . $endYear;
        }

        // Create/update the local Modification record
        $localModification = Modification::updateOrCreate(
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

        // Dispatch vehicle added event to the parent
        $this->dispatch('vehicleAdded', $localModification->id);

        // Reset inputs
        $this->reset('brand_name', 'variant_name', 'selected_year', 'search_vehicle', 'selectedVehicleName', 'modificationId', 'variants', 'years', 'modifications', 'all_modifications');

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicle successfully added to list!',
        ]);
    }
}
