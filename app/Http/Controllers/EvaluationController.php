<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    // Show form to create evaluation
    public function create()
    {
        $userId = auth()->id();

        // Fetch evaluatorId based on logged-in user
        $evaluatorId = DB::table('evaluators')
            ->join('teachers', 'evaluators.teacherId', '=', 'teachers.id')
            ->where('teachers.userId', $userId)
            ->value('evaluators.id');

        // Fetch project titles
        $projects = DB::table('projects')
            ->join('project_groups', 'projects.groupId', '=', 'project_groups.id')
            ->select('projects.id', 'project_groups.title')
            ->get();

        return view('evaluations.create', compact('evaluatorId', 'projects'));
    }

    // Show only the latest evaluation per project and phase
    public function index(Request $request)
    {
        $query = Evaluation::with(['project.group', 'evaluator.teacher.user'])
            ->select('evaluations.*', 'project_groups.year', 'project_groups.level')
            ->join('projects', 'evaluations.projectId', '=', 'projects.id')
            ->join('project_groups', 'projects.groupId', '=', 'project_groups.id')
            ->join(DB::raw('(SELECT projectId, phase, MAX(created_at) as latest
                             FROM evaluations
                             GROUP BY projectId, phase) as latest_evals'),
                function ($join) {
                    $join->on('evaluations.projectId', '=', 'latest_evals.projectId')
                         ->on('evaluations.phase', '=', 'latest_evals.phase')
                         ->on('evaluations.created_at', '=', 'latest_evals.latest');
                });
    
        // Apply year filter if requested
        if ($request->filled('year')) {
            $query->where('project_groups.year', $request->year);
        }
    
        // Apply level filter if requested
        if ($request->filled('level')) {
            $query->where('project_groups.level', $request->level);
        }

        // Apply search filter if requested
        if ($request->filled('search')) {
            $query->where('project_groups.title', 'like', '%' . $request->search . '%');
        }

        // Apply status filter if requested
        if ($request->filled('status')) {
            $query->where('evaluations.status', $request->status);
        }
    
        $evaluations = $query->get();
    
        // Pass distinct years and levels for filter dropdowns
        $years = DB::table('project_groups')->distinct()->pluck('year');
        $levels = DB::table('project_groups')->distinct()->pluck('level');
    
        return view('evaluations.index', compact('evaluations', 'years', 'levels'));
    }
    
    

    // View rejected evaluations
    public function viewRejected()
    {
        $evaluations = Evaluation::where('status', 'rejected')->get();
        return view('evaluations.rejected', compact('evaluations'));
    }

    // View accepted evaluations
    public function viewAccepted()
    {
        $evaluations = Evaluation::where('status', 'approved')->get();
        return view('evaluations.accepted', compact('evaluations'));
    }

    // Store evaluation (replace previous if project + phase already exists)
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
            'feedback' => 'required|string',
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $existingEvaluation = Evaluation::where('projectId', $request->ProjectID)
            ->where('phase', $request->Phase)
            ->latest()
            ->first();

        if ($existingEvaluation) {
            $existingEvaluation->update([
                'evaluatorId' => $request->evaluatorId,
                'reportMarks' => $request->reportMarks,
                'presentationMarks' => $request->presentationMarks,
                'qaMarks' => $request->qaMarks,
                'demoMarks' => $request->demoMarks,
                'feedback' => $request->feedback,
                'status' => $request->status,
            ]);
        } else {
            Evaluation::create([
                'evaluatorId' => $request->evaluatorId,
                'projectId' => $request->ProjectID,
                'phase' => $request->Phase,
                'reportMarks' => $request->reportMarks,
                'presentationMarks' => $request->presentationMarks,
                'qaMarks' => $request->qaMarks,
                'demoMarks' => $request->demoMarks,
                'feedback' => $request->feedback,
                'status' => $request->status,
            ]);
        }

        return redirect()->back()->with('success', 'Evaluation saved successfully.');
    }

    // Edit view for an evaluation
    public function edit(Evaluation $evaluation)
    {
        return view('evaluations.edit', compact('evaluation'));
    }

    // Update status of an evaluation
    public function update(Request $request, Evaluation $evaluation)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $evaluation->status = $request->status;
        $evaluation->save();

        return redirect()->route('evaluations.index')->with('success', 'Evaluation status updated successfully.');
    }
}
