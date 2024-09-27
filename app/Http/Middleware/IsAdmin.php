<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the logged-in user is an admin
        if (Auth::check() && Auth::user()->role->slug == 'admin') {
            return $next($request);
        }

        // Redirect non-admin users to dashboard or show 403 forbidden
        return redirect()->route('dashboard')->with('error', 'Access Denied.');
    }
}