<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UnifiedGuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is authenticated in either workshop or sparepart guard, redirect appropriately
        if (Auth::guard('workshop')->check()) {
            return redirect('/workshop/dashboard');
        }
        
        if (Auth::guard('sparepart')->check()) {
            return redirect('/sparepart/dashboard');
        }

        return $next($request);
    }
} 