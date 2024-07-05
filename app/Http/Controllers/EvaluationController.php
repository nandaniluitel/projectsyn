<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\evaluations;

class EvaluationController extends Controller
{
    public function create()
    {
        return view('evaluations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'SN' => 'required',
            'ProjectID' => 'required',
            'collegeRollNo' => 'required',
            'name' => 'required',
            'reportMarks' => 'required|integer',
            'presentationMarks' => 'required|integer',
            'qaMarks' => 'required|integer',
            'demoMarks' => 'required|integer',
            'feedback' => 'required',
        ]);

        evaluations::create($request->all());

        return redirect()->back()->with('success', 'Evaluation submitted successfully');
    }
}
