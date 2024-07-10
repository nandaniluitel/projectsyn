<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EvaluatorMiddleware
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
        $user = Auth::user();

        if ($user && $user->teacher && $user->teacher->evaluator) {
            // User is a supervisor, allow the request to proceed
            return $next($request);
        }
         // User is not a supervisor, abort with 403
         abort(403, 'Unauthorized action.');
    }
}
