<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SparePart;
use App\Models\Modification;

class WorkshopVehicleSearchApiController extends Controller
{
    public function search(Request $request)
    {
        $query = SparePart::query()->with('label');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereHas('label', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                })->orWhere('part_number', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('brand_name') || $request->filled('variant_name') || $request->filled('selected_year')) {
            $query->whereHas('modifications.modification', function ($q) use ($request) {
                if ($request->filled('brand_name')) {
                    $q->where('brand_name', $request->brand_name);
                }
                if ($request->filled('variant_name')) {
                    $q->where('variant_name', $request->variant_name);
                }
                if ($request->filled('selected_year')) {
                    $q->where('year', $request->selected_year);
                }
            });
        }

        $perPage = $request->input('per_page', 20);
        $spareParts = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $spareParts->items(),
            'hasMore' => $spareParts->hasMorePages(),
            'total' => $spareParts->total(),
        ]);
    }

    // Get all brands for dropdown
    public function getBrands()
    {
        $brands = Modification::distinct()
            ->pluck('brand_name')
            ->filter()
            ->values();

        return response()->json([
            'success' => true,
            'brands' => $brands
        ]);
    }

    // Get variants for a specific brand
    public function getVariants(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string'
        ]);

        $variants = Modification::where('brand_name', $request->brand_name)
            ->distinct()
            ->pluck('variant_name')
            ->filter()
            ->values();

        return response()->json([
            'success' => true,
            'variants' => $variants
        ]);
    }

    // Get years for a specific brand and variant
    public function getYears(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string',
            'variant_name' => 'required|string'
        ]);

        $years = Modification::where('brand_name', $request->brand_name)
            ->where('variant_name', $request->variant_name)
            ->distinct()
            ->pluck('year')
            ->filter()
            ->values();

        return response()->json([
            'success' => true,
            'years' => $years
        ]);
    }

    // Get all dropdown data at once (brands, variants, years)
    public function getDropdownData(Request $request)
    {
        $brands = Modification::distinct()
            ->pluck('brand_name')
            ->filter()
            ->values();

        $variants = [];
        $years = [];

        // If brand is selected, get variants
        if ($request->filled('brand_name')) {
            $variants = Modification::where('brand_name', $request->brand_name)
                ->distinct()
                ->pluck('variant_name')
                ->filter()
                ->values();

            // If variant is also selected, get years
            if ($request->filled('variant_name')) {
                $years = Modification::where('brand_name', $request->brand_name)
                    ->where('variant_name', $request->variant_name)
                    ->distinct()
                    ->pluck('year')
                    ->filter()
                    ->values();
            }
        }

        return response()->json([
            'success' => true,
            
           'data' => [
                'brands' => $brands,
                'variants' => $variants,
                'years' => $years,
          ]
            
        ]);
    }
} 