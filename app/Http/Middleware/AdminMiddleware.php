<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $role = auth()->user()->role;
        if (!is_string($role) || strtolower($role) !== 'admin') {
            // Redirect mengikuti role agar UX tetap rapi
            if (is_string($role) && strtolower($role) === 'user') {
                return redirect()->route('dashboard');
            }

            return abort(403);
        }




        return $next($request);
    }
}
