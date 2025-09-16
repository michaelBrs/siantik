<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureLoginSession
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() &&
            auth()->user()->two_factor_secret &&
            !session()->has('login.id')) {

            session()->put('login.id', auth()->id());
        }

        return $next($request);
    }
}