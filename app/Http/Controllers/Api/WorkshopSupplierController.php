<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkshopSupplier;

class WorkshopSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(WorkshopSupplier::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mobile_no' => 'nullable|string',
            'business_first_name' => 'required|string',
            'business_address' => 'nullable|string',
            'gstin' => 'nullable|string',
            'owner_first_name' => 'required|string',
            'contact_1' => 'required|string',
            'contact_2' => 'nullable|string',
            'email' => 'nullable|email',
        ]);
        $supplier = WorkshopSupplier::create($validated);
        return response()->json($supplier, 201);
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = WorkshopSupplier::findOrFail($id);
        return response()->json($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $supplier = WorkshopSupplier::findOrFail($id);
        $validated = $request->validate([
            'mobile_no' => 'nullable|string',
            'business_first_name' => 'required|string',
            'business_address' => 'nullable|string',
            'gstin' => 'nullable|string',
            'owner_first_name' => 'required|string',
            'contact_1' => 'required|string',
            'contact_2' => 'nullable|string',
            'email' => 'nullable|email',
        ]);
        $supplier->update($validated);
        return response()->json($supplier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = WorkshopSupplier::findOrFail($id);
        $supplier->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
