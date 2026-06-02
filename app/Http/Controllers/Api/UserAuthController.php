<?php

namespace App\Http\Controllers\Api;

use App\Models\WorkShopVendor;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Validator;
use DB;

class UserAuthController extends BaseController
{

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:work_shop_vendor,mobile_no',
            'email' => 'required|unique:users,email',
            'birth_date' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0]; // Only return the first error
            });
            return $this->sendResponse(null,'Validation Error.', $errors ,200,false);
        }

        $otp = rand(1000, 9999);

        $user = new WorkShopVendor();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->gender = $request->gender;
        $user->birth_date = $request->birth_date;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile_no = $request->mobile;
        $user->address = $request->address;
        $user->country_id = $request->country_id;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->otp = $otp;
        $user->otp_expiry =Carbon::now()->addMinutes(10);
        $user->save();

        // $this->sendOtp($user->mobile_no, $otp);

        return $this->sendResponse(['otp'=>$otp], 'User created successfully. Please verify OTP.', null ,200);
    }



    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'otp' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0]; // Only return the first error
            });
            return $this->sendResponse(null,'Validation Error.', $errors ,200,false);
        }

        $user = WorkShopVendor::where('mobile_no', $request->mobile)->where('otp', $request->otp)->first();

        // echo "<pre>";print_r($user);die;
        if (!$user) {
            return $this->sendResponse(null,'Validation Error.',['otp'=>'Invalid OTP or mobile number.'] ,200,false);
        }

        if (Carbon::now()->gt($user->otp_expiry)) {
            return $this->sendResponse(null,'Validation Error.',['otp'=>'OTP expired.'] ,200,false);
        }

        $user->otp = null;
        $user->otp_expiry = null;
        $user->save();

        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['user'] =  $user;
        return $this->sendResponse($success,'User login successfully.',null ,200);
    }

    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|exists:work_shop_vendor,mobile_no',
        ]);

          if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0]; // Only return the first error
            });
            return $this->sendResponse(null,'Validation Error.', $errors ,200,false);
        }

        $user = WorkShopVendor::where('mobile_no', $request->mobile)->first();
        $otp = rand(1000, 9999);

        $user->otp = $otp;
        $user->otp_expiry = Carbon::now()->addMinutes(10);
        $user->save();

        // Send OTP to user via SMS (implement your own method)
        // $this->sendOtp($user->mobile, $otp);

        return $this->sendResponse(['otp' => $otp],'OTP sent successfully.',null ,200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0]; // Only return the first error
            });
            return $this->sendResponse(null,'Validation Error.', $errors ,200,false);
        }

        // Attempt to find the user with the provided mobile number
        $user = WorkShopVendor::where('mobile_no', $request->mobile)->where('otp',$request->otp)->first();

        // Check if user exists and password matches
        if (!$user) {
            return $this->sendResponse(null,'Validation Error.', ['error'=>'Invalid mobile or otp.'] ,200,false);
        }

        $user->tokens()->delete();
       
        $success['token'] = $usertoken =  $user->createToken('MyApp')->plainTextToken;
        $success['user'] =  $user;

        $user->remember_token =  $usertoken;
        $user->save();

        return $this->sendResponse($success,'User login successfully.', null ,200);
    }

    // public function updateProfile(Request $request)
    // {
    //     $userA = $request->user();
    //     // $userA = Auth::guard('workshop_api')->user(); 

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'lastname' => 'required|string',
    //         'mobile' => 'sometimes|string|max:15|unique:work_shop_vendor,mobile_no,' . $userA->id,
    //         'email' => 'sometimes|email|unique:users,email,' . $userA->id,
    //         'birth_date' => 'required',
    //         'address' => 'required',
    //         'gender' => 'required',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     if ($validator->fails()) {
    //         $errors = collect($validator->errors())->map(function ($error) {
    //             return $error[0]; // Only return the first error
    //         });
    //         return $this->sendResponse(null,'Validation Error.', $errors ,200,false);
    //     }

    //     $user = WorkShopVendor::where('id', $userA->id)->first();

    //     if ($request->filled('current_password')) {
    //         if (!Hash::check($request->current_password, $user->password)) {
    //             throw ValidationException::withMessages([
    //                 'current_password' => ['The current password is incorrect.'],
    //             ]);
    //         }

    //         $user->password = Hash::make($request->password);
    //     }



    //     if ($request->filled('name')) {
    //         $user->name = $request->name;
    //     }

    //     if ($request->filled('lastname')) {
    //         $user->lastname = $request->lastname;
    //     }

    //     if ($request->filled('gender')) {
    //         $user->gender = $request->gender;
    //     }

    //      if ($request->filled('birth_date')) {
    //         $user->birth_date = $request->birth_date;
    //     }

    //     if ($request->filled('email')) {
    //         $user->email = $request->email;
    //     }

    //     if ($request->filled('mobile')) {
    //         $user->mobile_no = $request->mobile;
    //     }

    //     if ($request->filled('address')) {
    //         $user->address = $request->address;
    //     }

    //     if ($request->filled('country_id')) {
    //         $user->country_id = $request->country_id;
    //     }

    //     if ($request->filled('state_id')) {
    //         $user->state_id = $request->state_id;
    //     }

    //     if ($request->filled('city_id')) {
    //         $user->city_id = $request->city_id;
    //     }

    //     $user->save();


    //     return $this->sendResponse($user,'Profile updated successfully.', null ,200);
    // }

   
   //12/06/25
