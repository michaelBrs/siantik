<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfPasswordNotChanged
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
        if (
            auth()->check() &&
            !auth()->user()->is_password_changed &&
            !$request->routeIs('password.edit') &&
            !$request->routeIs('password.update')
        ) {
            // Kalau request AJAX/JSON, balas 409 agar frontend bisa handle
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Password harus diganti sebelum melanjutkan.'
                ], 409);
            }

            return redirect()->route('password.edit');
        }
    
        return $next($request);
    }
}
