<?php
namespace App\Http\Middleware;

use App\Models\User;
use App\Models\WorkShopVendor;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class profileCheck
{
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('sparepart')->user();

        if (!Auth::guard('sparepart')->check()) {
            return redirect()->route('unified.login');
        }

        if ($user->profile_update === 0 && $request->route()->getName() !== 'sparepart.profile') {
            session()->flash('error', 'Please update your profile to continue.');
            return redirect()->route('sparepart.profile');
        }

        return $next($request);
    }

}
