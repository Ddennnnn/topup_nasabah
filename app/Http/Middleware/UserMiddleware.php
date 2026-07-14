<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== 'user') {
            // Redirect mengikuti role agar UX tetap rapi
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return abort(403);
        }




        return $next($request);
    }
}

