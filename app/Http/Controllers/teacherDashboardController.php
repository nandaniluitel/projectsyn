<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification; // Import Notification model

class teacherDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkTeacherRole');
     }
    public function create()
    {
        $notifications = Notification::all(); // Fetch notifications 
        return view('teacherdashboard.create', compact('notifications'));
    }
}


