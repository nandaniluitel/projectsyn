<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification; // Import Notification model

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }
    public function create()
    {
        $notifications = Notification::all();// Fetch notifications for all students.

        return view('dashboard.create', compact('notifications'));
    }
}


