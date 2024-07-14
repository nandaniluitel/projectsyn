<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;


class EvaluationController extends Controller
{
     // Fetch project titles
     
     public function create()
     {
        $userId = auth()->id();

        // Fetch the evaluatorId based on the logged-in user
        $evaluatorId = \DB::table('evaluators')
        ->join('teachers', 'evaluators.teacherId', '=', 'teachers.id')
        ->where('teachers.userId', $userId)
        ->value('evaluators.id');

         // Fetch project titles
         $projects = \DB::table('projects')
             ->join('project_groups', 'projects.groupId', '=', 'project_groups.id')
             ->select('projects.id', 'project_groups.title')
             ->get();
         
         return view('evaluations.create', compact('evaluatorId','projects'));
     }
     
    public function index()
    {
            $evaluations = Evaluation::with(['project.group', 'evaluator.teacher.user'])->get();
        
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

        return redirect()->back()->with('success', 'Evaluation form registered successfully.');
    }

    
}