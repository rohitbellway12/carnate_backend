<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\JobCard;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Role;
use App\Models\Suppliers;
use App\Models\SparePartVehicleModification;
use App\Models\Modification;
use App\Models\WorkShopVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\CounterSale;
use App\Models\JobCardExtraCharge;
use App\Models\JobCardSparePart;
use App\Models\ProductStock;
use App\Models\Vehicle;
use Carbon\Carbon;


use App\Models\SparePartLabel;
use App\Models\Unit;
use App\Models\Category;
use App\Models\SparePart;
use App\Models\OrderItem;
use App\Models\CounterCustomers;
use App\Models\CounterSaleSparePart;

use App\Models\LabourCharge;
use Spatie\Permission\Models\Role as PermisionRole;
use Spatie\Permission\Models\Permission;

class AdminController extends BaseController
{
    // Order 
    public function getOrders(Request $request)
    {
        $data = Order::get();
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

    // Job Card 
    public function getJobCardCount(Request $request)
    {
        $user = Auth::guard('workshop_api')->user();

        $open = JobCard::where('status', 0)
            ->where('user_id', $user->is_user == 0 ? $user->id : $user->parent_id)
            ->where('soft_delete', 0)
            ->count();

        $complete = JobCard::where('status', 2)
            ->where('user_id', $user->is_user == 0 ? $user->id : $user->parent_id)
            ->where('soft_delete', 0)
            ->count();

        $closed = JobCard::where('status', 3)
            ->where('user_id', $user->is_user == 0 ? $user->id : $user->parent_id)
            ->where('soft_delete', 0)
            ->count();

        $confirmed = JobCard::where('status', 1)
            ->where('user_id', $user->is_user == 0 ? $user->id : $user->parent_id)
            ->where('soft_delete', 0)
            ->count();

        $deleted = JobCard::where('user_id', $user->is_user == 0 ? $user->id : $user->parent_id)
            ->where('soft_delete', 1)
            ->count();

        $total = JobCard::where('user_id', $user->is_user == 0 ? $user->id : $user->parent_id)
            ->count();

        return response()->json([
            "status" => true,
            "message" => "Job Card Count Found successfully",
            "data" => [
                'completed' => $complete,
                'open' => $open,
                'confirmed' => $confirmed,
                'deleted' => $deleted,
                'closed' => $closed,
                'total' => $total,
            ],
        ], 200);
    }

    public function getJobCard(Request $request)
    {

        $user = Auth::guard('workshop_api')->user();
        $jobcardsQuery = JobCard::query();

        $jobcardsQuery->when($request->type !== null, function ($query) use ($request) {
            $query->where('soft_delete', 0)->where('status', $request->type);
        });


        $jobcardsQuery->where('user_id', $user->is_user == 0 ? $user->id : $user->parent_id);

        $data = $jobcardsQuery->orderBy('created_at', 'desc')->get();

        return response()->json([
            "status" => true,
            "message" => "Job Card Count Found successfully",
            "data" => $data,
        ], 200);
    }
    
//   old
    // public function staffList(Request $request)
    // {
    //     $staffQuery = WorkShopVendor::query();

    //     $staffQuery->when($request->search, function ($query) use ($request) {
    //         $query->orwhere('name', $request->search);
    //         $query->orwhere('lastname', $request->search);
    //         $query->orwhere('salary', $request->search);
    //         $query->orwhere('email', $request->search);
    //     });
        
       
        
    //     $data = $staffQuery->get();

    //     return response()->json([
    //         "status" => true,
    //         "message" => "Staff Found successfully",
    //         "data" => $data,
    //     ], 200);
    // }
    
    //new 11-06-25
    // public function staffList(Request $request)
    // {
       
    //     $staffQuery = WorkShopVendor::query();

    //     $staffQuery->when($request->search, function ($query) use ($request) {
    //         $query->where(function ($query) use ($request) {
    //             $query->orwhere('name', 'like', '%' . $request->search . '%');
    //             $query->orwhere('lastname', 'like', '%' . $request->search . '%');
    //             $query->orwhere('salary', 'like', '%' . $request->search . '%');
    //             $query->orwhere('email', 'like', '%' . $request->search . '%');
    //         });
    //     });

    //     $staffQuery->when($request->user_type, function ($query) use ($request) {
    //         $query->where('user_type', $request->user_type);
    //     });
    //     $data = $staffQuery->get();
        
    //     return response()->json([
    //         "status" => true,
    //         "message" => "Staff Found successfully",
    //         "data" => $data,
    //     ], 200);
    // }
    
     public function staffList(Request $request)
{
    $staffQuery = WorkShopVendor::query();

    // 👇 Filter by parent_id
    if (!empty($request->id)) {
        $staffQuery->where('parent_id', $request->id);
    }

    // 👇 Search condition
    $staffQuery->when($request->search, function ($query) use ($request) {
        $query->where(function ($query) use ($request) {
            $query->orWhere('name', 'like', '%' . $request->search . '%');
            $query->orWhere('lastname', 'like', '%' . $request->search . '%');
            $query->orWhere('salary', 'like', '%' . $request->search . '%');
            $query->orWhere('email', 'like', '%' . $request->search . '%');
        });
    });

    // 👇 user_type condition
    if ($request->user_type != 'all') {
        $staffQuery->where('user_type', $request->user_type);
    }

    $data = $staffQuery->get();

    return response()->json([
        "status" => true,
        "message" => "Staff Found successfully",
        "data" => $data,
    ], 200);
}

    // public function Expense(Request $request)
    // {
    //     $data = Expense::get();
    //     $total_expense = Expense::sum('total_amount');
    //     $pending_expense = DB::table('expenses')
    //         ->selectRaw('SUM(total_amount - paid_amount) as pending_expense')
    //         ->value('pending_expense');

    //     return response()->json([
    //         "status" => true,
    //         "message" => "Staff Found successfully",
    //         "data" => $data,
    //         "total_expense" => $total_expense,
    //         "pending_expense" => $pending_expense,
    //     ], 200);
    // }
    
    
    
    //16/06/25
public function Expense(Request $request)
{
    $query = Expense::query();

    // Sirf bill_number se search
    if ($request->search) {
        $query->where('bill_number', 'like', '%' . $request->search . '%');
    }

    $data = $query->get();

    $total_expense = $query->sum('total_amount');
    $pending_expense = $query->selectRaw('SUM(total_amount - paid_amount) as pending_expense')->value('pending_expense');

    return response()->json([
        "status" => true,
        "message" => "Expenses fetched successfully",
        "data" => $data,
        "total_expense" => $total_expense,
        "pending_expense" => $pending_expense,
    ], 200);
}

    
    
    //14/06/25
    public function deleteExpense(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:expenses,id',
    ]);

    $expense = Expense::find($request->id);

    if ($expense) {
        $expense->delete();

        return response()->json([
            "status" => true,
            "message" => "Expense deleted successfully"
        ], 200);
    }

