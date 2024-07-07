<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CoordinatorMiddleware
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
        if (!$request->user() || !$request->user()->teacher || !$request->user()->teacher->coordinator) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
