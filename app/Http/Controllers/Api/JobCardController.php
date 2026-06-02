<?php

namespace App\Http\Controllers\Api;

use App\Models\Companie;
use App\Models\Customer;
use App\Models\JobCardImage;
use App\Models\JobCardsInspection;
use App\Models\JobCardSparePart;
use App\Models\Vehicle;
use App\Models\JobCard;
use App\Models\JobCardsDentMark;
use App\Models\WorkShopVendor;
use App\Models\Role;
use App\Models\UploadImage;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Twilio\Rest\Client;
use DB;

use App\Models\Staff;

use App\Models\SparePartLabel;
use App\Models\JobCardExtraCharge;
use App\Models\SendJobCardPdfMail;
use App\Models\ProductStock;

use App\Mail\EstimateMail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\SparePart;
use App\Models\OrderItem;
use App\Models\Modification;


class JobCardController extends BaseController
{

    public function searchVehicle(Request $request)
    {
        $success['vehicle'] = Vehicle::where('number_plate', 'like', '%' . $request->number_plate . '%')->get();
        return $this->sendResponse($success, 'Vehicles Show successfully.');
    }


public function vechileSearchCutomer(Request $request)
{
    $search = trim($request->input('search'));

    $jobCardsInspection = Modification::whereStatus(1);

    $jobCardsInspection->where(function ($q) use ($search) {
        $q->where('title', 'like', '%' . $search . '%')
            ->orWhere('brand_name', 'like', '%' . $search . '%')
            ->orWhere('variant_name', 'like', '%' . $search . '%')
            ->orWhere('year', 'like', '%' . $search . '%');
    });

    $vehicles = $jobCardsInspection
        ->select(
            'id',
            DB::raw("CONCAT(brand_name, ' ', variant_name, ' ', year, ' ', title) as vehicle_details")
        )->get();

    // Here’s a standard API response format
    return response()->json([
        'status' => true,
        'message' => 'Vehicle search results fetched successfully.',
        'data' => $vehicles,
        // 'next_page_url' => null,
    ], 200);
}


    // public function addcustomer(Request $request)
    // {


    //     $validator = Validator::make($request->all(), [
    //         'vehicle_number' => 'required|unique:vehicles,number_plate',
    //         'chassis_number' => 'required|unique:vehicles,chassisno',
    //         'engine_number' => 'required|unique:vehicles,engineno',
    //         'meter_reading' => 'required',
    //         'vehicle_brand' => 'required',
    //         'vehicle_type' => 'required',
    //         'model' => 'required',
    //         'fuel_type' => 'required',
    //         'model_year' => 'required',
    //         'no_of_gear' => 'required',
    //         'date_of_manufacturing' => 'required',
    //         'gear_box' => 'required',
    //         'gear_box_no' => 'required',
    //         'engine_size' => 'required',
    //         'key_no' => 'required',
    //         'engine' => 'required',
    //         // customer detail
    //         'name' => 'required|string',
    //         'lastname' => 'required|string',
    //         'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:work_shop_vendor,mobile_no',
    //         'email' => 'required|unique:work_shop_vendor,email',
    //         'address' => 'required',
    //         'gender' => 'required',
    //         'password' => 'required|string|min:8|confirmed',
    //         'country_id' => 'required',
    //         'state_id' => 'required',
    //         'city_id' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         $errors = collect($validator->errors())->map(function ($error) {
    //             return $error[0]; // Only return the first error
    //         });
    //         return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
    //     }



    //     // $getRoleId = Role::where('role', '=', 'Customer')->first();

    //     $dobs = $request->date_of_birth;
    //     if (getDateFormat() == 'm-d-Y') {
    //         $dob = date('Y-m-d', strtotime(str_replace('-', '/', $dobs)));
    //     } else {
    //         $dob = date('Y-m-d', strtotime($dobs));
    //     }

    //     $customer = new Customer();
    //     $customer->name = $request->name;
    //     $customer->lastname = $request->lastname;
    //     $customer->mobile_no = $request->mobile;
    //     $customer->email = $request->email;
    //     $customer->address = $request->address;
    //     $customer->gender = $request->gender;
    //     $customer->birth_date = $dobs;
    //     $customer->password = bcrypt($request->password);
    //     $customer->country_id = $request->country_id;
    //     $customer->state_id = $request->state_id;
    //     $customer->city_id = $request->city_id;
    //     // $customer->role = "Customer";updateJobCard
    //     // $customer->role_id = $getRoleId->id;
    //     // $customer->language = "en";
    //     // $customer->timezone = "UTC";
    //     $customer->save();


    //     $domm = $request->date_of_manufacturing;

    //     $dom = '';
    //     if (!empty($domm)) {
    //         if (getDateFormat() == 'm-d-Y') {
    //             $dom = date('Y-m-d', strtotime(str_replace('-', '/', $domm)));
    //         } else {
    //             $dom = date('Y-m-d', strtotime($domm));
    //         }
    //     }

    //     $vehical = new Vehicle;
    //     $vehical->chassisno = $request->chassis_number;
    //     $vehical->vehiclebrand_id = $request->vehicle_brand;
    //     $vehical->modelyear = $request->model_year;
    //     $vehical->fuel_id = $request->fuel_type;
    //     $vehical->modelname = $request->model;
    //     $vehical->odometerreading = $request->meter_reading;
    //     $vehical->engineno = $request->engine_number;
    //     $vehical->number_plate = $request->vehicle_number;
    //     $vehical->vehicletype_id = $request->vehicle_type;
    //     $vehical->customer_id = $customer->id;
    //     $vehical->nogears = $request->no_of_gear;
    //     $vehical->dom = $dom;
    //     $vehical->gearbox = $request->gear_box;
    //     $vehical->gearboxno = $request->gear_box_no;
    //     $vehical->enginesize = $request->engine_size;
    //     $vehical->keyno = $request->gear_no;
    //     $vehical->engine = $request->engine;
    //     $vehical->save();