    return response()->json([
        "status" => false,
        "message" => "Expense not found"
    ], 404);
}

    
    
    

    public function Revenue(Request $request)
    {
        $data = Payment::where('status', 'success');
        if ($request->type == 1) {
            $data->where('created_at', '>=', now()->startOfWeek());
        } elseif ($request->type == 2) {
            $data->where('created_at', '>=', now()->startOfMonth());
        } elseif ($request->type == 3) {
            $data->where('created_at', '>=', now()->subMonths(6));
        }
        $data = $data->get();
        return response()->json([
            "status" => true,
            "message" => "Revenue Found successfully",
            "data" => $data,
        ], 200);
    }

    public function createExpense(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'invoice_number' => 'required',
            'expense_date' => 'required',
            'total_amount' => 'required',
            'balance_amount' => 'required',
            'paid_amount' => 'required',
        ]);
        $user = Auth::guard('workshop_api')->user();

        Expense::create([
            'category_id' => $request->category_id,
              'supplier_id'     => $request->supplier_id ?: null,
            'date' => $request->expense_date,
            'total_amount' => $request->total_amount,
            'paid_amount' => $request->paid_amount,
            'balance_amount' => $request->balance_amount,
            'description' => $request->description,
            'parent_id' => $user->id,
            'bill_number' => $request->invoice_number,
        ]);

        return response()->json([
            "status" => true,
            "message" => "Expense Created successfully",
        ], 200);
    }
    
    
    public function updateExpense(Request $request)
{
    $validated = $request->validate([
        'id' => 'required|exists:expenses,id',
        'category_id' => 'required',
        'invoice_number' => 'required',
        'expense_date' => 'required|date',
        'total_amount' => 'required|numeric',
        'balance_amount' => 'required|numeric',
        'paid_amount' => 'required|numeric',
        'description' => 'nullable|string',
        'supplier_id' => 'nullable|integer',
    ]);

    $user = Auth::guard('workshop_api')->user();

    $expense = Expense::find($request->id);

    $expense->update([
        'category_id' => $request->category_id,
        'supplier_id' => $request->supplier_id ?: null,
        'date' => $request->expense_date,
        'total_amount' => $request->total_amount,
        'paid_amount' => $request->paid_amount,
        'balance_amount' => $request->balance_amount,
        'description' => $request->description,
        'parent_id' => $user->id, // Optional: only update if needed
        'bill_number' => $request->invoice_number,
    ]);

    return response()->json([
        "status" => true,
        "message" => "Expense updated successfully",
        "data" => $expense
    ], 200);
}


    public function staffTypes(Request $request)
    {
        $data = Role::whereNot('name', 'WorkshopVendor')->where('guard_name', 'web')->get();

        return response()->json([
            "status" => true,
            "message" => "Staff Type Found successfully",
            "data" => $data,
        ], 200);
    }

    // public function createStaff(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required',
    //         'lastname' => 'required',
    //         'role' => 'required',
    //         'mobile_no' => 'required',
    //         'email' => 'required',
    //         'address' => 'required',
    //         'joining_date' => 'required',
    //         'salary' => 'required|numeric',
    //         'incentives' => 'required|numeric',
    //     ]);
    //     $user = Auth::guard('workshop_api')->user();

    //     $staff = WorkShopVendor::create([
    //         'name' => $request->name,
    //         'lastname' => $request->lastname,
    //         'mobile_no' => $request->mobile_no,
    //         'email' => $request->email,
    //         'address' => $request->address,
    //         'user_type' => $request->role,
    //         'salary' => $request->salary,
    //         'incentives' => $request->incentives,
    //         'joining_date' => $request->joining_date,
    //         'parent_id' => $user->id,
    //     ]);

    //     $roles = Role::where('id', $request->role)->first();
    //     $staff = WorkShopVendor::find($staff->id);
    //     $staff->assignRole($roles->name);


    //     return response()->json([
    //         "status" => true,
    //         "message" => "Staff added successfully",
    //     ], 200);
    // }
    
    
   public function createStaff(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'lastname' => 'required',
        'role' => 'required',
        'mobile_no' => 'required',
       'email' => 'nullable|email',
        'address' => 'required',
        'joining_date' => 'required',
        'salary' => 'required|numeric',
        'incentives' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    $user = Auth::guard('workshop_api')->user();

    // $imagePath = null;
    // if ($request->hasFile('image')) {
    //     $imagePath = $request->file('image')->store('uploads', 'public');
    // }
    
    $imagePath = null;
if ($request->hasFile('image') && $request->file('image')->isValid()) {
    $image = $request->file('image');
    $filename = time() . '_' . $image->getClientOriginalName();
    $destinationPath = public_path('driver');

    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0775, true);
    }

    $image->move($destinationPath, $filename);
    $imagePath = 'driver/' . $filename; // Save relative path to DB
}

    $staff = WorkShopVendor::create([
        'name' => $request->name,
        'lastname' => $request->lastname,
        'mobile_no' => $request->mobile_no,
        'email' => $request->email ?? null,
        'image' => $imagePath,
        'address' => $request->address,
        'user_type' => $request->role,
        'salary' => $request->salary,
        'incentives' => $request->incentives,
        'joining_date' => $request->joining_date,
        'parent_id' => $user->id,
    ]);

    $roles = Role::where('id', $request->role)->first();
    $staff = WorkShopVendor::find($staff->id);
    $staff->assignRole($roles->name);

    return response()->json([
        "status" => true,
        "message" => "Staff added successfully",
    ], 200);
}



