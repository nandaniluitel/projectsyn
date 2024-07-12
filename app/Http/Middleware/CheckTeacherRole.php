<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTeacherRole
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->teacher->isNotEmpty()) {
            $teacher = $user->teacher->first();

            if ($teacher->coordinator || $teacher->supervisor || $teacher->evaluator) {
                return $next($request);
            }
        }

        // User is not authorized
        abort(403, 'Unauthorized action.');
    }
}
