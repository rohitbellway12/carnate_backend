<?php

namespace App\Http\Controllers\Api;

use App\Models\WorkShopVendor;
use Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use Spatie\Permission\Models\Role;

class AuthController extends BaseController
{

    
    public function register(Request $request)
    { 
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email', // Use admins table
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json(['message' => 'Admin created successfully'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // $admin = Admin::where('email', $credentials)->first();

        if (Auth::guard('workshop')->attempt($credentials)) {
            $user = Auth::guard('workshop')->user();
            $token = $user->createToken('MyApp')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        }

    }

    public function logout(Request $request)
    { //echo "<pre>";print_r($request->user()->currentAccessToken()->toArray());die;
        Auth::guard('workshop_api')->user()->currentAccessToken()->delete();
        // return response()->json(['message' => 'Logged out successfully'], 200);
        return response()->json([
            "status" => true,
            "message" => "Logged out successfully",
        ]);
    }

    public function userInfo(Request $request)
    { 
        $user = Auth::guard('workshop_api')->user();
    //    echo "<pre>";print_r($user);die;
        if (empty($user)) {
            return response()->json(['status'=>false,'status_code'=>401, 'message' => 'User not authenticated'], 401);
        }
        
        $permissions = [];
        if($user->user_type != 0){
            $role = Role::findOrFail($user->user_type); 
            $permissions = $role->permissions->pluck('name')->toArray();
            $user['type']= $user->Role->name ?? 'NA';
        }
        
        return response()->json([
            "status" => true,
            "message" => "User Information Show successfully",
            "data" => $user,
            "permissions"=>$permissions,
        ],200);
        // return response()->json(['user' => $user], 200);
    }
}
