<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StudentMiddleware
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
    \Log::info('Checking if user is a student', ['user' => $request->user()]);
    if (!$request->user() || !$request->user()->student()->exists()) {
        \Log::warning('User is not a student', ['user' => $request->user()]);
        abort(403, 'Unauthorized action.');
    }
    return $next($request);
}

}
