<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Api\BaseController;
use App\Models\JobCard;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends BaseController
{
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

    // Job Card 
    public function getJobCardCount(Request $request)
    {
        $user = Auth::guard('workshop_api')->user();
        $open = JobCard::where('user_id', $user->id)
        ->where('soft_delete', 0)->where('status', 0)
        ->count();

        $complete = JobCard::where('user_id', $user->id)
        ->where('soft_delete', 0)->where('status', 2)
        ->count();

        $closed = JobCard::where('user_id', $user->id)
        ->where('soft_delete', 0)->where('status', 3)
        ->count();
        
        return response()->json([
            "status" => true,
            "message" => "Job Card Count Found successfully",
            "data" => [
                'completed' =>$complete,
                'open' =>$open,
                'closed' =>$closed,
            ],
        ], 200);
    }

    public function getJobCard(Request $request)
    {
        $user = Auth::guard('workshop_api')->user();
    
        $jobcardsQuery = JobCard::where('user_id', $user->id);

        $jobcardsQuery->when($request->type, function ($query) use ($request) {
            $query->where('soft_delete', 0)->where('status', $request->type);
        });
        
        $data = $jobcardsQuery->get();
    
        return response()->json([
            "status" => true,
            "message" => "Job Card Count Found successfully",
            "data" => $data,
        ], 200);
    }
    
    
}