    //     return $this->sendResponse(
    //         ['customer' => $customer, 'vehicle' => $vehical],
    //         'Customer Created successfully.',
    //         null,
    //         200
    //     );
    // }
    
    
public function addcustomer(Request $request)
{
    // ✅ Log the incoming workshop_id for debugging
    \Log::info('Incoming workshop_id:', [
        'workshop_id' => $request->workshop_id,
        'type' => gettype($request->workshop_id)
    ]);

    // ✅ If workshop_id is string, cast to integer
    $request->merge([
        'workshop_id' => (int)$request->workshop_id
    ]);

    // ✅ Validation rules
    $valArr = [
        'name' => "required",
        'lastname' => "required",
        'mobile_no' => "required|digits:10",
        'pincode' => "nullable|digits:6",
        'address' => "required",
        'vehicle_type_id' => "required|exists:modifications,id",
        'workshop_id' => "required|exists:work_shop_vendor,id",
    ];

    $messages = [
        'name.required' => "The first name field is required.",
        'lastname.required' => "The last name field is required.",
        'mobile_no.required' => "The mobile number is required.",
        'vehicle_type_id.required' => "Select the vehicle using search.",
        'vehicle_type_id.exists' => "Invalid vehicle selected.",
        'workshop_id.required' => "Workshop ID is required.",
        'workshop_id.exists' => "The selected workshop id is invalid.",
    ];

    $validated = $request->validate($valArr, $messages);

    // ✅ Fetch the modification data
    $modification = Modification::find($request->vehicle_type_id);

    if (!$modification) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid modification/vehicle type ID.',
        ], 404);
    }

    // ✅ Create vehicle name string
    $vehicleNameParts = array_filter([
        $modification->brand_name ?? '',
        $modification->variant_name ?? '',
        $modification->year ?? '',
        $modification->title ?? ''
    ]);
    $selectedVehicleName = implode(' ', $vehicleNameParts);

    // ✅ Check if customer already exists
    $customerSearch = Customer::where('mobile_no', $request->mobile_no)
        ->where('user_id', $request->workshop_id)
        ->first();

    if (!$customerSearch) {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->lastname = $request->lastname;
        $customer->user_title = $request->user_title ?: null;
        $customer->birth_date = $request->birth_date ? date('Y-m-d', strtotime($request->birth_date)) : null;
        $customer->email = $request->email ?: null;
        $customer->mobile_no = $request->mobile_no;
        $customer->cust_type = $request->cust_type !== '' && $request->cust_type !== null ? (int)$request->cust_type : 0;
        $customer->company_name = $request->company_name ?: null;
        $customer->address = $request->address;
        $customer->pincode = $request->pincode ?: null;
        $customer->country_id = $request->country_id ?: null;
        $customer->state_id = $request->state_id ?: null;
        $customer->city_id = $request->city_id ?: null;
        $customer->user_id = $request->workshop_id;
        $customer->gst_number = $request->gst_no ?: null;
        $customer->save();
    } else {
        $customer = $customerSearch;
    }

    // ✅ Create vehicle entry
    $vehicle = new Vehicle();
    $vehicle->modification_id = $modification->id;
    $vehicle->brand = $modification->brand_name;
    $vehicle->variant = $modification->variant_name;
    $vehicle->year = $modification->year;
    $vehicle->modification = $modification->title;
    $vehicle->number_plate = $request->number_plate ?? '';
    $vehicle->chassis_no = $request->chassis_no;
    $vehicle->date_of_manufacturing = $request->date_of_manufacturing;
    $vehicle->engineno = $request->engine_no;
    $vehicle->driver_name = $request->driver_name;
    $vehicle->driver_number = $request->driver_number;
    $vehicle->policy_number = $request->policy_number;
    $vehicle->insurance_name = $request->insurance_name;
    $vehicle->pickup_address = $request->pickup_address;
    $vehicle->drop_address = $request->drop_address;
    $vehicle->gstin_number = $request->gst_no;
    $vehicle->policy_expiry_date = $request->policy_expiry_date;
    $vehicle->customer_id = $customer->id;
    $vehicle->save();

    // ✅ Response
    return response()->json([
        'status' => true,
        'message' => 'Customer and vehicle added successfully!',
        'customer' => $customer,
        'vehicle' => $vehicle,
        'selected_vehicle_name' => $selectedVehicleName,
    ], 201);
}



    public function vehicleType()
    {
        $success['vehicle_type'] = DB::table('vehicle_types')->where('soft_delete', 0)->get();
        return $this->sendResponse($success, 'Vehicle Type Show Successfully.');
    }

    public function vehicleBrand()
    {

        $success['vehicle_brand'] = DB::table('vehicle_brands')->where('soft_delete', 0)->get();

        return $this->sendResponse($success, 'Vehicle Brand Show Successfully.');
    }

    public function vehicleModel(Request $request)
    {

        $success['vehicle_model'] = DB::table('model_names')->where([['brand_id', '=', $request->brand_id], ['soft_delete', '=', 0]])->get()->toArray();

        return $this->sendResponse($success, 'Vehicle Model Show Successfully.');
    }


    public function vehicleFuelType()
    {

        $success['vehicle_fuel_type'] = DB::table('fuel_types')->where('soft_delete', 0)->get();
        return $this->sendResponse($success, 'Vehicle Fuel Type Show Successfully.');
    }


    public function searchAccessories(Request $request)
    { 
        $success['accessories'] = JobCardsInspection::where('customer_voice', 'LIKE', '%' . $request->accessories . '%')
        ->where('is_customer_voice', 2)
        ->take(5)
        ->get();
        return $this->sendResponse($success, 'Accessory Show Successfully.');
    }


    public function addaccessories(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'accessories' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0]; // Only return the first error
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }

        $success['accessories'] = JobCardsInspection::create([
            'jobcard_number' => $request->jobcard_number,
            'customer_voice' => $request->accessories,
            'is_customer_voice' => 2,
        ]);

        return $this->sendResponse($success, 'Accessory Created Successfully.');
    }


    public function searchCustomerVoice(Request $request)
    {
        // $success['customer_voice'] = JobCardsInspection::where('customer_voice', 'LIKE', '%' . $request->customer_voice . '%')
        //     ->where('is_customer_voice', 1)
        //     ->take(5)
        //     ->groupBy('customer_voice')
        //     ->get();
        $success['accessories'] = JobCardsInspection::where('customer_voice', 'LIKE', '%' . $request->accessories . '%')
            ->where('is_customer_voice', 2)
            ->take(5)
            ->get();


        return $this->sendResponse($success, 'Customer Voice Show Successfully.');
    }

    public function addCustomerVoice(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'customer_voice' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0]; // Only return the first error
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }


        $success['customer_voice'] = JobCardsInspection::create([
            'jobcard_number' => $request->jobcard_number,
            'customer_voice' => $request->customer_voice,
            'is_customer_voice' => 1,
        ]);

        return $this->sendResponse($success, 'Customer Voice Created Successfully.');
    }


    public function searchWorkNotes(Request $request)
    {
        // $success['customer_voice'] = JobCardsInspection::where('customer_voice', 'LIKE', '%' . $request->work_notes . '%')
        //     ->where('is_customer_voice', 0)
        //     ->take(5)
        //     ->groupBy('customer_voice')
        //     ->get();

            $success['customer_voice'] = JobCardsInspection::where('customer_voice', 'LIKE', '%' . $request->work_notes . '%')
            ->where('is_customer_voice', 0)
            ->take(5)
            ->get();


        return $this->sendResponse($success, 'Customer Voice Show Successfully.');
    }

    public function addWorkNotes(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'work_notes' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0]; // Only return the first error
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }


        $success['work_notes'] = JobCardsInspection::create([
            'jobcard_number' => $request->jobcard_number,
            'customer_voice' => $request->work_notes,
            'is_customer_voice' => 0,
        ]);

        return $this->sendResponse($success, 'Work Notes Created Successfully.');
    }
    public function storeJobcard(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'job_card_number' => 'required|string|max:255',
            'customer_id' => 'required|integer',
            'vehicle_id' => 'required|integer',
            'km_reading' => 'required|integer',
            'fual_level' => 'required|string',
            'sparepart.sparepart_id' => 'required|array',
            'sparepart.price' => 'required|array',
            'sparepart.qty' => 'required|array',
            'sparepart.discount' => 'required|array',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0];
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }

        $vehicleId = $request->vehicle_id;

        
        $customer = Customer::with([
            'vehicles' => function ($query) use ($vehicleId) {
                $query->where('id', $vehicleId);
            }
        ])->find($request->customer_id); // Fixed: customer_id instead of customer_name
           
        if (!$customer) {
            return $this->sendResponse(null, 'Customer not found.', [], 404, false);
        }

        if ($customer->vehicles->isEmpty()) {
            return $this->sendResponse(null, 'Vehicle not found for the given customer.', [], 404, false);
        }

        
        $vehicle = $customer->vehicles->first();

        $jobcard = new JobCard;
        
        // echo "<pre>";print_r($request->toArray());die;
        $jobcard->jobcard_number = $request->job_card_number;
        $jobcard->customer_id = $request->customer_id;
        $jobcard->customer_name = strtoupper($customer->name . ' ' . $customer->lastname);
        $jobcard->vehicle_id = $request->vehicle_id;
        $jobcard->vehical = $vehicle->modelname;
        $jobcard->vehical_number = $vehicle->number_plate;
        $jobcard->entry_date = Carbon::now();
        $jobcard->amount = $request->total_amount;
        $jobcard->final_amount = $request->final_amount;
        $jobcard->advance = $request->advance;
        $jobcard->discount = $request->discount;
        $jobcard->balance_amount = $request->balance_amount;
        $jobcard->supervisor_id = $request->supervisor;
        $jobcard->km_runing = $request->km_reading;
        $jobcard->fual_level = $request->fual_level;
        $jobcard->delivery_date = $request->delivery_date;
        $jobcard->delivery_time = $request->delivery_time;
        $jobcard->save();
      
       

        $sparePartsData = [];
        foreach ($request->sparepart['sparepart_id'] as $index => $sparepartId) {
            $sparePartsData[] = [
                'jobcard_id' => $jobcard->id,
                'stock_label_id' => $sparepartId,
                'price' => $request->sparepart['price'][$index],
                'quantity' => $request->sparepart['qty'][$index],
                'total_amount' => $request->sparepart['price'][$index]*$request->sparepart['qty'][$index],
                'discount' => $request->sparepart['discount'][$index],
                'final_amount' => $request->sparepart['price'][$index]*$request->sparepart['qty'][$index]-$request->sparepart['discount'][$index],
                // 'machanic_id' => $request->mechanic_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // echo "<pre>";print_r($sparePartsData);die;

        $jobCardSparePart = JobCardSparePart::insert($sparePartsData);

        $loobsData = [];
        foreach ($request->loobs['loobs_id'] as $index => $loobId) {
            $loobsData[] = [
                'jobcard_id' => $jobcard->id,
                'stock_label_id' => $loobId,
                'price' => $request->loobs['price'][$index],
                'quantity' => $request->loobs['qty'][$index],
                'total_amount' => $request->loobs['price'][$index]*$request->loobs['qty'][$index],
                'discount' => $request->loobs['discount'][$index],
                'final_amount' => $request->loobs['price'][$index]*$request->loobs['qty'][$index]-$request->loobs['discount'][$index],
                // 'machanic_id' => $request->mechanic_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $jobCardloobs = JobCardSparePart::insert($loobsData);

        $toolsData = [];
        foreach ($request->tools['tools_id'] as $index => $toolsId) {
            $toolsData[] = [
                'jobcard_id' => $jobcard->id,
                'stock_label_id' => $toolsId,
                'price' => $request->tools['price'][$index],
                'quantity' => $request->tools['qty'][$index],
                'total_amount' => $request->tools['price'][$index]*$request->tools['qty'][$index],
                'discount' => $request->tools['discount'][$index],
                'final_amount' => $request->tools['price'][$index]*$request->tools['qty'][$index]-$request->tools['discount'][$index],
                // 'machanic_id' => $request->mechanic_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $jobCardSparePart = JobCardSparePart::insert($toolsData);

        return $this->sendResponse($jobcard, 'Job Card Created Successfully.');
    }
    
    
    
      public function dentImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image',
            'jobcard_number' => 'required|string',
        ]);

        $imageData = $request->file('file');

        $fileName = 'marked_car_' . Str::random(10) . '.' . $imageData->getClientOriginalExtension();

        $path = public_path('uploads/' . $fileName);

        $imageData->move(public_path('uploads'), $fileName);

        $carImage = new UploadImage();
        $carImage->file = 'uploads/' . $fileName;
        $carImage->img_id = 0;
        $carImage->save();

        $jobCardsDentMark = new JobCardsDentMark();
        $jobCardsDentMark->jobcard_number = $request->input('jobcard_number');
        $jobCardsDentMark->file_id = $carImage->id;
        $jobCardsDentMark->save();

        return response()->json([
            'status'=>true,
            'message' => 'Image uploaded successfully!',
            'image_url' => asset('uploads/' . $fileName),
            'image_id' => $jobCardsDentMark->id,
        ], 200);
    }
    
    
    

    
        public function genreateJobCardNumber(Request $request)
    {
        $number = generateHashJobCardNumber(Auth::guard('workshop_api')->user());
        return response()->json([
            'status'=>true,
            'message' => 'Job Card Number Genreated Successfully!',
            'data' => $number,
        ], 200);
    }
    
    
    
    
    // New 25-03-25
    
    // public function vechileSearchCutomer(Request $request)
    // {
    //     $search = $request->search;
    //     $data =  \DB::table('model_names')
    //             ->join('vehicle_brands', 'model_names.brand_id', '=', 'vehicle_brands.id')
    //             ->join('vehicle_types', 'vehicle_brands.vehicle_type_id', '=', 'vehicle_types.id')
    //             ->when($search, function ($query, $search) {
    //                 $query->where(function ($query) use ($search) {
    //                     $query->where('vehicle_types.vehicle_type', 'like', "%{$search}%")
    //                         ->orWhere('vehicle_brands.vehicle_brand', 'like', "%{$search}%")
    //                         ->orWhere('model_names.model_name', 'like', "%{$search}%");
    //                 });
    //             })
    //             ->select(
    //                 'model_names.id', // Include the ID of the model_names table
    //                 \DB::raw("CONCAT(vehicle_types.vehicle_type, '/', vehicle_brands.vehicle_brand, '/', model_names.model_name) as vehicle_details")
    //             )
    //             ->distinct() // Avoid duplicate entries
    //             ->get();
                
    //     return response()->json([
    //         'status'=>true,
    //         'message' => 'Data Found Successfully!',
    //         'data' => $data,
    //     ], 200);
        
    // }
    
//     public function getSpareParts(Request $request)
// {
//     $spareParts = SparePart::query()->with('label');

//     if ($request->has('search') && !empty($request->search)) {
//         $search = trim($request->search);
//         $spareParts->where(function ($q) use ($search) {
//             $q->whereHas('label', function ($q) use ($search) {
//                 $q->where('title', 'like', '%' . $search . '%');
//             });
//         });
//     }

//     if ($request->maker_type_id || $request->maker_id || $request->model_year_id || $request->modification_id) {
//         $spareParts->whereHas('modifications.modification', function ($q) use ($request) {
//             if ($request->maker_type_id) {
//                 $q->where('brand_id', $request->maker_type_id);
//             }
//             if ($request->maker_id) {
//                 $q->where('variant_id', $request->maker_id);
//             }
//             if ($request->model_year_id) {
//                 $q->where('year', $request->model_year_id);
//             }
//             if ($request->modification_id) {
//                 $q->where('id', $request->modification_id);
//             }
//         });
//     }

//     $perPage = $request->input('per_page', 10); // default 10
//     $spareParts = $spareParts->latest()->paginate($perPage);

//     return response()->json([
//         'status' => true,
//         'message' => 'Data Found Successfully!',
//         'data' => $spareParts->items(), // for just data list
//         'pagination' => [
//             'total' => $spareParts->total(),
//             'current_page' => $spareParts->currentPage(),
//             'last_page' => $spareParts->lastPage(),
//             'per_page' => $spareParts->perPage(),
//             'has_more_pages' => $spareParts->hasMorePages(),
//         ],
//     ], 200);
// }

    
    // NEw 26-03-25
    public function createJobCard(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'job_card_number' => 'required|string|max:255',
            'vehicle_id' => 'required|integer',
            'customer_name' => "required",
            'km_reading' => "nullable|min:0",
            "customer_id" => "required"
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0];
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }


        $vehicleData =  Vehicle::where('id', $request->vehicle_id)->first();
        $user = Auth::guard('workshop_api')->user();


        $customer = Customer::with(['vehicles' => function ($query) use ($request) {
            $query->where('id', $request->vehicle_id);
        }])->where('id',$request->customer_id)->first();
       
        //     $vehicleName = array_filter([
        //     $customer->brand ?? '',
        //     $customer->variant ?? '',
        //     $customer->year ?? '',
        //     $customer->modification ?? ''
        // ]);

        // $selectedVehicleName = implode(' ',$vehicleName);
       
       
        if ($customer) {
            $jobcard = new JobCard();
            $jobcard->jobcard_number = $request->job_card_number;
            $jobcard->customer_id = $request->customer_id;
            $jobcard->customer_name = strtoupper($customer->name . ' ' . $customer->lastname);
            $jobcard->vehicle_id = $request->vehicle_id ?? 0;
            $jobcard->vehical = @$customer->vehicles->first()->modelname ?? 0;
            //   $jobcard->vehical = $selectedVehicleName ?? 0;
            $jobcard->vehical_number = @$customer->vehicles->first()->number_plate ?? 0;
            $jobcard->entry_date = Carbon::now();
            $jobcard->amount = $request->total_amount ?? 0;
            $jobcard->discount = $request->total_discount ?? 0;
            $jobcard->final_amount = $request->final_amount ?? 0;
            $jobcard->advance = $request->advance ?? 0;
            $jobcard->balance_amount = $request->balance_amount ?? 0;
            $jobcard->km_runing = $request->km_reading ?? 0;
            $jobcard->fual_level = $request->fual_level ?? 0;
            $jobcard->supervisor_id = $request->supervisor ?? 0;
            $jobcard->sms_alert = $request->sms_alert ?? 0;
            $jobcard->delivery_date = $request->delivery_date ??  Carbon::now();
            $jobcard->delivery_time = $request->delivery_time ??  Carbon::now();
            $jobcard->user_id =  $user->id;
            $jobcard->save();
            return $this->sendResponse($jobcard, 'Job Card Created Successfully.');
        } else {
            return $this->sendResponse([], 'No Customer Found', [], 404, false);
        }
    }
    
    public function getCustomerVehicles(Request $request)
    {  
        $search = $request->search;
        
         $user = Auth::guard('workshop_api')->user();
         
        $data = Vehicle::query()
           ->where('customers.user_id',$user->id)
            ->join('customers', 'vehicles.customer_id', '=', 'customers.id')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('customers.name', 'like', "%{$search}%")
                        ->orWhere('customers.lastname', 'like', "%{$search}%")
                        ->orWhere('customers.mobile_no', 'like', "%{$search}%")
                        ->orWhere('vehicles.number_plate', 'like', "%{$search}%");
                });
            })
            ->select('vehicles.id', 'vehicles.number_plate', 'customers.name', 'customers.lastname', 'customers.mobile_no','customers.id as customer_id')
            ->get();

        return response()->json([
            'status'=>true,
            'data' => $data,
            'message' => 'Data Found Successfully!',
        ]);
    }
    
    // public function getSupervisor(Request $request)
    // {
    //     $user = Auth::guard('workshop_api')->user();
    //     $data = Staff::where('role', 1)->where('parent_id', $user->id)->get();

    //     return response()->json([
    //         'status'=>true,
    //         'data' => $data,
    //         'message' => 'Data Found Successfully!',
    //     ]);
    // }
    
