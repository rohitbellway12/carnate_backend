<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RapidApiVehicleService
{
    private const API_HOST = 'auto-parts-catalog.p.rapidapi.com';
    private const LANG_ID = 4; // English - Fixed
    private const COUNTRY_FILTER_ID = 119; // Fixed Country
    private const TYPE_ID = 1; // Automobile
    private const CACHE_DURATION = 7200; // 2 hours

    public function getApiKey()
    {
        // return env('RAPID_API_KEY');
        return config('services.rapidapi.key');
    }

    private function getHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'x-rapidapi-host' => self::API_HOST,
            'x-rapidapi-key' => $this->getApiKey(),
        ];
    }

    /**
     * Get all vehicle manufacturers/brands
     */
    public function getManufacturers()
    {
        $cacheKey = "vehicle_manufacturers_" . self::COUNTRY_FILTER_ID;
        
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () {
            try {
                $url = 'https://' . self::API_HOST . '/manufacturers/list/type-id/' . self::TYPE_ID;

                $response = Http::withHeaders($this->getHeaders())->get($url);

                if ($response->successful()) {
                    $data = $response->json();
                    \Log::info('Manufacturers API Response:', ['count' => count($data['manufacturers'] ?? [])]);
                    // Response has 'manufacturers' key, not 'data'
                    return $data['manufacturers'] ?? $data['data'] ?? [];
                }
                \Log::error('Manufacturers API Failed:', ['status' => $response->status(), 'body' => $response->body()]);
                return [];
            } catch (\Exception $e) {
                \Log::error('RapidAPI Manufacturers Error: ' . $e->getMessage());
                return [];
            }
        });
    }

    /**
     * Get models for a specific manufacturer
     */
    public function getModels($manufacturerId)
    {
        $cacheKey = "vehicle_models_" . $manufacturerId . "_" . self::COUNTRY_FILTER_ID;
        
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($manufacturerId) {
            try {
                $allModels = [];
                $page = 1;
                $totalPages = 1;

                do {
                    $url = 'https://' . self::API_HOST . '/models/list/type-id/' . self::TYPE_ID 
                         . '/manufacturer-id/' . $manufacturerId 
                         . '/lang-id/' . self::LANG_ID 
                         . '/country-filter-id/' . self::COUNTRY_FILTER_ID
                         . '?page=' . $page;

                    $response = Http::withHeaders($this->getHeaders())->get($url);

                    if ($response->successful()) {
                        $data = $response->json();
                        $models = $data['models'] ?? $data['data'] ?? [];
                        $allModels = array_merge($allModels, $models);

                        $totalPages = $data['totalPages'] ?? 1;
                        $page++;
                    } else {
                        \Log::error('Models API Failed:', ['status' => $response->status(), 'page' => $page, 'body' => $response->body()]);
                        break;
                    }
                } while ($page <= $totalPages);

                \Log::info('Models API Total Fetched:', ['manufacturer_id' => $manufacturerId, 'count' => count($allModels)]);
                return $allModels;
            } catch (\Exception $e) {
                \Log::error('RapidAPI Models Error: ' . $e->getMessage());
                return [];
            }
        });
    }

    /**
     * Get vehicle types/modifications for a specific model
     */
    public function getVehicleTypes($modelId)
    {
        $cacheKey = "vehicle_types_" . $modelId . "_" . self::COUNTRY_FILTER_ID;
        
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($modelId) {
            try {
                $allTypes = [];
                $page = 1;
                $totalPages = 1;

                do {
                    $url = 'https://' . self::API_HOST . '/types/type-id/' . self::TYPE_ID 
                         . '/list-vehicles-types/' . $modelId 
                         . '/lang-id/' . self::LANG_ID 
                         . '/country-filter-id/' . self::COUNTRY_FILTER_ID
                         . '?page=' . $page;

                    $response = Http::withHeaders($this->getHeaders())->get($url);

                    if ($response->successful()) {
                        $data = $response->json();
                        $types = $data['modelTypes'] ?? $data['data'] ?? [];
                        $allTypes = array_merge($allTypes, $types);

                        $totalPages = $data['totalPages'] ?? 1;
                        $page++;
                    } else {
                        \Log::error('Vehicle Types API Failed:', ['status' => $response->status(), 'page' => $page, 'body' => $response->body()]);
                        break;
                    }
                } while ($page <= $totalPages);

                \Log::info('Vehicle Types API Total Fetched:', ['model_id' => $modelId, 'count' => count($allTypes)]);
                return $allTypes;
            } catch (\Exception $e) {
                \Log::error('RapidAPI Vehicle Types Error: ' . $e->getMessage());
                return [];
            }
        });
    }

    /**
     * Get engine types for a specific model
     */
    public function getEngineTypes($manufacturerId, $modelSeriesId)
    {
        $cacheKey = "vehicle_engines_" . $manufacturerId . "_" . $modelSeriesId . "_" . self::COUNTRY_FILTER_ID;
        
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($manufacturerId, $modelSeriesId) {
            try {
                $allEngines = [];
                $page = 1;
                $totalPages = 1;

                do {
                    $url = 'https://' . self::API_HOST . '/vehicles/list/type-id/' . self::TYPE_ID 
                         . '/manufacturer-id/' . $manufacturerId 
                         . '/model-series-id/' . $modelSeriesId 
                         . '/lang-id/' . self::LANG_ID 
                         . '/country-filter-id/' . self::COUNTRY_FILTER_ID
                         . '?page=' . $page;

                    $response = Http::withHeaders($this->getHeaders())->get($url);

                    if ($response->successful()) {
                        $data = $response->json();
                        $engines = $data['vehicles'] ?? $data['data'] ?? [];
                        $allEngines = array_merge($allEngines, $engines);

                        $totalPages = $data['totalPages'] ?? 1;
                        $page++;
                    } else {
                        \Log::error('Engines API Failed:', ['status' => $response->status(), 'page' => $page, 'body' => $response->body()]);
                        break;
                    }
                } while ($page <= $totalPages);

                \Log::info('Engines API Total Fetched:', ['model_id' => $modelSeriesId, 'count' => count($allEngines)]);
                return $allEngines;
            } catch (\Exception $e) {
                \Log::error('RapidAPI Engine Types Error: ' . $e->getMessage());
                return [];
            }
        });
    }

    /**
     * Get vehicle detailed information
     */
    public function getVehicleDetails($vehicleId)
    {
        $cacheKey = "vehicle_details_" . $vehicleId;
        
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($vehicleId) {
            try {
                $url = 'https://' . self::API_HOST . '/vehicles/find-by-id/' . $vehicleId 
                     . '/lang-id/' . self::LANG_ID 
                     . '/country-filter-id/' . self::COUNTRY_FILTER_ID;

                $response = Http::withHeaders($this->getHeaders())->get($url);

                if ($response->successful()) {
                    $data = $response->json();
                    \Log::info('Vehicle Details API Response:', ['vehicle_id' => $vehicleId, 'data' => $data]);
                    return $data['data'] ?? $data ?? null;
                }
                \Log::error('Vehicle Details API Failed:', ['status' => $response->status(), 'body' => $response->body()]);
                return null;
            } catch (\Exception $e) {
                \Log::error('RapidAPI Vehicle Details Error: ' . $e->getMessage());
                return null;
            }
        });
    }

    /**
     * Get formatted brands list for frontend
     */
    public function getBrandsList()
    {
        $manufacturers = $this->getManufacturers();
        
        if (empty($manufacturers)) {
            \Log::warning('No manufacturers returned from API');
            return collect([]);
        }
        
        return collect($manufacturers)->map(function ($manufacturer) {
            // API returns manufacturerId and manufacturerName
            $id = $manufacturer['manufacturerId'] 
                ?? $manufacturer['manufacturer_id'] 
                ?? $manufacturer['id'] 
                ?? null;
            $name = $manufacturer['manufacturerName'] 
                 ?? $manufacturer['manufacturer_name'] 
                 ?? $manufacturer['name'] 
                 ?? null;
            
            return [
                'id' => $id,
                'name' => $name,
            ];
        })->filter(function($item) {
            $valid = $item['id'] && $item['name'];
            if (!$valid) {
                \Log::warning('Filtered out invalid brand:', $item);
            }
            return $valid;
        })->values();
    }

    /**
     * Get formatted models list for a brand
     */
    public function getModelsList($brandId)
    {
        $models = $this->getModels($brandId);
        
        if (empty($models)) {
            \Log::warning('No models returned for brand: ' . $brandId);
            return collect([]);
        }
        
        return collect($models)->map(function ($model) {
            return [
                'id' => $model['modelId'] 
                     ?? $model['model_series_id'] 
                     ?? $model['id'] 
                     ?? null,
                'name' => $model['modelName'] 
                       ?? $model['model_series_name'] 
                       ?? $model['name'] 
                       ?? null,
                'modelYearFrom' => $model['modelYearFrom'] 
                                ?? $model['model_year_from'] 
                                ?? null,
                'modelYearTo' => $model['modelYearTo'] 
                             ?? $model['model_year_to'] 
                             ?? null,
            ];
        })->filter(function($item) {
            $valid = $item['id'] && $item['name'];
            if (!$valid) {
                \Log::warning('Filtered out invalid model:', $item);
            }
            return $valid;
        })->values();
    }

    /**
     * Get formatted vehicle types/modifications for a model
     */
    public function getVehicleTypesList($modelId)
    {
        $vehicleTypes = $this->getVehicleTypes($modelId);
        
        if (empty($vehicleTypes)) {
            \Log::warning('No vehicle types returned for model: ' . $modelId);
            return collect([]);
        }
        
        return collect($vehicleTypes)->map(function ($type) {
            $yearFrom = $yearTo = null;
            
            // Extract years from construction intervals
            if (isset($type['constructionIntervalStart'])) {
                $yearFrom = (int)substr($type['constructionIntervalStart'], 0, 4);
            }
            if (isset($type['constructionIntervalEnd'])) {
                $yearTo = (int)substr($type['constructionIntervalEnd'], 0, 4);
            }
            
            return [
                'id' => $type['vehicleId'] ?? null,
                'name' => $type['typeEngineName'] ?? null,
                'fuelType' => $type['fuelType'] ?? null,
                'capacityLt' => $type['capacityLt'] ?? null,
                'engineCodes' => $type['engineCodes'] ?? null,
                'yearFrom' => $yearFrom,
                'yearTo' => $yearTo,
                'constructionIntervalStart' => $type['constructionIntervalStart'] ?? null,
                'constructionIntervalEnd' => $type['constructionIntervalEnd'] ?? null,
            ];
        })->filter(function($item) {
            $valid = $item['id'] && $item['name'];
            if (!$valid) {
                \Log::warning('Filtered out invalid vehicle type:', $item);
            }
            return $valid;
        })->values();
    }

    /**
     * Get formatted engine/variant list for a model
     */
    public function getEngineList($brandId, $modelId)
    {
        $engines = $this->getEngineTypes($brandId, $modelId);
        
        if (empty($engines)) {
            \Log::warning('No engines returned for model: ' . $modelId);
            return collect([]);
        }
        
        return collect($engines)->map(function ($engine) {
            return [
                'id' => $engine['vehicleId'] 
                     ?? $engine['vehicle_id'] 
                     ?? $engine['id'] 
                     ?? null,
                'name' => $engine['vehicleName'] 
                       ?? $engine['vehicle_name'] 
                       ?? $engine['name'] 
                       ?? null,
                'year' => $engine['year'] ?? null,
                'engine_size' => $engine['engineSize'] ?? $engine['engine_size'] ?? null,
                'power' => $engine['power'] ?? null,
            ];
        })->filter(function($item) {
            $valid = $item['id'] && $item['name'];
            if (!$valid) {
                \Log::warning('Filtered out invalid engine:', $item);
            }
            return $valid;
        })->values();
    }
}
