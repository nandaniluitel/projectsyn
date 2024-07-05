<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function create()
    {
        $notifications = [];
        return view('dashboard.create', compact('notifications'));
    }
}


