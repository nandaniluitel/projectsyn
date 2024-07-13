<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Evaluator;
use App\Models\Coordinator;

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

}
