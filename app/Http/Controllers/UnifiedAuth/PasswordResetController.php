<?php

namespace App\Http\Controllers\UnifiedAuth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetLinkMail;
use App\Mail\PasswordResetSuccessMail;
use App\Models\WorkShopVendor;
use App\Models\SparePartVendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.unified-forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check email across vendor tables (workshop and sparepart)
        $user = WorkShopVendor::where('email', $request->email)->first()
            ?: SparePartVendor::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        $token = (string) Str::uuid();
        $expiresAt = Carbon::now()->addMinutes(30);

        DB::table('password_resets')->where('email', $request->email)->delete();
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'expires_at' => $expiresAt,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Generate unified vendor reset URL
        $resetUrl = route('unified.password.reset', ['token' => $token]);
        Mail::to($request->email)->send(new PasswordResetLinkMail($resetUrl));

        return back()->with('status', 'We have emailed your password reset link.');
    }

    public function showResetForm(Request $request)
    {
        $token = $request->query('token');
        if (!$token) {
            abort(404);
        }

        $record = DB::table('password_resets')
            ->where('token', $token)
            ->first();

        if (!$record || ($record->expires_at && Carbon::parse($record->expires_at)->isPast()) || $record->used_at) {
            return view('auth.unified-reset-password-invalid');
        }

        return view('auth.unified-reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $record = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->withErrors(['token' => 'Invalid token.']);
        }

        if ($record->used_at) {
            return back()->withErrors(['token' => 'This token has already been used.']);
        }

        if (Carbon::parse($record->expires_at)->isPast()) {
            return back()->withErrors(['token' => 'This token has expired.']);
        }

        // Update password in vendor accounts
        $user = WorkShopVendor::where('email', $record->email)->first()
            ?: SparePartVendor::where('email', $record->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User account no longer exists.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Invalidate token
        DB::table('password_resets')
            ->where('token', $request->token)
            ->update(['used_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        // Send confirmation email
        Mail::to($user->email)->send(new PasswordResetSuccessMail());

        return redirect()->route('unified.login')->with('success', 'Your password has been reset successfully.');
    }
}


