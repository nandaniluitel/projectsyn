<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class teacherDashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function create()
    {
        $notifications = [];
        return view('teacherdashboard.create', compact('notifications'));
    }
}


