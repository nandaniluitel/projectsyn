<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTeacherRole
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->teacher) {
            $teacher = $user->teacher;

            // Check if the teacher has any roles
            if ($teacher->coordinator || $teacher->supervisors()->exists() || $teacher->evaluators()->exists()) {
                return $next($request);
            }
        }

        // User is not authorized
        abort(403, 'Unauthorized action.');
    }
}
