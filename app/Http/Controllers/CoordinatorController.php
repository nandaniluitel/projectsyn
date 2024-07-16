<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Evaluator;
use App\Models\Coordinator;
use App\Models\Student;
use App\Models\Project;
use App\Models\ProjectGroup;
use App\Models\Evaluation;

class CoordinatorController extends Controller
{
    public function showAssignRolesForm()
    {
        $teachers = Teacher::all();

        return view('assignroles.create', compact('teachers'));
    }

    public function assignRoles(Request $request)
    {
        $request->validate([
            'evaluator_id' => 'nullable|exists:teachers,id',
            'coordinator_id' => 'nullable|exists:teachers,id',
        ]);

        if ($request->has('evaluator_id')) {
            // Logic to assign evaluator
            $teacher = Teacher::findOrFail($request->evaluator_id);
            Evaluator::firstOrCreate(['teacherId' => $teacher->id]);
        }

        if ($request->has('coordinator_id')) {
            // Logic to assign coordinator
            $teacher = Teacher::findOrFail($request->coordinator_id);
            Coordinator::firstOrCreate(['teacherId' => $teacher->id]);
        }

        return redirect()->route('assignroles.create')->with('success', 'Roles assigned successfully.');
    }
    public function showEvaluators()
    {
        $evaluators = Evaluator::with('teacher.user')->get();
        return view('assignroles.show_evaluators', compact('evaluators'));
    }

    public function showCoordinators()
    {
        $coordinators = Coordinator::with('teacher.user')->get();
        return view('assignroles.show_coordinators', compact('coordinators'));
    }
    // CoordinatorController.php

    public function removeCoordinator($id)
    {
        $coordinator = Coordinator::findOrFail($id);
        $coordinator->delete();
        
        return redirect()->back()->with('success', 'Coordinator removed successfully.');
    }

    public function removeEvaluator($id)
    {
        $evaluator = Evaluator::findOrFail($id);
        $evaluator->delete();
        
        return redirect()->back()->with('success', 'Evaluator removed successfully.');
    }
   
    


    public function search(Request $request)
{
    $studentId = $request->input('student_id');
    $student = Student::where('id', $studentId)->first();

    if ($student) {
        // Fetching project group IDs associated with the student
        $projectGroupIds = $student->projectGroups()->pluck('project_groups.id')->toArray();
        $projectTitles = ProjectGroup::whereIn('id', $projectGroupIds)->pluck('title', 'id');

        // Fetch IDs of projects associated with the student
        $projects = Project::whereIn('groupId', $projectGroupIds)->get();

        $evaluationIds = Evaluation::whereIn('projectId', $projects->pluck('id'))->pluck('id');
        $evaluationDetails = [];

        foreach ($evaluationIds as $evaluationId) {
            $evaluation = Evaluation::find($evaluationId);
            if ($evaluation) {
                // Find the project related to this evaluation
                $project = $projects->where('id', $evaluation->projectId)->first();
                
                if ($project) {
                    $evaluationDetails[] = [
                        'project' => $project,
                        'phase' => $evaluation->phase,
                        'status' => $evaluation->status,
                    ];
                }
            }
        }

        // Pass $evaluationDetails to your view along with other data
        return view('coordinator.search_results', compact('student', 'evaluationDetails', 'projectTitles'));

    } else {
        return view('coordinator.search_results', compact('student'));
    }
}



    

    

}
