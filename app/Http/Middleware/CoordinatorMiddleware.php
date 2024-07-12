<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        if ($user && $user->teacher->isNotEmpty()) {
            // Access the first teacher in the collection (assuming only one teacher per user)
            $teacher = $user->teacher->first();
    
            // Check if the teacher is a coordinator
            if ($teacher->coordinator()->exists()) {
                // User is a coordinator, allow the request to proceed
                // dd( $next($request));
                return $next($request);
            }
        }

        // User is not a coordinator, abort with 403
        abort(403, 'Unauthorized action.');
    }
}