//new store user 10-06-25
 public function staffAddUser(Request $request)
    {
        $validated = $request->validate([
            'userId' => 'required|exists:work_shop_vendor,id', // Ensure userId exists in the table
            'email' => 'required|email|unique:work_shop_vendor,email,' . $request->userId, // Email should be unique, except for the current user
            'password' => 'required|min:6',
        ]);

        $staff = WorkShopVendor::where('id', $request->userId)->first();

        if (!$staff) {
            return response()->json([
                "status" => false,
                "message" => "Staff not found.",
            ], 404);
        }

        $staff->email = $request->email;
        $staff->password = bcrypt($request->password);
        $staff->is_user = 1;
        $staff->save();

        return response()->json([
            "status" => true,
            "message" => "User created/updated successfully!",
        ], 200);
    }


    public function getExpenseCat(Request $request)
    {
        $data = ExpenseCategory::all();

        return response()->json([
            "status" => true,
            "message" => "Expense category successfully",
            "data" => $data,
        ], 200);
    }



    // NEW 13-03-35 
    public function todayServiceDue(Request $request)
    {
        $user = Auth::guard('workshop_api')->user();
        $today = Carbon::today();

        $data = JobCard::where('user_id', $user->id)
            ->where('soft_delete', 0)
            ->whereDate('created_at', $today)
            ->get();

        return response()->json([
            "status" => true,
            "message" => "Job Card Found successfully",
            "data" => $data
        ], 200);
    }
    public function vechileAnalytics(Request $request)
    {
        $vehicle_ids = JobCard::pluck('vehicle_id')->filter()->unique();

        $vehicleAnalytics = [];

        foreach ($vehicle_ids as $vehicle_id) {
            $vehicle = Vehicle::with('brand')->find($vehicle_id);

            $vehicleCount = JobCard::where('vehicle_id', $vehicle_id)->count();

            if ($vehicle && $vehicle->brand) {
                $brandName = $vehicle->brand->vehicle_brand;

                if (isset($vehicleAnalytics[$brandName])) {
                    $vehicleAnalytics[$brandName]['count'] += $vehicleCount;
                } else {
                    $vehicleAnalytics[$brandName] = [
                        'brand_name' => $brandName,
                        'count' => $vehicleCount
                    ];
                }
            }
        }
        return response()->json([
            "status" => true,
            "message" => "Job Cards found successfully",
            "data" => array_values($vehicleAnalytics)
        ], 200);
    }
    // GENREAL 
    // public function getMechanics(Request $request)
    // {
    //     $data = WorkShopVendor::where('type', 1)->get();
    //     return response()->json([
    //         "status" => 200,
    //         "message" => "Job Card Found successfully",
    //         "data" => $data
    //     ], 200);
    // }
    
    
    // changed status to true
    public function getMechanics(Request $request)
    {
        $data = WorkShopVendor::where('type', 1)->get();
        return response()->json([
            "status" => true,
            "message" => "Job Card Found successfully",
            "data" => $data
        ], 200);
    }
    public function getMechanicJobCard(Request $request)
    {
        $credentials = $request->validate([
            'mechanic_id' => 'required',
        ]);
        $data = JobCardExtraCharge::where('machanic_id', $request->mechanic_id)
            ->pluck('jobcard_id')
            ->unique();

        $jobCards = JobCard::whereIn('id', $data)->get();
        return response()->json([
            "status" => 200,
            "message" => "Job Card Found successfully",
            "data" => $jobCards,
        ], 200);
    }
    // Purchase order
    public function purchaseOrder(Request $request)
    {
        $id = Auth::guard('workshop_api')->user();
        $user = WorkShopVendor::find($id->id);
        $data = Order::where('user_id', $user->is_user == 0 ? $id->id : $user->parent_id)
            ->where('payment_status', 1)->get();

        return response()->json([
            "status" => 200,
            "message" => "Order Found successfully",
            "data" => $data,
        ], 200);
    }
    // Add Stock 
//         public function addStock(Request $request)
//         {
//             $validated = $request->validate([
//                 'name' => 'required',
//                 'category_id' => 'required',
//                 'purchase_amount' => 'required',
//                 'amount' => 'required',
//                 'stock' => 'required',
//                 'brand' => 'required',
//                 'unit' => 'required',
//                 'tax_type' => 'nullable',
//                 'tax_percentage' => 'nullable',
//                 'hsn_code' => 'nullable',
//                 'part_number' => 'required',
//                 'category' => 'required',
//                 'suitable_for' => 'required_if:forAllVehicles,false|array',
//             ]);
    
//             $user = Auth::guard('workshop_api')->user();
//             try {
//                 $productStock = ProductStock::where([
//                     'user_id' => $user->id,
//                     'label_id' => $validated['name'],
//                     'price' => $validated['amount'],
//                     'category_id' => $validated['category_id'],
//                     'brand' => $validated['brand'],
//                     'unit_id' => $validated['unit'],
//                 ])->first();
    
//                 if ($productStock) {
//                     $productStock->stock += $validated['stock'];
//                     $productStock->save();
//                 } else {
//                     $productStock = new ProductStock();
//                     $productStock->user_id = $user->id;
//                     $productStock->label_id = $validated['name'];
//                     $productStock->category_id = $validated['category_id'];
//                     $productStock->categories_id = $validated['category'];
//                     $productStock->price = $validated['amount'];
//                     $productStock->stock = $validated['stock'];
//                     $productStock->brand = $validated['brand'];
//                     $productStock->buy_price = $validated['purchase_amount'];
                    
                    
                    
//                     $productStock->price = $this->amount;
//                      $productStock->sp_type =  $this->sp_type ;
//                      $productStock->forAllVehicles = $this->forAllVehicles ? 1 : 0;
                    
                    
//                     $productStock->tax_type = $validated['tax_type'] ?? '';
//                     $productStock->tax_percentage = $validated['tax_percentage'];
//                     $productStock->unit_id = $validated['unit'];
//                     $productStock->hsn_code = $validated['hsn_code'];
//                     $productStock->self_stock = 1;
//                     $productStock->part_number = $validated['part_number'];
//                     $productStock->save();
//                 }
    
                
//             //     if ($this->forAllVehicles) {
//             //     $suitableForData = Modification::where('status', 1)->pluck('id')->toArray();
//             // } else {
//             //     $suitableForData = $this->suitable_for;
//             // }
            
//             if ($request->forAllVehicles) {
//     $suitableForData = Modification::where('status', 1)->pluck('id')->toArray();
// } else {
//     $suitableForData = $request->suitable_for ?? [];
// }
            
