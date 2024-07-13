<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log; // Add this import

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
{
    $user = auth()->user();

    if ($user->teacher) {
        // If the user is a teacher, check specific roles
        $teacher = $user->teacher;

        if ($teacher->coordinator()->exists() || $teacher->supervisor()->exists() || $teacher->evaluator()->exists()) {
            return route('teacherdashboard.create'); // Redirect coordinator, supervisor, and evaluator
        } else {
            return route('dashboard.create'); // Default redirect for other teachers
        }
    }

    // Default redirection for students or users without a teacher record
    return route('dashboard.create');
}


    /**
     * The path to redirect after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Send the failed login response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
