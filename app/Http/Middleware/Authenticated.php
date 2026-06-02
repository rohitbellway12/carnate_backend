<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards): Response
    {

        // if ($this->isAdminRoute($request) && !Auth::guard('admin')->check()) {
        //     return redirect('/admin/login');
        // }
        // if ($this->isWorkshopRoute($request) && !Auth::guard('workshop')->check()) {
        //     return redirect('/workshop/login');
        // }
        // if ($this->isSparepartRoute($request) && !Auth::guard('sparepart')->check()) {
        //     return redirect('/sparepart/login');
        // }
      

        // if (!Auth::guard('web')->check() && !$this->isAdminRoute($request) && !$this->isWorkshopRoute($request) && !$this->isSparepartRoute($request)) {
        //     return redirect('/login');
        // }

        if (!Auth::guard('workshop_api')->check() ) {
            // return response()->json(['message' => 'Unauthorized access'], 401);
            return response()->json([
                "status" => 401, 
                "message" => "Unauthenticated",
            ]);
        }

        return $next($request);
    }


    /**
     * Check if the request is for admin routes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    // private function isAdminRoute(Request $request): bool
    // {
    //     return $request->is('admin') || $request->is('admin/*');
    // }

    // private function isWorkshopRoute(Request $request): bool
    // {
    //     return $request->is('workshop') || $request->is('workshop/*');
    // }

    /**
     * Check if the request is for vendor routes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
   

    // private function isSparepartRoute(Request $request): bool
    // {
    //     return $request->is('sparepart') || $request->is('sparepart/*');
    // }

}
