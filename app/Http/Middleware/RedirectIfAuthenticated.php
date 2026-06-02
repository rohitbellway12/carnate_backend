<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (($request->is('admin') || $request->is('admin/*')) && Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');       }

        
        if (Auth::guard('web')->check() && !$this->isAdminOrErpRoute($request)) {
            return redirect('/dashboard');
        }
        if (($request->is('workshop') || $request->is('workshop/*')) && Auth::guard('workshop')->check()) {
            return redirect('/workshop/dashboard');
        } 
        if (($request->is('sparepart') || $request->is('sparepart/*')) && Auth::guard('sparepart')->check()) {
            return redirect('/sparepart/dashboard');
        }
        
        // Add vendor routes check for unified login
        if (($request->is('vendor') || $request->is('vendor/*')) && (Auth::guard('workshop')->check() || Auth::guard('sparepart')->check())) {
            if (Auth::guard('workshop')->check()) {
                return redirect('/workshop/dashboard');
            }
            if (Auth::guard('sparepart')->check()) {
                return redirect('/sparepart/dashboard');
            }
        }

        return $next($request);
    }

     /**
     * Check if the request is for admin or vendor routes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function isAdminOrErpRoute(Request $request): bool
    {
        return $request->is('admin/*') || $request->is('workshop/*') || $request->is('sparepart/*') || $request->is('vendor/*') || $request->is('admin') || $request->is('workshop') || $request->is('sparepart') || $request->is('vendor');
    }
}
