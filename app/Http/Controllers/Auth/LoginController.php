<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        $user = auth()->user();

        if ($user->teacher) {
            $teacher = $user->teacher;

            if ($teacher->coordinator()->exists() || $teacher->supervisors()->exists() || $teacher->evaluator()->exists()) {
                return route('teacherdashboard.create'); // Redirect coordinator, supervisor, and evaluator
            } else {
                return route('dashboard.create'); // Default redirect for other teachers
            }
        }

        // Default redirection for students or users without a teacher record
        return route('dashboard.create');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request)
    {
        Log::info('Login failed', ['email' => $request->email]);
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => [trans('auth.failed')],
            ]);
    }
}
