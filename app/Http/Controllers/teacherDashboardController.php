<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Carbon\Carbon;

class teacherDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkTeacherRole');
    }

    public function create()
    {
        $now = Carbon::now();
        $recent = $now->copy()->subDays(3);
        $userId = auth()->id();
    
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
        ->where(function ($q) use ($userId) {
            $q->whereIn('target_audience', ['teachers', 'both'])
              ->orWhere('user_id', $userId); // ✅ Personal notifications
        })
        ->latest()
        ->get();
    
        return view('teacherdashboard.create', compact('notifications'));
    }
    
}
