<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }

    public function create()
    {
        $now = Carbon::now();
        $recent = $now->copy()->subDays(3);
    
        $user = Auth::user(); // Get the logged-in user
        $student = $user->student; // Assuming relation user -> student exists
    
        // Extract batch prefix from student id, e.g. '20' from '20319'
        $batchYear = null;
        if ($student && !empty($student->id)) {
            $batchYear = substr($student->id, 0, 2);
        }
    
        $notifications = Notification::where(function ($query) use ($now, $recent) {
                $query->where(function ($q) use ($now) {
                    $q->where('is_important', true)
                      ->where(function ($sub) use ($now) {
                          $sub->whereNull('expires_at')
                              ->orWhere('expires_at', '>', $now);
                      });
                })->orWhere(function ($q) use ($recent) {
                    $q->where('is_important', false)
                      ->where('created_at', '>=', $recent);
                });
            })
            ->where(function ($q) use ($user) {
                $q->whereNull('user_id') // broadcast to role
                  ->orWhere('user_id', $user->id); // personal
            })
            ->where(function ($q) {
                $q->where('target_audience', 'students')
                  ->orWhere('target_audience', 'both')
                  ->orWhereNull('target_audience'); // personal messages might not have target_audience
            })
            ->when($batchYear, function ($q) use ($batchYear) {
                $q->where(function ($sub) use ($batchYear) {
                    $sub->whereNull('student_year')
                        ->orWhere('student_year', $batchYear);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('dashboard.create', compact('notifications'));
    }
    
    
}
