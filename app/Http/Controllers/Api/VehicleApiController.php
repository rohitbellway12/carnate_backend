<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RapidApiVehicleService;
use Illuminate\Http\Request;

class VehicleApiController extends Controller
{
    protected $vehicleService;

    public function __construct(RapidApiVehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Get all vehicle brands
     */
    public function getBrands()
    {
        try {
            $brands = $this->vehicleService->getBrandsList();
            
            return response()->json([
                'success' => true,
                'data' => $brands
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get models for a specific brand
     */
    public function getModels(Request $request)
    {
        try {
            $request->validate([
                'brand_id' => 'required|integer'
            ]);

            $models = $this->vehicleService->getModelsList($request->brand_id);
            
            return response()->json([
                'success' => true,
                'data' => $models
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get engine/variants for a specific model
     */
    public function getEngines(Request $request)
    {
        try {
            $request->validate([
                'brand_id' => 'required|integer',
                'model_id' => 'required|integer'
            ]);

            $engines = $this->vehicleService->getEngineList($request->brand_id, $request->model_id);
            
            return response()->json([
                'success' => true,
                'data' => $engines
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get vehicle details
     */
    public function getVehicleDetails(Request $request)
    {
        try {
            $request->validate([
                'vehicle_id' => 'required|integer'
            ]);

            $details = $this->vehicleService->getVehicleDetails($request->vehicle_id);
            
            return response()->json([
                'success' => true,
                'data' => $details
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
