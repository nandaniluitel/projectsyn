<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluatorController extends Controller
{
    public function showDashboard()
    {
        return view('evaluator.index');
    }
}
