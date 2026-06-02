<?php
namespace App\Http\Middleware;

use App\Models\User;
use App\Models\WorkShopVendor;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class WorkshopMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('workshop')->user();

        if (!Auth::guard('workshop')->check()) {
            return redirect()->route('unified.login');
        }


        if ($user->is_user == 0) {

            if ($user->profile_update === 0 && $request->route()->getName() !== 'workshop.profile') {
                session()->flash('error', 'Please update your profile to continue.');
                return redirect()->route('workshop.profile');
            }

            $currentDate = now()->format('Y-m-d');

            if ($user->is_subscribe === 0) {
                if ($user->is_trial == 0 && $user->trial_start_date === null && $user->subscription_end_date === null && $request->route()->getName() !== 'workshop.plan') {
                    session()->flash('error', 'Please purchase a plan to continue.');
                    return redirect()->route('workshop.plan');
                } else {
                    $trialExpired = false;
                    $trialEndDate = now()->addDays((int)$user->trial_days ?? 0)->format('Y-m-d');
                    $trialExpired = ($user->is_trial === 1 && ($trialEndDate < $currentDate)) ? true : false;
                    
                    // dd($trialExpired);
                    $subscriptionExpired = $user->subscription_end_date === null || $user->subscription_end_date < $currentDate;

                    if (($trialExpired && $subscriptionExpired) && $request->route()->getName() !== 'workshop.plan') {
                        session()->flash('error', 'Please purchase a plan to continue.');
                        return redirect()->route('workshop.plan');
                    }
                }

            } else {
                if ($user->subscription_end_date < $currentDate && $request->route()->getName() !== 'workshop.plan') {
                    session()->flash('error', 'You need to manage your plan.');
                    return redirect()->route('workshop.plan');
                }
            }
        }



        return $next($request);
    }

}
