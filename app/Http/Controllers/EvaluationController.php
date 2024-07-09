<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    public function create()
    {
        return view('evaluations.create');
    }
    public function index()
    {
        $evaluations = Evaluation::all();
        return view('evaluations.index', compact('evaluations'));
    }

    public function store(Request $request)
    {
        \Log::info($request->all());
        $request->validate([
            'evaluatorId' => 'required',
            'ProjectID' => 'required',
            'Phase' => 'required',
            'reportMarks' => 'required|integer',
            'presentationMarks' => 'required|integer',
            'qaMarks' => 'required|integer',
            'demoMarks' => 'required|integer',
            'feedback' => 'required',
        ]);

        Evaluation::create([
            'evaluatorId' => $request->evaluatorId, // Assuming id is the evaluatorId
            'projectId' => $request->ProjectID,
            'phase' => $request->Phase,
            'reportMarks' => $request->reportMarks,
            'presentationMarks' => $request->presentationMarks,
            'qaMarks' => $request->qaMarks,
            'demoMarks' => $request->demoMarks,
            'feedback' => $request->feedback,
        ]);

        return redirect()->back()->with('success', 'Project registered successfully.');
    }

    
}