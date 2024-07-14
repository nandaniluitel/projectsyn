<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();

            if ($user->teacher) {
                $teacher = $user->teacher;

                if ($teacher->coordinator()->exists() || $teacher->supervisors()->exists() || $teacher->evaluator()->exists()) {
                    return redirect()->route('teacherdashboard.create');
                } else {
                    return redirect()->route('dashboard.create');
                }
            }

            return redirect()->route('dashboard.create');
        }

        return $next($request);
    }
}
