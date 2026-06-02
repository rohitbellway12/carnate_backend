<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Api\BaseController;
use App\Models\Category;
use App\Models\Maker;
use App\Models\MakerType;
use App\Models\Mmodel;
use App\Models\ModelYear;
use App\Models\Modification;
use App\Models\Order;
use App\Models\SparePart;
use App\Models\SparePartVehicleModification;
use App\Models\Vehiclebrand;
use App\Models\VehicleSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonController extends BaseController
{

    public function getCategory(Request $request){
        $data = Category::with('Image')->orderBy('id', 'DESC')->get()->map(function ($category) {
            if ($category->Image) {
                $category->image_url = asset($category->Image->file);
            } else {
                $category->image_url = null;
            }
            return $category;
        });

    
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }


    public function getBrands(Request $request)
    {
        $data = MakerType::where('status', 1)->get();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    public function spareFilter(Request $request)
    {
        $serach = $request->search;
        $data = SparePart::orwhere('hsn_code', 'like', '%' . $serach . '%')
            ->orWhereHas('label', fn($query) => $query->where('title', 'like', '%' . $serach . '%'))
            ->orWhereHas('categorey', fn($query) => $query->where('title', 'like', '%' . $serach . '%'))
            ->get();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    // public function searchByCar(Request $request)
    // {
    //     $search = $request->search;

    //     $data = VehicleSearch::query()
    //         ->when($search, function ($query) use ($search) {
    //             $query->where('title', 'like', '%' . $search . '%')
    //                 ->orWhereHas('makerType', function ($q) use ($search) {
    //                     $q->where('title', 'like', '%' . $search . '%');
    //                 })
    //                 ->orWhereHas('maker', function ($q) use ($search) {
    //                     $q->where('title', 'like', '%' . $search . '%');
    //                 })
    //                 ->orWhereHas('model', function ($q) use ($search) {
    //                     $q->where('title', 'like', '%' . $search . '%');
    //                 })
    //                 ->orWhereHas('modelYear', function ($q) use ($search) {
    //                     $q->where('title', 'like', '%' . $search . '%');
    //                 });
    //         })
    //         ->when($request->maker_type_id, function ($query) use ($request) {
    //             $query->where('maker_type_id', $request->maker_type_id);
    //         })
    //         ->when($request->maker_id, function ($query) use ($request) {
    //             $query->where('maker_id', $request->maker_id);
    //         })
    //          ->when($request->model_id, callback: function ($query) use ($request) {
    //             $query->where('model_id', $request->model_id);
    //         })
    //         ->when($request->model_year_id, function ($query) use ($request) {
    //             $query->where('model_year_id', $request->model_year_id);
    //         })
    //         ->get();

    //     return response()->json([
    //         "status" => true,
    //         "message" => "Data Found successfully",
    //         "data" => $data
    //     ], 200);
    // }
    
     public function searchByCar(Request $request)
    {
        $sparePartArray = [];
        $modification = SparePartVehicleModification::where('vehicle_modification_id',$request->modification_id)->get();

        foreach($modification as $modificationData){
         $sparePartArray[] = $modificationData->spare_part_id;
        }
        $data = SparePart::whereIn('id',$sparePartArray)->with('Image','Label')->get(); 

        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }


    public function makerType(Request $request)
    {
        $data = MakerType::all();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    public function modelMaker(Request $request)
    {
        $data = Maker::where('maker_type_id', $request->maker_type_id)->get();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }


    public function getModel(Request $request)
    {
        $data = Mmodel::where('maker_id',$request->maker_id)->get();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }
    
    public function getYear(Request $request)
    {
        $data = ModelYear::where('model_id', $request->maker_id)->get();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    public function getModification(Request $request)
    {
        $data = Modification::where('model_year_id', $request->model_year_id)->get();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    public function getByCategorey(Request $request)
    {
        $data = SparePart::where('category_id', $request->category_id)->with('label')->get();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    // Order 
    public function getOrders(Request $request)
    {
        $user = Auth::guard('workshop_api')->user();
        $data = Order::where('user_id', $user->id)
            ->get();
        return response()->json([
            "status" => true,
            "message" => "Order Found successfully",
            "data" => $data
        ], 200);
    }

    public function getOrderDetail(Request $request)
    {
        $data = Order::with(['orderItem'])->whereId($request->order_id)
            ->first();
        return response()->json([
            "status" => true,
            "message" => "Order Found successfully",
            "data" => $data
        ], 200);
    }

    // My Cart 
    public function getCartOrder(Request $request)
    {
        $user = Auth::guard('workshop_api')->user();
        $data = Order::with(['orderItem'])->where('user_id', $user->id)
            ->where('is_cart', 1)
            ->get();
        $total_amount = Order::with(['orderItem'])->where('user_id', $user->id)
            ->where('is_cart', 1)
            ->sum('total_amount');
        return response()->json([
            "status" => true,
            "message" => "Cart Order Found successfully",
            "data" => $data,
            "total_amount" => $total_amount
        ], 200);
    }

    
}
