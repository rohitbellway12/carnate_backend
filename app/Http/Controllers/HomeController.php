<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use App\Models\Admin;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getWorkshopNotifications()
{
    try {
        $user = auth()->guard('workshop')->user();
        
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
        
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json([
            'status' => true,
            'data' => $notifications
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
public function getSparePartNotifications()
{
    try {
        $user = auth()->guard('sparepart')->user();
        
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
        
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json([
            'status' => true,
            'data' => $notifications
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
    /**
     * Return notifications for admin users (guard: admin).
     */
   public function getAdminNotifications()
{
    try {

        $adminIds = Admin::where('role_type', 21)->pluck('id');

        $notifications = Notification::whereIn('user_id', $adminIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data'   => $notifications,
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status'  => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}

   
public function markNotificationAsRead($id)
{
    try {
        $user = auth()->guard('workshop')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $notification = Notification::where('id', $id)->where('user_id', $user->id)->first();
        if ($notification) {
            $notification->is_read = true;
            $notification->save();
            return response()->json([
                'status' => true,
                'message' => 'Notification marked as read'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Notification not found'
        ], 404);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

public function markSparePartNotificationAsRead($id)
{
    try {
        $user = auth()->guard('sparepart')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $notification = Notification::where('id', $id)->where('user_id', $user->id)->first();
        if ($notification) {
            $notification->is_read = true;
            $notification->save();
            return response()->json([
                'status' => true,
                'message' => 'Notification marked as read'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Notification not found'
        ], 404);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

    public function markAdminNotificationAsRead($id)
    {
        try {
            $adminIds = Admin::where('role_type', 21)->pluck('id');

            $notification = Notification::where('id', $id)
                ->whereIn('user_id', $adminIds)
                ->first();

            if ($notification) {
                $notification->is_read = true;
                $notification->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Notification marked as read'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Notification not found'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