//             //  if ($request->forAllVehicles) {
//             //       $suitableForData = Modification::where('status', 1)->pluck('id')->toArray();
//             //     } else {
//             //       $suitableForData = $request->suitable_for;
//             //  }
//   return response()->json(['debug' => $suitableForData]);
//             foreach ($suitableForData as $sutaiblefor) {
//                 SparePartVehicleModification::create([
//                     'spare_part_id' => $productStock->id,
//                     'vehicle_modification_id' => $sutaiblefor
//                 ]);
//             }
                
                
//                 return response()->json([
//                     'status' => true,
//                     'message' => 'Stock Updated Successfully',
//                     'data' => $productStock
//                 ], 200);
//             } catch (\Exception $e) {
//                 return response()->json([
//                     'status' => false,
//                     'message' => 'Failed to update stock. ' . $e->getMessage(),
//                 ], 500);
//             }
//         }
   
    public function addStock1(Request $request)
{
   
    $validated = $request->validate([
        'name' => 'required',
        'category_id' => 'required',
        'purchase_amount' => 'required',
        'amount' => 'required',
        'stock' => 'required',
        'brand' => 'required',
        'unit' => 'required',
        'tax_type' => 'nullable',
        'tax_percentage' => 'nullable',
        'hsn_code' => 'nullable',
        'part_number' => 'required',
        'category' => 'required',
        'sp_type' => 'nullable',
        'forAllVehicles' => 'required|boolean', 
        'suitable_for' => 'required_if:forAllVehicles,false|array',
    ]);
   
    $user = Auth::guard('workshop_api')->user();
    try {
        $productStock = ProductStock::where([
            'user_id' => $user->id,
            'label_id' => $validated['name'],
            'price' => $validated['amount'],
            'category_id' => $validated['category_id'],
            'brand' => $validated['brand'],
            'unit_id' => $validated['unit'],
        ])->first();

        if ($productStock) {
            $productStock->stock += $validated['stock'];
            $productStock->save();
        } else {
            $productStock = new ProductStock();
            $productStock->user_id = $user->id;
            $productStock->label_id = $validated['name'];
            $productStock->category_id = $validated['category_id'];
            $productStock->categories_id = $validated['category'];
            $productStock->price = $validated['amount'];
            $productStock->stock = $validated['stock'];
            $productStock->brand = $validated['brand'];
            $productStock->buy_price = $validated['purchase_amount'];
            $productStock->sp_type = $validated['sp_type'] ?? null;
            $productStock->forAllVehicles = $validated['forAllVehicles'] ? 1 : 0;
            $productStock->tax_type = $validated['tax_type'] ?? '';
            $productStock->tax_percentage = $validated['tax_percentage'] ?? null;
            $productStock->unit_id = $validated['unit'];
            $productStock->hsn_code = $validated['hsn_code'] ?? '';
            $productStock->self_stock = 1;
            $productStock->part_number = $validated['part_number'];
            $productStock->save();
        }
        

        // Yeh part ab sahi hai:
        if ($validated['forAllVehicles']) {
            $suitableForData = Modification::where('status', 1)->pluck('id')->toArray();
        } else {
            $suitableForData = $validated['suitable_for'] ?? [];
        }

        

       foreach ((array) $suitableForData as $sutaiblefor) {
    SparePartVehicleModification::create([
        'spare_part_id' => $productStock->id,
        'vehicle_modification_id' => $sutaiblefor
    ]);
}

        return response()->json([
            'status' => true,
            'message' => 'Stock Updated Successfully',
            'data' => $productStock
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to update stock. ' . $e->getMessage(),
        ], 500);
    }
}
    
    // add stock old
    // public function addStock(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required',
    //         'category_id' => 'required',
    //         'purchase_amount' => 'required',
    //         'amount' => 'required',
    //         'stock' => 'required',
    //         'brand' => 'required',
    //         'unit' => 'required',
    //         'tax_type' => 'nullable',
    //         'tax_percentage' => 'nullable',
    //         'hsn_code' => 'nullable',
    //         'part_number' => 'required',
    //         'category' => 'required'
    //     ]);

    //     $user = Auth::guard('workshop_api')->user();
    //     try {
    //         $productStock = ProductStock::where([
    //             'user_id' => $user->id,
    //             'label_id' => $validated['name'],
    //             'price' => $validated['amount'],
    //             'category_id' => $validated['category_id'],
    //             'brand' => $validated['brand'],
    //             'unit_id' => $validated['unit'],
    //         ])->first();

    //         if ($productStock) {
    //             $productStock->stock += $validated['stock'];
    //             $productStock->save();
    //         } else {
    //             $productStock = new ProductStock();
    //             $productStock->user_id = $user->id;
    //             $productStock->label_id = $validated['name'];
    //             $productStock->category_id = $validated['category_id'];
    //             $productStock->categories_id = $validated['category'];
    //             $productStock->price = $validated['amount'];
    //             $productStock->stock = $validated['stock'];
    //             $productStock->brand = $validated['brand'];
    //             $productStock->buy_price = $validated['purchase_amount'];
    //             $productStock->tax_type = $validated['tax_type'] ?? '';
    //             $productStock->tax_percentage = $validated['tax_percentage'];
    //             $productStock->unit_id = $validated['unit'];
    //             $productStock->hsn_code = $validated['hsn_code'];
    //             $productStock->self_stock = 1;
    //             $productStock->part_number = $validated['part_number'];
    //             $productStock->save();
    //         }

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Stock Updated Successfully',
    //             'data' => $productStock
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Failed to update stock. ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }
    // Counter Sales 
    public function getCounterSales(Request $request)
    {
        $user = Auth::guard('workshop_api')->user();
        $data = CounterSale::with('Customer')->where('type', 1)
            ->where('workshop_id', $user->id)
            ->orderBy('created_at', 'desc')->get();
        return response()->json([
            "status" => true,
            "message" => "Counter Salse Found successfully",
            "data" => $data,
        ], 200);
    }
    public function viewCounterSales(Request $request)
    {
        $data = CounterSale::with('Customer')
            ->where('id', $request->id)
            ->get();
        return response()->json([
            "status" => 200,
            "message" => "Counter Salse Found successfully",
            "data" => $data,
        ], 200);
    }
    // Analytics
    public function viewSalse(Request $request)
    {
        $spareCount = 0;
        $lubeCount = 0;
        $data = JobCardSparePart::with('labels')->get();
        foreach ($data as $jobCard) {
            if ($jobCard->labels && isset($jobCard->labels)) {
                if (isset($jobCard->labels->spare_part_type)) {
                    if ($jobCard->labels->spare_part_type == 1) {
                        $spareCount += $jobCard->final_amount;
                    } else if ($jobCard->labels->spare_part_type == 2) {
                        $lubeCount += $jobCard->final_amount;
                    }
                }
            }
        }
        return response()->json([
            "status" => 200,
            "message" => "Sales Found successfully",
            "spareCount" => $spareCount,
            "lubeCount" => $lubeCount,
        ], 200);
    }
    // Reports 
    public function stockJobReport(Request $request)
    {

        $validated = $request->validate([
            'time_range' => 'required',
        ]);
        $user = Auth::guard('workshop_api')->user();
        $query = ProductStock::where('user_id', $user->is_user == 0 ? $user->id : $user->parent_id);

        $timeRange = $request->get('time_range', 1);

        switch ($timeRange) {
            case 1: // This Week
                $startOfWeek = now()->startOfWeek();
                $endOfWeek = now()->endOfWeek();
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                break;

            case 2: // Current Month
                $startOfMonth = now()->startOfMonth();
                $endOfMonth = now()->endOfMonth();
                $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
                break;

            case 3: // Last Month
                $startOfLastMonth = now()->subMonth()->startOfMonth();
                $endOfLastMonth = now()->subMonth()->endOfMonth();
                $query->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth]);
                break;

            case 4: // Last 3 Months
                $startOfLast3Months = now()->subMonths(3)->startOfMonth();
                $endOfLast3Months = now()->endOfMonth();
                $query->whereBetween('created_at', [$startOfLast3Months, $endOfLast3Months]);
                break;

            case 5: // Custom Date Range
                $startDate = $request->get('start_date');
                $endDate = $request->get('end_date');
                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                } else {
                    return response()->json([
                        "status" => 400,
                        "message" => "Please provide both start_date and end_date"
                    ], 400);
                }
                break;

            default:
                return response()->json([
                    "status" => 400,
                    "message" => "Invalid time range"
                ], 400);
        }

        $data = $query->orderBy('id', 'DESC')->get();

        return response()->json([
            "status" => 200,
            "message" => "Report Found successfully",
            "data" => $data
        ], 200);
    }
    public function counterSalse(Request $request)
    {
        $user = Auth::guard('workshop_api')->user();
        $data = CounterSale::with('Customer')
            ->where('type', 1)
            ->where('workshop_id', $user->id)
            ->orderBy('created_at', 'desc')->get();

        $data->each(function ($item) {
            $item->download_link = asset('workshop/countersale-invoice/' . $item->id . '/0');
            $item->view_link = asset('workshop/countersale-invoice/' . $item->id . '/1');
        });

        return response()->json([
            "status" => true,
            "message" => "Counter Salse Found successfully",
            "data" => $data
        ], 200);
    }

    // public function editStaff(Request $request)
    // {
    //     $validated = $request->validate([
    //         'staff_id' => 'required',
    //         'name' => 'required',
    //         'lastname' => 'required',
    //         'role' => 'required',
    //         'mobile_no' => 'required',
    //           'email' => 'nullable|email',
    //         'address' => 'required',
    //         'joining_date' => 'required',
    //         'salary' => 'required|numeric',
    //         'incentives' => 'required|numeric',
    //     ]);
    //     $staff = WorkShopVendor::find($request->staff_id);
    //     if (!$staff) {
    //         return response()->json([
    //             "status" => false,
    //             "message" => "Staff not found",
    //         ], 404);
    //     }
    //     $staff->update([
    //         'name' => $request->name,
    //         'lastname' => $request->lastname,
    //         'mobile_no' => $request->mobile_no,
    //         'email' => $request->email ?? null,
    //         'address' => $request->address,
    //         'user_type' => $request->role,
    //         'salary' => $request->salary,
    //         'incentives' => $request->incentives,
    //         'joining_date' => $request->joining_date,
    //     ]);
    //     $roles = Role::where('id', $request->role)->first();
    //     if ($roles) {
    //         $staff->syncRoles([$roles->name]);
    //     }
    //     return response()->json([
    //         "status" => true,
    //         "message" => "Staff updated successfully",
    //     ], 200);
    // }
    
    // image update editStaff
    public function editStaff(Request $request)
{
    $validated = $request->validate([
        'staff_id' => 'required',
        'name' => 'required',
        'lastname' => 'required',
        'role' => 'required',
        'mobile_no' => 'required',
        'email' => 'nullable',
        'address' => 'required',
        'joining_date' => 'required',
        'salary' => 'required|numeric',
        'incentives' => 'required|numeric',
    ]);

    $staff = WorkShopVendor::find($request->staff_id);
    if (!$staff) {
        return response()->json([
            "status" => false,
            "message" => "Staff not found",
        ], 404);
    }

    $imagePath = $staff->image; 
    if ($request->hasFile('image')) {
       
        $image = $request->file('image');
        $filename = time() . '_' . $image->getClientOriginalName();
        $destinationPath = public_path('driver');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0775, true);
        }

       
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        $image->move($destinationPath, $filename);
        $imagePath = 'driver/' . $filename; 
    }

    $staff->update([
        'name' => $request->name,
        'lastname' => $request->lastname,
        'mobile_no' => $request->mobile_no,
        'email' => $request->email ?? null,
        'address' => $request->address,
        'image' => $imagePath,
        'user_type' => $request->role,
        'salary' => $request->salary,
        'incentives' => $request->incentives,
        'joining_date' => $request->joining_date,
    ]);

    // Sync roles if a role ID is provided
    $roles = Role::where('id', $request->role)->first();
    if ($roles) {
        $staff->syncRoles([$roles->name]);
    }

    return response()->json([
        "status" => true,
        "message" => "Staff updated successfully",
    ], 200);
}


    public function deleteStaff(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:work_shop_vendor,id',
        ]);

        $staff = WorkShopVendor::where('id', $request->staff_id);

        if (!$staff) {
            return response()->json([
                "status" => false,
                "message" => "Staff not found",
            ], 404);
        }

        $staff->delete();

        return response()->json([
            "status" => true,
            "message" => "Staff deleted successfully",
        ], 200);
    }

    // New 20-03-25 
    public function getSapreNames(Request $request)
    {
        $data = SparePartLabel::select('id', 'title')->get();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    public function createSapreNames(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $request->name],
            ['title' => $request->name, 'spare_part_type' => $request->category_id]
        );

        return response()->json([
            "status" => true,
            "message" => "Data Add Successfully",
        ], 200);
    }

    public function getUnits(Request $request)
    {
        $data = Unit::all();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    public function getCategorey(Request $request)
    {
        $data = Category::all();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    // Add to Cart 

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'increase_stock' => 'required|integer|min:1',
            'spare_id' => 'required',
        ]);

        $user_id = Auth::guard('workshop_api')->user();
        $spareId = $request->spare_id;
        $user = WorkShopVendor::where('id', $user_id->id)->first();
        $sparePart = SparePart::where('id', $spareId)->first();

        if (!$sparePart) {
            return response()->json([
                'status' => false,
                'message' => 'Spare part not found.',
                'order' => []
            ], 200);
        }

        if ($request->increase_stock <= 0) {
            return response()->json([
                "status" => true,
                "message" => "Please Check the Stock Quantity!",
                "data" => []
            ], 404);
        } else if ($request->increase_stock > $sparePart->stock) {
            return response()->json([
                "status" => true,
                "message" => "Please Check the Stock Quantity!",
                "data" => []
            ], 404);
        }

        $isConfirmOrder = Order::where('is_confim', 0)->where('workshop_id', $user->id)->first();

        if (!empty($isConfirmOrder)) {
            $orderItem = OrderItem::where('spare_part_id', $sparePart->id)->where('order_id', $isConfirmOrder->id)->first();
            if (!empty($orderItem)) {
                $orderItem->quantity += $request->increase_stock;
                $orderItem->total_amount += $sparePart->price * $request->increase_stock;

                $orderItem->spare_total_price += (float) ($sparePart->amount) * $request->increase_stock;
                $orderItem->spare_tax_price += (($sparePart->amount * $request->increase_stock) * $sparePart->tax_percentage) / 100;

                $orderItem->save();

                $isConfirmOrder->total_item += $request->increase_stock;
                $isConfirmOrder->total_amount += $sparePart->price * $request->increase_stock;
                $isConfirmOrder->save();
            } else {
                $orderItem = new OrderItem();
                $orderItem->spare_part_id = $sparePart->id;
                $orderItem->user_id = $sparePart->user_id;
                $orderItem->quantity = $request->increase_stock;
                $orderItem->price = $sparePart->price;
                $orderItem->spare_price = $sparePart->amount;
                $orderItem->spare_total_price = $sparePart->amount * $request->increase_stock;
                $orderItem->spare_tax = $sparePart->tax_percentage ?? 0;
                $orderItem->spare_tax_type = $sparePart->tax_type ?? null;
                $orderItem->spare_tax_price = (($sparePart->amount * $request->increase_stock) * $sparePart->tax_percentage) / 100;
                $orderItem->total_amount = $sparePart->price * $request->increase_stock;
                $orderItem->category = $sparePart->spare_part_type;
                $orderItem->order_id = $isConfirmOrder->id;
                $orderItem->save();

                $isConfirmOrder->total_quantity += 1;
                $isConfirmOrder->total_item += $request->increase_stock;
                $isConfirmOrder->total_amount += $sparePart->price * $request->increase_stock;
                $isConfirmOrder->save();
            }
        } else {
            $order = new Order();
            $order->order_date = now();
            $order->total_amount = $sparePart->price;
            $order->total_quantity = 1;
            $order->total_item = $request->increase_stock;
            $order->workshop_id = $user->id;
            $order->payment_id = 1;
            $order->save();

            $orderItem = new OrderItem();
            $orderItem->spare_part_id = $sparePart->id;
            $orderItem->user_id = $sparePart->user_id;
            $orderItem->quantity = $request->increase_stock;
            $orderItem->price = $sparePart->price;
            $orderItem->spare_price = $sparePart->amount;
            $orderItem->spare_total_price = $sparePart->amount * $request->increase_stock;
            $orderItem->spare_tax = $sparePart->tax_percentage ?? 0;
            $orderItem->spare_tax_type = $sparePart->tax_type ?? null;
            $orderItem->spare_tax_price = (($sparePart->amount * $request->increase_stock) * $sparePart->tax_percentage) / 100;
            $orderItem->total_amount = $sparePart->price * $request->increase_stock;
            $orderItem->category = $sparePart->spare_part_type;
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }
        if (!empty($isConfirmOrder)) {
            $id = $isConfirmOrder->id;
        } else {
            $id = $order->id;
        }

        $order = Order::with('orderItem')->where('is_confim', 0)->where('workshop_id', $user->id)->where('id', $id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Order submitted successfully!',
            'order' => $order
        ], 200);
    }

    public function getCartData(Request $request)
    {
        $user_id = Auth::guard('workshop_api')->user();
        $user = WorkShopVendor::where('id', $user_id->id)->first();
        $order = Order::with('orderItem.SpareParts.Image')->where('is_confim', 0)->where('workshop_id', $user->id)->first();
        if (!$order) {
            return response()->json([
                "status" => false,
                "message" => "No cart data found",
                "data" => []
            ], 404);
        }
        return response()->json([
            "status" => true,
            "message" => "Cart Data Found successfully",
            "data" => $order
        ], 200);
    }

    public function DeleteCartItem(Request $request)
    {
        $user_id = Auth::guard('workshop_api')->user();
        $user = WorkShopVendor::where('id', $user_id->id)->first();
        $orderItem = OrderItem::with('order')->find($request->order_item_id);
        if (!$orderItem) {
            return response()->json([
                "status" => false,
                "message" => "Order item not found",
                "data" => []
            ], 404);
        }
        if ($orderItem->order->is_confim == 1) {
            return response()->json([
                "status" => false,
                "message" => "You can't delete this item",
                "data" => []
            ], 404);
        }
        $order = Order::with('orderItem')->where('id', $orderItem->order_id)->first();
        $order->total_quantity -= $orderItem->quantity;
        $order->total_amount -= $orderItem->price;
        $order->total_item -= 1;
        $order->save();
        OrderItem::destroy($request->order_item_id);
        return response()->json([
            "status" => true,
            "message" => "Item deleted successfully",
            "data" => []
        ], 200);


    }

    public function confirmOrder(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required',
        ]);
        $itemName = [];
        $order = Order::with('orderItem.SpareParts')->find($request->order_id);
        foreach ($order->orderItem as $item) {
            $spareId = $item->spare_part_id;
            $sparePart = SparePart::where('id', $spareId)->first();
            if ($sparePart) {
                if ($item->quantity > $sparePart->stock) {
                    $itemName[] = $item?->SpareParts?->name ?? '-';

                }

            }
        }
        if (!empty($itemName)) {
            $items = implode(',', $itemName);
            return response()->json([
                "status" => false,
                "message" => "Stock is not available of .'$items'.",
                "data" => []
            ], 400);
        }
        $order->is_confim = 1;
        $order->save();
        return response()->json([
            "status" => true,
            "message" => "Order confirm successfully!",
            "data" => []
        ], 200);
    }

    // Counter Salse 
    public function getCounterCustomers(Request $request)
    {
        $user_id = Auth::guard('workshop_api')->user();

        $data = CounterCustomers::where('user_id', $user_id->id)->get();

        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    public function storeCounterCustomer(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'mobile_no' => 'required|digits:10|unique:counter_customers,mobile_no',
            'address' => 'required',
            'email' => 'required|email|unique:counter_customers,email',
        ]);



        $user_id = Auth::guard('workshop_api')->user();

        // Create new customer
        $customer = CounterCustomers::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile_no' => $validatedData['mobile_no'],
            'address' => $validatedData['address'],
            'gst_number' => $validatedData['gst_no'] ?? null,
        ]);

        $customer->user_id = $user_id->id;
        $customer->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Counter Customer added successfully!',
            'customer' => $customer
        ], 201);
    }

    public function createCounterSale(Request $request)
    {

        $validated = $request->validate([
            'customer_name' => 'required',
            'payment_type' => 'required',
            'totalAmount' => 'required|numeric',
            'final_amount' => 'required|numeric',
            'balance_amount' => 'required|numeric',
            'note' => 'nullable|string',
            'countersale_number' => 'required|string',
            'items' => 'required|array',
        ]);

        $user = Auth::guard('workshop_api')->user();
        $items = $request->input('items');
        $status = $request->payment_type == 'total' ? 1 : 0;

        $counterSale = new CounterSale();
        $counterSale->customer_id = $request->customer_name;
        $counterSale->countersale_number = $request->countersale_number;
        $counterSale->date = date('Y-m-d');
        $counterSale->note = $request->note;
        $counterSale->total = $request->totalAmount;
        $counterSale->subtotal = $request->final_amount;
        $counterSale->partial_amount = $request->partial_amount;
        $counterSale->status = $status;
        $counterSale->payment_type = $request->payment_type;
        $counterSale->balance_amount = $request->balance_amount;
        $counterSale->type = 1;
        $counterSale->workshop_id = $user->id;
        $counterSale->save();

        $this->addSparePartsToCounterSale($counterSale->id, $items);

        return response()->json([
            "status" => true,
            "message" => "Counter Sale Added Successfully!",
            "data" => $counterSale
        ], 200);
    }

    private function addSparePartsToCounterSale($counterSaleId, $items)
    {
        CounterSaleSparePart::where('countersale_id', $counterSaleId)->delete();

        foreach ($items as $item) {
            $labelName = SparePartLabel::select('title')->find($item['id']);
            $labelTitle = $labelName['title'] ?? 'Unknown';

            $productStock = ProductStock::find($item['productId']);
            if ($productStock) {
                $productStock->stock -= $item['quantity'];
                $productStock->save();
            }

            $counterSaleSparePart = new CounterSaleSparePart();
            $counterSaleSparePart->countersale_id = $counterSaleId;
            $counterSaleSparePart->stock_label_id = $item['id'];
            $counterSaleSparePart->stock_label_name = $labelTitle;
            $counterSaleSparePart->quantity = $item['quantity'];
            $counterSaleSparePart->price = $item['unit_price'];
            $counterSaleSparePart->total_amount = $item['total_amount'];
            $counterSaleSparePart->discount = $item['discount'];
            $counterSaleSparePart->final_amount = $item['final_amount'];
            $counterSaleSparePart->discount_type = $item['discount_type'];
            $counterSaleSparePart->product_id = $item['productId'];
            $counterSaleSparePart->save();
        }
    }

    public function getSpareParts(Request $request)
    {
        $user_id = Auth::guard('workshop_api')->user();

        $data = ProductStock::where('user_id', $user_id->id)->get();

        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    // New 22-03-25
    public function genrateConterSalseNumber(Request $request)
    {
        $data = generateHashCounterSaleNumber(time());
        return response()->json([
            "status" => true,
            "message" => "Conter Salse Number Generated successfully!",
            "data" => $data
        ], 200);
    }
    // Counter Salse 
    public function counterSalseDetail(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $data = CounterSale::where('id', $request->id)->with('counterSalesSpareParts')->first();
        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    public function updateCounterSale(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'payment_type' => 'required',
            'totalAmount' => 'required|numeric',
            'final_amount' => 'required|numeric',
            'balance_amount' => 'required|numeric',
            'note' => 'nullable|string',
            'countersale_number' => 'required|string',
            'items' => 'required|array',
        ]);

        $user = Auth::guard('workshop_api')->user();
        $items = $request->input('items');
        $status = $request->payment_type == 'total' ? 1 : 0;
        $partial_amount = $request->payment_type == 'total' ? 0 : $request->partial_amount;

        $counterSale = CounterSale::findOrFail($request->counterSaleId);
        $counterSale->customer_id = $request->customer_name;
        $counterSale->countersale_number = $request->countersale_number;
        $counterSale->date = date('Y-m-d');
        $counterSale->note = $request->note;
        $counterSale->total = $request->totalAmount;
        $counterSale->subtotal = $request->final_amount;
        $counterSale->partial_amount = $partial_amount;
        $counterSale->status = $status;
        $counterSale->payment_type = $request->payment_type;
        $counterSale->balance_amount = $request->balance_amount;
        $counterSale->type = 1;
        $counterSale->workshop_id = $user->id;
        $counterSale->save();

        CounterSaleSparePart::where('countersale_id', $counterSale->id)->delete();

        foreach ($items as $item) {
            $labelName = SparePartLabel::select('title')->find($item['id']);
            $labelTitle = $labelName['title'] ?? 'Unknown';

            $productStock = ProductStock::find($item['productId']);
            if ($productStock) {
                if ((float) $item['quantity'] > (float) $item['previous_qty']) {
                    $remainingQty = (float) $item['quantity'] - (float) $item['previous_qty'];
                    $productStock->stock -= $remainingQty;
                } elseif ((float) $item['quantity'] < (float) $item['previous_qty']) {
                    $remainingQty = (float) $item['previous_qty'] - (float) $item['quantity'];
                    $productStock->stock += $remainingQty;
                }
                $productStock->save();
            }

            $counterSaleSparePart = new CounterSaleSparePart();
            $counterSaleSparePart->countersale_id = $counterSale->id;
            $counterSaleSparePart->stock_label_id = $item['id'];
            $counterSaleSparePart->stock_label_name = $labelTitle;
            $counterSaleSparePart->quantity = $item['quantity'];
            $counterSaleSparePart->price = $item['unit_price'];
            $counterSaleSparePart->total_amount = $item['total_amount'];
            $counterSaleSparePart->discount = $item['discount'];
            $counterSaleSparePart->final_amount = $item['final_amount'];
            $counterSaleSparePart->discount_type = $item['discount_type'];
            $counterSaleSparePart->product_id = $item['productId'];
            $counterSaleSparePart->save();
        }

        return response()->json([
            "status" => true,
            "message" => "Counter Sale Updated Successfully!",
            "data" => $counterSale
        ], 200);
    }

    public function deleteCounterSale(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);

        CounterSale::find($request->id)->delete();
        return response()->json([
            "status" => true,
            "message" => "CounterSale Deleted successfully",
        ], 200);
    }

    // New 24-03-35 

    // Update Stock
    public function updateStock(Request $request)
    {
        $validated = $request->validate([
            'stock_id' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'purchase_amount' => 'required|min:1',
            'amount' => 'required|min:1',
            'stock' => 'required|min:1',
            'brand' => 'nullable',
            'unit' => 'nullable',
            'tax_type' => 'nullable',
            'tax_percentage' => 'nullable',
            'hsn_code' => 'nullable',
            'part_number' => 'required',
            'category' => 'required'
        ]);

        try {
            $productStock = ProductStock::find($validated['stock_id']);

            if (!$productStock) {
                return response()->json([
                    'status' => false,
                    'message' => 'Stock not found',
                ], 404);
            }

            $productStock->label_id = $validated['name'];
            $productStock->category_id = $validated['category_id'];
            $productStock->categories_id = $validated['category'];
            $productStock->price = $validated['amount'];
            $productStock->stock = $validated['stock'];
            $productStock->brand = $validated['brand'] ?? $productStock->brand;
            $productStock->buy_price = $validated['purchase_amount'];
            $productStock->tax_type = $validated['tax_type'] ?? $productStock->tax_type;
            $productStock->tax_percentage = $validated['tax_percentage'] ?? $productStock->tax_percentage;
            $productStock->unit_id = $validated['unit'] ?? $productStock->unit_id;
            $productStock->hsn_code = $validated['hsn_code'] ?? $productStock->hsn_code;
            $productStock->part_number = $validated['part_number'];

            $productStock->save();

            return response()->json([
                'status' => true,
                'message' => 'Stock Updated Successfully',
                'data' => $productStock
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update stock. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getStockCategorey(Request $request)
    {
        $data = [
            [
                "id" => 1,
                "title" => "Accessory"
            ],
            [
                "id" => 2,
                "title" => "Part"
            ],
            [
                "id" => 3,
                "title" => "Tool"
            ],
            [
                "id" => 4,
                "title" => "Lubricant"
            ],
        ];

        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }

    public function getStocks(Request $request)
    {
        $user = Auth::guard('workshop_api')->user();

        $items = ProductStock::with('label', 'categories', 'unit')->where('user_id', $user->is_user == 0 ? $user->id : $user->parent_id);

        if (!empty($request->search)) {
            $items = $items->whereHas('label', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            });
            $items = $items->Orwhere('brand', 'like', '%' . $request->search . '%');
        }
        if ($request->search_category) {
            $items = $items->where('category_id', $request->search_category);
        }
        $data = $items->orderBy('created_at', 'desc')->get();

        return response()->json([
            "status" => true,
            "message" => "Data Found successfully",
            "data" => $data
        ], 200);
    }


    // New 27-03-25

    // Labour         
    public function addLabourCharges(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'price' => 'required',
            'total' => 'required',

            'gst_type' => 'nullable',
            'gst' => 'nullable'
        ]);

        try {

            $user = Auth::guard('workshop_api')->user();

            $data = LabourCharge::create([
                'title' => $request->title,
                'price' => $request->price,
                'gst' => $request->gst,
                'gst_type' => $request->gst_type,
                'user_id' => $user->id,
                'total' => $request->total,
                'status' => 1,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Labour Charge added successfully!',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to add Labour. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateLabourCharges(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'price' => 'required',
            'total' => 'required',

            'gst_type' => 'nullable',
            'gst' => 'nullable',

            'labour_id' => 'required'
        ]);

        try {

            $user = Auth::guard('workshop_api')->user();

            $labour = LabourCharge::findOrFail($request->labour_id);
            $labour->update([
                'title' => $request->title,
                'price' => $request->price,
                'gst' => $request->gst,
                'gst_type' => $request->gst_type,
                'user_id' => $user->id,
                'total' => $request->total,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Labour Charge updated successfully!',
                'data' => $labour
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update Labour. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function deleteLabourCharges(Request $request)
    {
        $validated = $request->validate([
            'labour_id' => 'required'
        ]);

        try {

            LabourCharge::destroy($request->labour_id);

            return response()->json([
                'status' => true,
                'message' => 'Labour Charge Deleted successfully!',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete Labour. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getLabourCharges(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable'
        ]);

        try {

            $user = Auth::guard('workshop_api')->user();
            $data = LabourCharge::where('user_id', $user->id);

            if ($request->search) {
                $data = $data->where(function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->search . '%');
                });
            }

            $data = $data->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Data Found successfully!',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Get Labour. ' . $e->getMessage(),
            ], 500);
        }
    }

    // Roles 

    public function addRole(Request $request)
    {
        $validated = $request->validate([
            'permissions' => 'required|array',
            'roleName' => 'required'
        ]);



        $role = PermisionRole::create(['name' => $request->roleName]);
        $role->syncPermissions($request->permissions);


        return response()->json([
            "status" => true,
            "message" => "Role added successfully!",
            "data" => $role
        ], 200);
    }

    public function updateRole(Request $request)
    {
        $validated = $request->validate([
            'permissions' => 'required|array',
            'roleName' => 'required',
            'roleId' => 'required'
        ]);

        $role = PermisionRole::findOrFail($request->roleId);
        $role->update([
            'name' => $request->roleName,
        ]);

        $role->syncPermissions($request->permissions);


        return response()->json([
            "status" => true,
            "message" => "Role updated successfully!",
            "data" => $role
        ], 200);
    }

    public function deleteRole(Request $request)
    {
        $validated = $request->validate([
            'roleId' => 'required'
        ]);

        PermisionRole::destroy($request->roleId);

        return response()->json([
            "status" => true,
            "message" => "Role deleted successfully!",
        ], 200);
    }

    public function getRoles(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable'
        ]);

        try {

            $user = Auth::guard('workshop_api')->user();
            $data = PermisionRole::orderBy('created_at', 'desc')->where('guard_name', 'web');

            if ($request->search) {
                $data = $data->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
            }

            $data = $data->get();

            return response()->json([
                'status' => true,
                'message' => 'Data Found successfully!',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Get Labour. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getPermission(Request $request)
    {
        try {
            $permission = Permission::orderBy('menu', 'asc')->where('guard_name', 'web')->get();
            $data = [];
            foreach ($permission->toArray() as $key => $value) {
                $data[$value['menu']][] = $value;
            }
            return response()->json([
                'status' => true,
                'message' => 'Data Found successfully!',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to Get Labour. ' . $e->getMessage(),
            ], 500);
        }
    }
    
   public function setVendorLoginStatus(Request $request)
     {
    $validated = $request->validate([
        'id' => 'required|exists:work_shop_vendor,id',   // <-- yahan id use kiya
        'is_login' => 'required|boolean',
    ]);

    $vendor = WorkShopVendor::find($validated['id']);   // <-- yahan bhi id use kiya
    $vendor->is_login = $validated['is_login'];
    $vendor->save();

    return response()->json([
        'status' => true,
        'message' => 'Login status updated successfully!',
        'data' => [
            'id' => $vendor->id,
            'is_login' => $vendor->is_login,
        ]
     ], 200);
     }


    public function getExpenseSupplierNames()
    {
        $suppliers = Suppliers::select('id', 'name', 'lastname')->get();

        return response()->json([
            "status" => true,
            "message" => "Suppliers fetched successfully!",
            "data" => $suppliers,
        ], 200);
    }
    
    
     public function deleteStock(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:stocks,id',
        ]);

        $stock = ProductStock::find($request->id);

        if (!$stock) {
            return response()->json([
                "status" => false,
                "message" => "Stock not found",
            ], 404);
        }

        $stock->delete();

        return response()->json([
            "status" => true,
            "message" => "Stock deleted successfully",
        ], 200);
    }
    
    //  public function generateCounterSaleNumber()
    // {
    //     // The generateHashCounterSaleNumber function expects a userId.
    //     // Assuming the API call might be authenticated or a default user ID is acceptable.
    //     // For now, I'll use a placeholder or the authenticated workshop user's ID if available.
    //     // Since the original code used time(), I'll default to a placeholder if no user is authenticated via API.
    //     $userId = Auth::guard('workshop')->check() ? Auth::guard('workshop')->user()->id : 1; // Default to 1 if no workshop user is authenticated

    //     // Ensure the helper function is accessible.
    //     // If 'generateHashCounterSaleNumber' is not autoloaded via composer or another mechanism,
    //     // you might need to manually include the file where it's defined here, or ensure
    //     // it's globally available.
    //     // For the purpose of this API, we are assuming it's globally available.

    //     $counterSaleNumber = generateHashCounterSaleNumber($userId);

    //     return response()->json([
    //         'status' => 'success',
    //         'counter_sale_number' => $counterSaleNumber
    //     ]);
    // }
    
     public function generateCounterSaleNumber()
    {
        
        // if (!function_exists('generateHashCounterSaleNumber')) {
        //     function generateHashCounterSaleNumber($userId)
        //     {
        //         $timestamp = microtime(true);
        //         $random = mt_rand();
        //         $hash = strtoupper(substr(sha1($userId . $timestamp . $random), 0, 10));
        //         return "CS-{$hash}";
        //     }
        // }

        $counterSaleNumber = generateHashCounterSaleNumber(time());

        return response()->json([
            'status' => 'success',
            'counter_sale_number' => $counterSaleNumber
        ]);
    }
}