public function getSupervisor(Request $request)
{
    $user = Auth::guard('sanctum')->user(); // OR just Auth::user() if default guard is sanctum

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized',
        ], 401);
    }

    $workshopId = $user->id;

    $data = WorkShopVendor::where('parent_id', $workshopId)->get();

    return response()->json([
        'status' => true,
        'data' => $data,
        'message' => 'Data Found Successfully!',
    ]);
}

    
    // New 27-03-25 
    
    public function fetchCustomerVoicesData(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'jobcard_number' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0];
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }
        
        
        $customerVoices = JobCardsInspection::where('jobcard_number', $request->jobcard_number)
        ->where('is_customer_voice', 1)
        ->pluck('customer_voice')
        ->toArray();
        
        $customerVoicesData = DB::table('job_cards_inspections')->where('is_customer_voice',1)
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));
        if (!empty($customerVoices)) {
            $customerVoicesData = $customerVoicesData->whereNotIn('customer_voice', $customerVoices);
        } 
        
        $customerVoicesData = $customerVoicesData->groupBy('customer_voice')->orderBy('id', 'desc')->get();
        
         return response()->json([
            'status'=>true,
            'message' => 'Data Found Successfully!',
            'data' => [
                ["added_voice"=>$customerVoices,"other"=>$customerVoicesData]
                ],
        ], 200);
        
    }
    
    public function fetchWorkNoteVoicesData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jobcard_number' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0];
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }

        $workVoices = JobCardsInspection::where('jobcard_number',$request->jobcard_number)
        ->where('is_customer_voice', 0)
        ->pluck('customer_voice')
        ->toArray();

        $worknotVoicesData = DB::table('job_cards_inspections')->where('is_customer_voice',0)
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));

        if (!empty($workVoices)) {
            $worknotVoicesData = $worknotVoicesData->whereNotIn('customer_voice', $workVoices);
        }

        $worknotVoicesData = $worknotVoicesData->groupBy('customer_voice')->orderBy('id', 'desc')->get();
        
         return response()->json([
            'status'=>true,
            'message' => 'Data Found Successfully!',
            'data' => [
                ["added_voice"=>$workVoices,"other"=>$worknotVoicesData]
                ],
        ], 200);
        
    } 
    
    public function fetchAccessoryData(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'jobcard_number' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0];
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }
        
        $accessoriesVoices = JobCardsInspection::where('jobcard_number', $request->jobcard_number)
        ->where('is_customer_voice', 2)
        ->pluck('customer_voice')
        ->toArray();
        $accessoryData = DB::table('job_cards_inspections')->where('is_customer_voice',2)
            ->select('customer_voice', DB::raw('MAX(is_customer_voice) as is_customer_voice'));

        if (!empty($accessoriesVoices)) {
            $accessoryData = $accessoryData->whereNotIn('customer_voice', $accessoriesVoices);
        }

        $accessoryData = $accessoryData->groupBy('customer_voice')->orderBy('id', 'desc')->get();
        
         return response()->json([
            'status'=>true,
            'message' => 'Data Found Successfully!',
            'data' => [
                ["added_voice"=>$accessoriesVoices,"other"=>$accessoryData]
                ],
        ], 200);
        
    }
    
    public function removeCustomerVoice(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'jobcard_number' => 'required|string|max:255',
            'customer_voice'=>'required',
            'type'=>'required'
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0];
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }
        
        JobCardsInspection::where('jobcard_number', $request->jobcard_number)->where('is_customer_voice', $request->type)->where('customer_voice',$request->customer_voice)->delete();
        
         return response()->json([
            'status'=>true,
            'message' => 'Remove successfully!'
        ], 200);
        
    }
    
      public function removeDentImage(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'dent_image_id' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0];
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }
        
        JobCardsDentMark::destroy($request->dent_image_id);
        
         return response()->json([
            'status'=>true,
            'message' => 'Dent Image deleted successfully!'
        ], 200);
        
    }
    
     public function uploadCarImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'property_photos' => 'required|array',
            'property_photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'property_id' => 'nullable',
            'jobcard_numbers' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0];
            });
            return response()->json([
                'status' => false,
                'message' => 'Validation Error.',
                'errors' => $errors,
            ], 400);
        }

        $photoIDs = [];
        if (sizeof($request->property_photos)) {
            foreach ($request->property_photos as $property_photo) {
                if (!empty($property_photo)) {
                    $photoPath = $property_photo->store("job_card_image/gallery", "public");
                    $fileExtension = $property_photo->getClientOriginalExtension();
                    $image = UploadImage::create([
                        "file" => $photoPath,
                        "ext" => $fileExtension,
                        "img_id" => 0,
                        "delete_code" => 0,
                        "type" => 0,
                    ]);
                    $photoIDs[] = $image->id;
                }
            }

            JobCardImage::where('job_card_number', $request->jobcard_numbers)->delete();
            if (!empty($photoIDs)) {
                JobCardImage::create([
                    'job_card_number' => $request->jobcard_numbers,
                    'image_id' => implode(',', $photoIDs),
                ]);
            }
            $photosCount = UploadImage::whereIn('id', $photoIDs)->get()->count();

            return response()->json([
                'status' => true,
                'message' => 'Property images uploaded successfully.',
                'photos_count' => $photosCount,
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'No photos uploaded.',
        ], 400);
    }
    
    
     public function getMechaniecs(Request $request)
    {
       $data = WorkShopVendor::where('type', 1)->get();
         return response()->json([
            'status'=>true,
            'message' => 'Data Found Successfully!',
            'data' => $data
        ], 200);
        
    }
    
    //uncommented old
    //  public function getSpareParts(Request $request)
    // {
        
    //     $validator = Validator::make($request->all(), [
    //         'type' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         $errors = collect($validator->errors())->map(function ($error) {
    //             return $error[0];
    //         });
    //         return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
    //     }
        
    //       $user = Auth::guard('workshop_api')->user();
          
    //   $labels =    ProductStock::where('user_id',$user->id)->get();

    //     $mergedData = [];

    //     foreach ($labels as $label) {
    //         if ($label->category_id == 1) {
    //             $spare_part_type = 'Accessory';
    //         } elseif ($label->category_id == 2) {
    //             $spare_part_type = 'Parts';
    //         } elseif ($label->category_id == 3) {
    //             $spare_part_type = 'Tools';
    //         } elseif ($label->category_id == 4) {
    //             $spare_part_type = 'Lubricants';
    //         }

    //         $mergedData[$label->category_id][] = [
    //             'label_id' => $label->label_id,
    //             'label_name' => @$label->label->title,
    //             'cat_type' => $label->category_id,
    //             'product_stock_id' => @$label->id,
    //             'stock' => @$label->stock,
    //             'price' => @$label->price,
    //         ];
    //     }


    //     $accessory = $mergedData[$request->type] ?? [];
        
    //      return response()->json([
    //         'status'=>true,
    //         'message' => 'Data Found Successfully!',
    //         'data' => $accessory
    //     ], 200);
    // }
    
    //unique lable id s
    public function getSpareParts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0];
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }

        $user = Auth::guard('workshop_api')->user();

        // Get all stocks for the user, order by id desc so latest comes first
        $labels = ProductStock::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        $mergedData = [];
        $seen = [];

        foreach ($labels as $label) {
            $key = $label->category_id . '-' . $label->label_id;
            if (isset($seen[$key])) {
                continue; // is category me is label_id ka latest aa chuka hai
            }
            $seen[$key] = true;

            if ($label->category_id == 1) {
                $spare_part_type = 'Accessory';
            } elseif ($label->category_id == 2) {
                $spare_part_type = 'Parts';
            } elseif ($label->category_id == 3) {
                $spare_part_type = 'Tools';
            } elseif ($label->category_id == 4) {
                $spare_part_type = 'Lubricants';
            }

            $mergedData[$label->category_id][] = [
                'label_id' => $label->label_id,
                'label_name' => @$label->label->title,
                'cat_type' => $label->category_id,
                'product_stock_id' => @$label->id,
                'stock' => @$label->stock,
                'price' => @$label->price,
            ];
        }

        $accessory = $mergedData[$request->type] ?? [];

        return response()->json([
            'status' => true,
            'message' => 'Data Found Successfully!',
            'data' => $accessory
        ], 200);
    }
    
    
    
    // New 29-03-25 
    //  public function getJobCardDetail(Request $request)
    // {
       
    //     $validator = Validator::make($request->all(), [
    //         'job_card_id' => 'required',
    //     ]);
    
    //     if ($validator->fails()) {
    //         $errors = collect($validator->errors())->map(function ($error) {
    //             return $error[0];
    //         });
    //         return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
    //     }
    
    //     $jobcardData = JobCard::find($request->job_card_id);
    //     if (!$jobcardData) {
    //         return $this->sendResponse(null, 'Job card not found.', [], 404, false);
    //     }
    
    //     $extracharges = JobCardExtraCharge::where('jobcard_id', $request->job_card_id)->get();
    //     $jobcardImage = JobCardImage::where('job_card_number', $jobcardData->jobcard_number)->first();
    //      $carImages = UploadImage::whereIn('id', explode(',', @$jobcardImage->image_id))->get();
         
    //     $spareParts = [];
    //     $lubes = [];
    //     $accessories = [];
    
    //     foreach ($jobcardData->jobCardSpareParts as $jobcardLabel) {
    //         $data = [
    //             'id' => $jobcardLabel->stock_label_id,
    //             'part_name' => $jobcardLabel->stock_label_name . ' (Current Stock: ' . $jobcardLabel->quantity . ')',
    //             'quantity' => $jobcardLabel->quantity,
    //             'unit_price' => $jobcardLabel->price,
    //             'total_amount' => $jobcardLabel->total_amount,
    //             'discount' => $jobcardLabel->discount,
    //             'final_amount' => $jobcardLabel->final_amount,
    //         ];
    
    //         switch ($jobcardLabel->category) {
    //             case 2: // Spare Parts
    //                 $spareParts[] = $data;
    //                 break;
    //             case 4: // Lubricants
    //                 $lubes[] = $data;
    //                 break;
    //             case 1: // Accessories
    //                 $accessories[] = $data;
    //                 break;
    //             default:
    //                 // Handle unknown categories if necessary
    //                 break;
    //         }
    //     }
        
    //     $jobCard = JobCardsDentMark::with('Image')->where('jobcard_number',  $jobcardData->jobcard_number)->first();
        
         
    //     $dentImage='';
    //     if (!empty($jobCard)) {
    //         $dentImage = $jobCard->Image->file;
    //     }
        
    //     $customerVoices = JobCardsInspection::where('jobcard_number', $jobcardData->jobcard_number)
    //     ->where('is_customer_voice', 1)
    //     ->pluck('customer_voice')
    //     ->toArray();
        
    //     $customerVoices = JobCardsInspection::where('jobcard_number', $jobcardData->jobcard_number)
    //     ->where('is_customer_voice', 1)
    //     ->pluck('customer_voice','id')
    //     ->toArray();
        
    //       $workVoices = JobCardsInspection::where('jobcard_number',$jobcardData->jobcard_number)
    //     ->where('is_customer_voice', 0)
    //     ->pluck('customer_voice','id')
    //     ->toArray();
        
    //      $accessoriesVoices = JobCardsInspection::where('jobcard_number', $jobcardData->jobcard_number)
    //     ->where('is_customer_voice', 2)
    //     ->pluck('customer_voice','id')
    //     ->toArray();
        
    //     $formattedAccessoriesVoices = array_map(function($key, $value) {
    //         return ['id' => $key, 'name' => $value];
    //     }, array_keys($accessoriesVoices), $accessoriesVoices);
        
    //      $formattedCustomerVoices = array_map(function($key, $value) {
    //         return ['id' => $key, 'name' => $value];
    //     }, array_keys($customerVoices), $customerVoices);
        
    //     $formattedWorkVoices = array_map(function($key, $value) {
    //         return ['id' => $key, 'name' => $value];
    //     }, array_keys($workVoices), $workVoices);
    
    //     $responseData = [
    //         'job_card' => $jobcardData,
    //         'extra_charges' => $extracharges,
    //         'job_card_image' => $carImages,
    //         'spare_parts' => $spareParts,
    //         'lubricants' => $lubes,
    //         'accessories' => $accessories,
    //         'dent_image' => asset($dentImage),
    //          'pdf_url_mechanic' => route('pdf.view', ['url' => base64_encode(route('download.estimate.invoice', [$jobcardData->id, 1]))]),
    //          'pdf_url_estimate' => route('pdf.view', ['url' => base64_encode(route('download.mechanic.sheet', [$jobcardData->id, 1]))]),
    //          'pdf_download_mechanic' => route('download.mechanic.sheet', [$jobcardData->id, 0]),
    //          'pdf_download_estimate' => route('download.estimate.invoice', [$jobcardData->id, 0]),
    //          'customer_voice'=>$formattedCustomerVoices,
    //          'workvoice'=>$formattedWorkVoices,
    //           'accessories_data'=>$formattedAccessoriesVoices,
    //     ];
    
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Job card details fetched successfully.',
    //         'data' => $responseData
    //     ], 200);
    // }

    //17/06/25