public function updateProfile(Request $request, $id)
{
    $vendor = WorkshopVendor::find($id);

    if (!$vendor) {
        return response()->json(['status' => false, 'message' => 'Vendor not found'], 404);
    }

    // Validation rules (only validate if fields are present)
    $rules = [
        'name' => 'string|max:255',
        'lastname' => 'string|max:255',
        'email' => 'email',
        'mobile_no' => 'string|max:15',
        'birth_date' => 'date',
        'landline_no' => 'string|max:20',
        'branch_name' => 'string|max:255',
        'branch_email' => 'email',
        'branch_number' => 'string|max:20',
        'gst' => 'string|max:20',
        'branch_logo' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        'branch_sign_logo' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        'tagline' => 'string',
        'address' => 'string',
        'country_id' => 'integer',
        'state_id' => 'integer',
        'city_id' => 'integer',
        'pincode' => 'string|max:10',
    ];

    // Filter only present fields
    $validFields = [];
    foreach ($rules as $key => $rule) {
        if ($request->has($key) || $request->hasFile($key)) {
            $validFields[$key] = $rule;
        }
    }

    $validator = Validator::make($request->all(), $validFields);
    if ($validator->fails()) {
        return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    // Upload branch_logo
    if ($request->hasFile('branch_logo')) {
        $file = $request->file('branch_logo');
        $filename = uniqid() . '_branch_logo.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $vendor->branch_logo = $filename;
    }

    // Upload branch_sign_logo
    if ($request->hasFile('branch_sign_logo')) {
        $file = $request->file('branch_sign_logo');
        $filename = uniqid() . '_branch_sign_logo.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $vendor->branch_sign_logo = $filename;
    }

    // Update all other fields
    foreach ($validFields as $key => $rule) {
        if (!in_array($key, ['branch_logo', 'branch_sign_logo']) && $request->has($key)) {
            $vendor->$key = $request->$key;
        }
    }

    $vendor->save();

    // Prepare full URLs for return
    $vendor->branch_logo = $vendor->branch_logo ? asset('uploads/' . $vendor->branch_logo) : null;
    $vendor->branch_sign_logo = $vendor->branch_sign_logo ? asset('uploads/' . $vendor->branch_sign_logo) : null;

    return response()->json([
        'status' => true,
        'message' => 'Vendor updated successfully',
        'data' => $vendor
    ]);
}





    private function sendOtp($mobileNumber, $otp)
    {

        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $twilio->messages->create($mobileNumber, [
            'from' => env('TWILIO_FROM'),
            'body' => "Dear Your OTP is $otp for login in Drop us. This OTP is valid for next 10 minutes.\nDropus Team"
        ]);
    }




    public function countries()
    {
        $success['countries'] = DB::table('countries')->get();
        return $this->sendResponse($success, 'Contries show successfully.');

    }



    public function state(Request $request)
    {
        $success['state'] = DB::table('states')->where('country_id',$request->country_id)->get();
        return $this->sendResponse($success, 'State show successfully.');

    }

    public function cities(Request $request)
    {
        $success['cities'] = DB::table('cities')->where('state_id',$request->state_id)->get();
        return $this->sendResponse($success, 'Cities show successfully.');

    }
    
        public function staffLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors())->map(function ($error) {
                return $error[0]; // Only return the first error
            });
            return $this->sendResponse(null, 'Validation Error.', $errors, 200, false);
        }

        $user = WorkShopVendor::where('email', $request->email)->where('is_user',1)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $user->tokens()->delete();

            $success['token'] = $usertoken =  $user->createToken('MyApp')->plainTextToken;
            $success['user'] =  $user;

            $user->remember_token =  $usertoken;
            $user->save();
            return $this->sendResponse($success, 'User login successfully.', null, 200);
        } else {
            return $this->sendResponse(null, 'Validation Error.', ['error' => 'Invalid Password or User Name.'], 200, false);
        }
    }
    
}