<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()) {
            if (auth()->user()->is_ban == true) {
                auth()->logout();

                return redirect()->route('login');
            } else {
                return $next($request);
            }
        }
    }
}
