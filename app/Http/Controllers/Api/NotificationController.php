<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:work_shop_vendor,id',
        'title' => 'required|string',
        'message' => 'nullable|string',
    ]);

    $notification = Notification::create([
        'user_id' => $request->user_id,
        'title' => $request->title,
        'message' => $request->message,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Notification sent successfully',
        'data' => $notification
    ]);
}

public function getNotifications($userId)
{
    $notifications = Notification::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

    return response()->json([
        'status' => true,
        'data' => $notifications
    ]);
}
public function markAsRead($id)
{
    $notification = Notification::findOrFail($id);
    $notification->is_read = true;
    $notification->save();

    return response()->json([
        'status' => true,
        'message' => 'Notification marked as read'
    ]);
}

}