public function getJobCardDetail(Request $request)
{
    $validator = Validator::make($request->all(), [
        'job_card_id' => 'required',
    ]);

    if ($validator->fails()) {
        $errors = collect($validator->errors())->map(function ($error) {
            return $error[0];
        });
        return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
    }

    // Load customer and vehicle relationship here
    $jobcardData = JobCard::with(['customer', 'vehicle'])->find($request->job_card_id);
    if (!$jobcardData) {
        return $this->sendResponse(null, 'Job card not found.', [], 404, false);
    }

    $extracharges = JobCardExtraCharge::where('jobcard_id', $request->job_card_id)->get();
    $jobcardImage = JobCardImage::where('job_card_number', $jobcardData->jobcard_number)->first();
    $carImages = UploadImage::whereIn('id', explode(',', @$jobcardImage->image_id))->get();

    $spareParts = [];
    $lubes = [];
    $accessories = [];

    foreach ($jobcardData->jobCardSpareParts as $jobcardLabel) {
        $data = [
            'id' => $jobcardLabel->stock_label_id,
            'part_name' => $jobcardLabel->stock_label_name . ' (Current Stock: ' . $jobcardLabel->quantity . ')',
            'quantity' => $jobcardLabel->quantity,
            'unit_price' => $jobcardLabel->price,
            'total_amount' => $jobcardLabel->total_amount,
            'discount' => $jobcardLabel->discount,
            'final_amount' => $jobcardLabel->final_amount,
        ];

        switch ($jobcardLabel->category) {
            case 2: // Spare Parts
                $spareParts[] = $data;
                break;
            case 4: // Lubricants
                $lubes[] = $data;
                break;
            case 1: // Accessories
                $accessories[] = $data;
                break;
        }
    }

    $jobCard = JobCardsDentMark::with('Image')->where('jobcard_number', $jobcardData->jobcard_number)->first();
    $dentImage = '';
    if (!empty($jobCard)) {
        $dentImage = $jobCard->Image->file;
    }

    $customerVoices = JobCardsInspection::where('jobcard_number', $jobcardData->jobcard_number)
        ->where('is_customer_voice', 1)
        ->pluck('customer_voice', 'id')
        ->toArray();

    $workVoices = JobCardsInspection::where('jobcard_number', $jobcardData->jobcard_number)
        ->where('is_customer_voice', 0)
        ->pluck('customer_voice', 'id')
        ->toArray();

    $accessoriesVoices = JobCardsInspection::where('jobcard_number', $jobcardData->jobcard_number)
        ->where('is_customer_voice', 2)
        ->pluck('customer_voice', 'id')
        ->toArray();

    $formattedAccessoriesVoices = array_map(function ($key, $value) {
        return ['id' => $key, 'name' => $value];
    }, array_keys($accessoriesVoices), $accessoriesVoices);

    $formattedCustomerVoices = array_map(function ($key, $value) {
        return ['id' => $key, 'name' => $value];
    }, array_keys($customerVoices), $customerVoices);

    $formattedWorkVoices = array_map(function ($key, $value) {
        return ['id' => $key, 'name' => $value];
    }, array_keys($workVoices), $workVoices);

    $responseData = [
        'job_card' => $jobcardData,
        'extra_charges' => $extracharges,
        'job_card_image' => $carImages,
        'spare_parts' => $spareParts,
        'lubricants' => $lubes,
        'accessories' => $accessories,
        'dent_image' => asset($dentImage),
        'pdf_url_mechanic' => route('pdf.view', ['url' => base64_encode(route('download.estimate.invoice', [$jobcardData->id, 1]))]),
        'pdf_url_estimate' => route('pdf.view', ['url' => base64_encode(route('download.mechanic.sheet', [$jobcardData->id, 1]))]),
        'pdf_download_mechanic' => route('download.mechanic.sheet', [$jobcardData->id, 0]),
        'pdf_download_estimate' => route('download.estimate.invoice', [$jobcardData->id, 0]),
        'customer_voice' => $formattedCustomerVoices,
        'workvoice' => $formattedWorkVoices,
        'accessories_data' => $formattedAccessoriesVoices,
    ];

    return response()->json([
        'status' => true,
        'message' => 'Job card details fetched successfully.',
        'data' => $responseData
    ], 200);
}





    // public function updateJobCard(Request $request){
    //     $validatedData = $request->validate([
    //         'job_card_id' => 'required',
    //         'status' => 'required|integer',
    //         'step' => 'nullable|integer',
    //         'final_discount' => 'nullable|numeric|min:0',
    //         'final_paid' => 'nullable|numeric|min:0',
    //         'balance_amount' => 'nullable|numeric|min:0',
    //         'totalAmount' => 'required|numeric|min:1',
    //         'final_amount' => 'required|numeric|min:1',
    //         'extraCharges.*.mechanic_id' => 'required|integer',
    //         'spareParts' => 'array',
    //         'lubes' => 'array',
    //         'accessoriess' => 'array',
    //     ]);
        
    //     $jobcard = JobCard::find($request->job_card_id);

    //     $jobstatus = $jobcard->status;
        
    //      $user = Auth::guard('workshop_api')->user();
        
    //      if ($jobcard->status == 2) {
    //         $jobcard->final_discount = $request->final_discount;
    //         $jobcard->final_paid = $request->final_paid;
    //         $jobcard->amount = $request->totalAmount;
    //         $jobcard->discount = $request->total_discount;
    //         $jobcard->final_amount = $request->final_amount;
    //         $jobcard->advance = $request->advance;
    //         $jobcard->balance_amount = $request->balance_amount;
    //         $jobcard->payment_type = $request->payment_type;
    //         $jobcard->transaction_number = $request->transaction_number;
    //         $jobcard->status = 3;
    //         $jobcard->save();

    //         $SendJobCardPdfMail = new SendJobCardPdfMail;
    //         $SendJobCardPdfMail->jobcard_id = $jobcard->id;
    //         $SendJobCardPdfMail->template_type = 2;
    //         $SendJobCardPdfMail->save();

    //         return response()->json([
    //         'type' => 'success',
    //         'message' => 'Job-Card updated successfully!',
    //     ], 200);
    //     }
        
    //     $items = array_merge(
    //         array_column($request->spareParts, 'id'),
    //         array_column($request->lubes, 'id'),
    //         array_column($request->accessoriess, 'id'),
    //     );
    //     $qty = array_merge(
    //         array_column($request->spareParts, 'quantity'),
    //         array_column($request->lubes, 'quantity'),
    //         array_column($request->accessoriess, 'quantity'),
    //     );

    //     $price = array_merge(
    //         array_column($request->spareParts, 'unit_price'),
    //         array_column($request->lubes, 'unit_price'),
    //         array_column($request->accessoriess, 'unit_price'),
    //     );

    //     $totalAmount = array_merge(
    //         array_column($request->spareParts, 'total_amount'),
    //         array_column($request->lubes, 'total_amount'),
    //         array_column($request->accessoriess, 'total_amount'),
    //     );

    //     $discount = array_merge(
    //         array_column($request->spareParts, 'discount'),
    //         array_column($request->lubes, 'discount'),
    //         array_column($request->accessoriess, 'discount'),
    //     );

    //     $finalAmount = array_merge(
    //         array_column($request->spareParts, 'final_amount'),
    //         array_column($request->lubes, 'final_amount'),
    //         array_column($request->accessoriess, 'final_amount'),
    //     );
        
    //      $vehicleId = $request->vehicle_id;
         
    //       $customer = Customer::with([
    //         'customerVehicles' => function ($qry) use ($vehicleId) {
    //             $qry->where('id', $vehicleId);
    //         }
    //     ])->find($request->customer_name);

    //     $error = false;
    //     $decreaseStockId = [];
        
    //     if ($jobstatus == 1 && $request->status == 2 && !empty($items)) {
    //         foreach ($items as $itemKey => $itemValue) {
    //             $stock = ProductStock::where(['label_id' => $itemValue, 'price' => $price[$itemKey], 'user_id' => $user->id])->first();

    //             if ($stock) {
    //                 if ($stock->stock < $qty[$itemKey]) {

    //                     $error = true;
    //                 } else {
    //                     $decreaseStockId[] = [$stock->id, $qty[$itemKey]];
    //                 }
    //             } else {
    //                 $error = true;
    //             }
    //         }
    //     }

    //     if ($error) {
    //              return response()->json([
    //             'type' => 'error',
    //             'message' => 'Stock is not available for this order. Add stock and try again.',
    //         ], 200);
    //     }
        
    //      if (!empty($jobcard)) {
    //         $jobcard->customer_id = $request->customer_name;
    //         $jobcard->customer_name = strtoupper($customer->name . ' ' . $customer->lastname);
    //         $jobcard->vehicle_id = $vehicleId;
    //         $jobcard->vehical = $customer->customerVehicles->modelname;
    //         $jobcard->vehical_number = $customer->customerVehicles->number_plate;
    //         $jobcard->amount = $request->totalAmount;
    //         $jobcard->discount = array_sum($discount);
    //         $jobcard->final_amount = $request->final_amount;
    //         $jobcard->advance = $request->advance;
    //         $jobcard->balance_amount = $request->balance_amount;
    //         $jobcard->km_runing = $request->km_reading;
    //         $jobcard->fual_level = $request->fual_level;
    //         $jobcard->supervisor_id = $request->supervisor;
    //         if ($request->status != 0) {
    //             $jobcard->status = $request->status;
    //         }
    //         if (!empty($request->step)) {
    //             $jobcard->step = $request->step;
    //         }
    //         $jobcard->sms_alert = $request->smsAlert;
    //         $jobcard->delivery_date = $request->deliveryDate;
    //         $jobcard->delivery_time = $request->deliveryTime;
    //         $jobcard->payment_type = $request->payment_type;
    //         $jobcard->transaction_number = $request->transaction_number;
    //         $jobcard->save();


    //         JobCardSparePart::where('jobcard_id', $jobcard->id)->delete();
    //         if (!empty($items)) {
    //             if (count($items) > 0) {
    //                 foreach ($items as $itemKey => $itemValue) {
    //                     $labelName = SparePartLabel::select('title')->find($itemValue);
    //                     $item = new JobCardSparePart;
    //                     $item->jobcard_id = $jobcard->id;
    //                     $item->stock_label_id = $itemValue;
    //                     $item->stock_label_name = $labelName->title;
    //                     $item->quantity = $qty[$itemKey];
    //                     $item->price = $price[$itemKey];
    //                     $item->total_amount = $totalAmount[$itemKey];
    //                     $item->discount = $discount[$itemKey];
    //                     $item->final_amount = $finalAmount[$itemKey];
    //                     $item->save();
    //                 }
    //             }
    //         }



    //         JobCardExtraCharge::where('jobcard_id', $jobcard->id)->delete();

    //         if (isset($request->extraCharges)) {
    //             foreach ($request->extraCharges as $charge) {
    //                 $extraCharge = new JobCardExtraCharge;
    //                 $extraCharge->jobcard_id = $jobcard->id;
    //                 $extraCharge->label = $charge['label'];
    //                 $extraCharge->charges = $charge['charge'];
    //                 $extraCharge->charge_type = $charge['charge_type'];
    //                 $extraCharge->machanic_id = $charge['mechanic_id'];
    //                 $extraCharge->amount = $charge['amount'];
    //                 $extraCharge->gst_type = $charge['gst_type'];
    //                 $extraCharge->gst = $charge['gst_percentage'];
    //                 $extraCharge->save();
    //             }
    //         }


    //         if (count($decreaseStockId) > 0) {
    //             foreach ($decreaseStockId as $keyValue) {
    //                 $productStock = ProductStock::find($keyValue[0]);
    //                 $productStock->stock = $productStock->stock - $keyValue[1];
    //                 $productStock->save();
    //             }
    //         }

    //         if ($request->step == 1 || ($jobstatus == 1 && $request->status == 2)) {
    //             $SendJobCardPdfMail = new SendJobCardPdfMail();
    //             $SendJobCardPdfMail->jobcard_id = $jobcard->id;
    //             $SendJobCardPdfMail->template_type = $request->step == 1 ? 0 : 1;
    //             $SendJobCardPdfMail->save();
    //         }

    //         return response()->json([
    //         'status'=> true,
    //         'type' => 'success',
    //         'message' => 'Job-Card updated successfully!',
    //     ], 200);
    //     }
        
    //     return response()->json([
    //         'status'=> false,
    //         'type' => 'error',
    //         'message' => 'Details Not Found!',
    //     ], 200);
        
    // }
    
    // 16/6/25
    
    public function updateJobCard(Request $request)
{
    $validatedData = $request->validate([
        'job_card_id' => 'required',
        'status' => 'required|integer',
        'step' => 'nullable|integer',
        'final_discount' => 'nullable|numeric|min:0',
        'final_paid' => 'nullable|numeric|min:0',
        'balance_amount' => 'nullable|numeric|min:0',
        'totalAmount' => 'required|numeric|min:1',
        'final_amount' => 'required|numeric|min:1',
        'extraCharges.*.mechanic_id' => 'required|integer',
        'spareParts' => 'array',
        'lubes' => 'array',
        'accessoriess' => 'array',
    ]);

    $jobcard = JobCard::find($request->job_card_id);
    if (!$jobcard) {
        return response()->json([
            'status' => false,
            'type' => 'error',
            'message' => 'Job card not found!',
        ], 200);
    }

    $jobstatus = $jobcard->status;
    $user = Auth::guard('workshop_api')->user();

    // Merge arrays for spareParts, lubes, and accessories
    $items = array_merge(
        array_column($request->spareParts, 'id'),
        array_column($request->lubes, 'id'),
        array_column($request->accessoriess, 'id'),
    );
    $qty = array_merge(
        array_column($request->spareParts, 'quantity'),
        array_column($request->lubes, 'quantity'),
        array_column($request->accessoriess, 'quantity'),
    );
    $price = array_merge(
        array_column($request->spareParts, 'unit_price'),
        array_column($request->lubes, 'unit_price'),
        array_column($request->accessoriess, 'unit_price'),
    );
    $totalAmount = array_merge(
        array_column($request->spareParts, 'total_amount'),
        array_column($request->lubes, 'total_amount'),
        array_column($request->accessoriess, 'total_amount'),
    );
    $discount = array_merge(
        array_column($request->spareParts, 'discount'),
        array_column($request->lubes, 'discount'),
        array_column($request->accessoriess, 'discount'),
    );
    $finalAmount = array_merge(
        array_column($request->spareParts, 'final_amount'),
        array_column($request->lubes, 'final_amount'),
        array_column($request->accessoriess, 'final_amount'),
    );

    // If job status is changing from 1 to 2, check stock
    $error = false;
    $decreaseStockId = [];

    if ($jobstatus == 1 && $request->status == 2 && !empty($items)) {
        foreach ($items as $itemKey => $itemValue) {
            $stock = ProductStock::where(['label_id' => $itemValue, 'price' => $price[$itemKey], 'user_id' => $user->id])->first();

            if ($stock) {
                if ($stock->stock < $qty[$itemKey]) {
                    $error = true;
                } else {
                    $decreaseStockId[] = [$stock->id, $qty[$itemKey]];
                }
            } else {
                $error = true;
            }
        }
    }

    if ($error) {
        return response()->json([
            'type' => 'error',
            'message' => 'Stock is not available for this order. Add stock and try again.',
        ], 200);
    }

    // Only update fields submitted
    $jobcard->customer_id = $request->customer_name ?? $jobcard->customer_id;
    $jobcard->vehicle_id = $request->vehicle_id ?? $jobcard->vehicle_id;
    $jobcard->amount = $request->totalAmount;
    $jobcard->discount = array_sum($discount);
    $jobcard->final_amount = $request->final_amount;
    $jobcard->advance = $request->advance;
    $jobcard->balance_amount = $request->balance_amount;
    $jobcard->km_runing = $request->km_reading ?? $jobcard->km_runing;
    $jobcard->fual_level = $request->fual_level ?? $jobcard->fual_level;
    $jobcard->supervisor_id = $request->supervisor ?? $jobcard->supervisor_id;
    $jobcard->sms_alert = $request->smsAlert ?? $jobcard->sms_alert;
    $jobcard->delivery_date = $request->deliveryDate ?? $jobcard->delivery_date;
    $jobcard->delivery_time = $request->deliveryTime ?? $jobcard->delivery_time;
    $jobcard->payment_type = $request->payment_type ?? $jobcard->payment_type;
    $jobcard->transaction_number = $request->transaction_number ?? $jobcard->transaction_number;
    if ($request->status != 0) {
        $jobcard->status = $request->status;
    }
    if (!empty($request->step)) {
        $jobcard->step = $request->step;
    }
    $jobcard->save();

    // Save spare parts
    JobCardSparePart::where('jobcard_id', $jobcard->id)->delete();
    if (!empty($items)) {
        foreach ($items as $itemKey => $itemValue) {
            $labelName = SparePartLabel::select('title')->find($itemValue);
            $item = new JobCardSparePart;
            $item->jobcard_id = $jobcard->id;
            $item->stock_label_id = $itemValue;
            $item->stock_label_name = $labelName->title ?? '';
            $item->quantity = $qty[$itemKey];
            $item->price = $price[$itemKey];
            $item->total_amount = $totalAmount[$itemKey];
            $item->discount = $discount[$itemKey];
            $item->final_amount = $finalAmount[$itemKey];
            $item->save();
        }
    }

    // Save extra charges
    JobCardExtraCharge::where('jobcard_id', $jobcard->id)->delete();
    if (!empty($request->extraCharges)) {
        foreach ($request->extraCharges as $charge) {
            $extraCharge = new JobCardExtraCharge;
            $extraCharge->jobcard_id = $jobcard->id;
            $extraCharge->label = $charge['label'];
            $extraCharge->charges = $charge['charge'];
            $extraCharge->charge_type = $charge['charge_type'];
            $extraCharge->machanic_id = $charge['mechanic_id'];
            $extraCharge->amount = $charge['amount'];
            $extraCharge->gst_type = $charge['gst_type'];
            $extraCharge->gst = $charge['gst_percentage'];
            $extraCharge->save();
        }
    }

    // Update stock if needed
    if (count($decreaseStockId) > 0) {
        foreach ($decreaseStockId as $keyValue) {
            $productStock = ProductStock::find($keyValue[0]);
            $productStock->stock -= $keyValue[1];
            $productStock->save();
        }
    }

    // Send mail if needed
    if ($request->step == 1 || ($jobstatus == 1 && $request->status == 2)) {
        $SendJobCardPdfMail = new SendJobCardPdfMail();
        $SendJobCardPdfMail->jobcard_id = $jobcard->id;
        $SendJobCardPdfMail->template_type = $request->step == 1 ? 0 : 1;
        $SendJobCardPdfMail->save();
    }

    return response()->json([
        'status' => true,
        'type' => 'success',
        'message' => 'Job-Card updated successfully!',
    ], 200);
}

    
    
    
    
    
    
    
    public function confirmJobCard(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'job_card_id' => 'required',
        ]);
    
        
        $jobcard = Jobcard::where('id',$request->job_card_id)->first();
        $jobcard->status = 1;
        $jobcard->save();


        return response()->json([
            'status' => true,
            'message' => 'Job-Card Confirmed Succesfully!'
        ], 200);
    }
      public function noteUpdate(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'job_card_id' => 'required',
            'notes'=>'required'
        ]);
    
        
        $jobcard = Jobcard::where('id',$request->job_card_id)->first();
        $jobcard->notes = $request->notes;
        $jobcard->save();


        return response()->json([
            'status' => true,
            'message' => 'Note update successfully!'
        ], 200);
    }
    
    public function sendInvoiceMail(Request $request)
    {

    $validator = Validator::make($request->all(), [
                'job_card_id' => 'required',
            ]);
            
            $id = $request->job_card_id;
     $user = Auth::guard('workshop_api')->user();
    
        $newjobcard = JobCard::with(['exitNote' => function ($query) {
            $query->select('note', 'job_card_id');
        }])->where('id', $id)->first();

        if (!empty($newjobcard)) {
            if ($newjobcard->status == 2 || $newjobcard->status == 3) {

                $customer = Customer::select('id', 'name', 'lastname', 'mobile_no', 'email', 'address')->where('id', $newjobcard->customer_id)->first();
                $vehicles = Vehicle::select('number_plate', 'chassisno', 'modelname', 'vehiclebrand_id')->where('id', $newjobcard->vehicle_id)->first();
                $jobCardSpareParts = JobCardSparePart::where('jobcard_id', $id)->get();
                $jobCardExtraCharges = JobCardExtraCharge::where('jobcard_id', $id)->get();

                $inspections = JobCardsInspection::select('customer_voice', 'is_customer_voice')->where('jobcard_number', $newjobcard->jobcard_number)->whereIn('is_customer_voice', [1, 0])->get();
                $jobCardCustomerVoice = $inspections->where('is_customer_voice', 1);
                $jobCardAccessories = $inspections->where('is_customer_voice', 0);

                $exitNote = $newjobcard->exitNote;

                $title = 'View Invoice';
                $logo = WorkShopVendor::where('id', $user->id)->first();


                $data = compact('title', 'logo', 'customer', 'newjobcard', 'vehicles', 'jobCardSpareParts', 'jobCardExtraCharges', 'jobCardCustomerVoice', 'jobCardAccessories', 'exitNote');

                Mail::to($customer->email)->send(new InvoiceMail($data));

                 return response()->json([
                    'status'=>true,
                    'message' => "The invoice has been sent to the customer's mail successfully!",
                ], 200);
            } else {

                $customer = Customer::where('id', $newjobcard->customer_id)->first();
                $vehicles = Vehicle::where('id', $newjobcard->vehicle_id)->first();
                $jobCardSpareParts = JobCardSparePart::where('jobcard_id', $id)->get();

                $jobCardExtraCharges = JobCardExtraCharge::where('jobcard_id', $id)->get();
                $jobCardCustomerVoice = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 1)->get();
                $jobCardAccessories = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 2)->get();

                $title = 'View Invoice';
                $logo = WorkShopVendor::where('id', $user->id)->first();


                $data = compact('title', 'logo', 'customer', 'newjobcard', 'vehicles', 'jobCardSpareParts', 'jobCardExtraCharges', 'jobCardCustomerVoice', 'jobCardAccessories');

                Mail::to($customer->email)->send(new EstimateMail($data));

                return response()->json([
                    'status'=>true,
                    'message' => "The estimate has been sent to the customer's mail successfully!",
                ], 200);

            }
        }

            return response()->json([
                    'status'=>false,
                    'message' => "Something wrong found! Please try again.",
                ], 200);
    }
    
    public function storeStock(Request $request){
        
        
       
           $validatedData = $request->validate([
             'rows.*.category' => ["required"],
            'rows.*.stock_item' => ["required"],
            'rows.*.price_stock' => ["required", "numeric", "min:1"],
            'rows.*.quantity_stock' => ["required", "integer", "min:1"],
            'rows.*.buy_price_stock' => ["required", "numeric", "min:1"],
        ]);
        
         $user = Auth::guard('workshop_api')->user();
        
         foreach ($request->rows as $row) {
            $sparePartLabel = SparePartLabel::firstOrCreate(
                [
                    'title' => $row['stock_item'],
                    'spare_part_type' => $row['category']
                ]
            );
            
            $productStock = ProductStock::where([
                'user_id' => $user->id,
                'label_id' => $sparePartLabel->id,
                'price' => $row['price_stock'],
                'category_id' => $row['category']
            ])->first();


            if ($productStock) {
                $productStock->stock += $row['quantity_stock'];
                $productStock->save();
            } else {
                $productStock = new ProductStock;
                $productStock->user_id = $user->id;
                $productStock->label_id = $sparePartLabel->id;
                $productStock->category_id = $row['category'];
                $productStock->buy_price = $row['buy_price_stock'];
                $productStock->price = $row['price_stock'];
                $productStock->stock = $row['quantity_stock'];
                $productStock->save();
            }

            $data = [
                'id' => $sparePartLabel->id,
                'part_name' => $sparePartLabel->title . ' (Current Stock: ' . $row['quantity_stock'] . ')',
                'quantity' => 1,
                'unit_price' => $row['price_stock'],
                'total_amount' => $row['price_stock'] * 1,
                'discount' => 0,
                'final_amount' => $row['price_stock'] * 1,
            ];


            switch ($row['category']) {
                case 2:
                    $this->spareParts[] = $data;
                    break;
                case 4:
                    $this->lubes[] = $data;
                    break;
                case 1:
                    $this->accessoriess[] = $data;
                    break;
                default:
                    break;
            }

            $dataList = [
                'label_id' => $productStock->label_id,
                'label_name' => @$productStock->label->title,
                'cat_type' => $productStock->category_id,
                'product_stock_id' => @$productStock->id,
                'stock' => @$productStock->stock,
                'price' => @$productStock->price,
            ];

            switch ($productStock->category_id) {
                case 1:
                    $this->accessory[] = $dataList;
                    break;
                case 2:
                    $this->spare[] = $dataList;
                    break;
                case 3:
                    $this->tool[] = $dataList;
                    break;
                case 4:
                    $this->lube[] = $dataList;
                    break;
                
                default:
                    break;
            }

        }
        
        
        return response()->json([
            'status' => true,
            'message' => 'Stock Updated Successfully!'
        ], 200);
        
      }
      
    public function storePurchase(Request $request)
    {
        $validatedData = $request->validate([
            'totalPricePurchase'=>'required',
             'rows.*.category' => ["required"],
            'rows.*.quantity_purchase' => ["required"],
            'rows.*.price_purchase' => ["required", "numeric", "min:1"],
            'rows.*.total_price_purchase' => ["required", "integer", "min:1"],
        ]);
        
         $user = Auth::guard('workshop_api')->user();
         
        $order = new Order;
        $order->order_date = now();
        $order->total_amount = $request->totalPricePurchase;
        $order->total_quantity = array_sum(array_column($request->rows, 'quantity_purchase'));
        $order->total_item = count($request->rows);
        $order->workshop_id= $user->id;
        $order->payment_id = 1;
        $order->payment_status = 0;
        $order->save();
        $mergedData = [];
        foreach ($request->rows as $row) {
            $userId = SparePart::where('id', $row['item'])->value('user_id');

            $orderItem = new OrderItem;
            $orderItem->spare_part_id = $row['item'];
            $orderItem->user_id = $userId;
            $orderItem->quantity = $row['quantity_purchase'];
            $orderItem->price = $row['price_purchase'];
            $orderItem->total_amount = $row['total_price_purchase'];
            $orderItem->category = $row['category'];
            $orderItem->order_id = $order->id;
            $order->payment_status = 0;
            $orderItem->save();

            $items_purchase = SparePart::where('id', $row['item'])->first();

            $data = [
                'id' => $items_purchase->label_id,
                'part_name' => $items_purchase->label->title . ' (Current Stock: ' . $row['quantity_purchase'] . ')',
                'quantity' => 1,
                'unit_price' => $row['price_purchase'],
                'total_amount' => $row['price_purchase'] * 1,
                'discount' => 0,
                'final_amount' => $row['price_purchase'] * 1,
            ];


            switch ($row['category']) {
                case 2:
                    $this->spareParts[] = $data;
                    break;
                case 4:
                    $this->lubes[] = $data;
                    break;
                case 1:
                    $this->accessoriess[] = $data;
                    break;
                default:
                    break;
            }

        }
        
         return response()->json([
            'status' => true,
            'message' => 'Purchase Order submitted successfully!'
        ], 200);

    }

 

}
