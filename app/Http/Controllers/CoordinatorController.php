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
use App\Models\Notification;
use Carbon\Carbon;

class CoordinatorController extends Controller
{
    public function showAssignRolesForm()
    {
        $teachers = Teacher::all();

        return view('assignroles.create', compact('teachers'));
    }
    public function viewEvaluatedMarks()
{
    $evaluations = Evaluation::with(['student.user', 'projectGroup'])
                    ->orderBy('created_at', 'desc')->get();

    return view('coordinator.evaluations.index', compact('evaluations'));
}

public function updateEvaluationStatus(Request $request)
{
    $request->validate([
        'evaluation_id' => 'required|exists:evaluations,id',
        'status' => 'required|in:pending,approved,rejected'
    ]);

    $evaluation = Evaluation::findOrFail($request->evaluation_id);
    $evaluation->status = $request->status;
    $evaluation->save();

    return redirect()->route('coordinator.evaluations')->with('success', 'Evaluation status updated successfully.');
}


    public function assignRoles(Request $request)
    {
        $request->validate([
            'evaluator_id' => 'nullable|exists:teachers,id',
            'assigned_date' => 'required_with:evaluator_id|date',
            'room_no' => 'nullable|string|max:50',
            'coordinator_id' => 'nullable|exists:teachers,id',
        ]);

        // Assign evaluator
        if ($request->filled('evaluator_id')) {
            $teacher = Teacher::with('user')->findOrFail($request->evaluator_id);

            Evaluator::firstOrCreate([
                'teacherId' => $teacher->id,
                'assigned_date' => $request->assigned_date,
            ], [
                'room_no' => $request->room_no,
            ]);

            // ✅ Notify the evaluator
            if ($teacher->user) {
                Notification::create([
                    'user_id' => $teacher->user->id,
                    'message' => 'You have been assigned as an evaluator on ' . $request->assigned_date . '. Please check your dashboard for details.',
                    'target_audience' => 'teachers',
                    'student_year' => null,
                    'is_important' => true,
                    'expires_at' => Carbon::now()->addDays(7),
                ]);
            }
        }

        // Assign coordinator
        if ($request->filled('coordinator_id')) {
            $teacher = Teacher::with('user')->findOrFail($request->coordinator_id);

            Coordinator::firstOrCreate([
                'teacherId' => $teacher->id,
            ]);

            // ✅ Notify the coordinator
            if ($teacher->user) {
                Notification::create([
                    'user_id' => $teacher->user->id,
                    'message' => 'You have been assigned as a coordinator. Please review your responsibilities on the coordinator dashboard.',
                    'target_audience' => 'teachers',
                    'student_year' => null,
                    'is_important' => true,
                    'expires_at' => Carbon::now()->addDays(7),
                ]);
            }
        }

        return redirect()->route('assignroles.create')->with('success', 'Roles assigned and notifications sent successfully.');
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
    $id = $request->query('student_id');

    // 1) If it’s a student, send them to check-student/{rollno}
    if (Student::where('userId', $id)->exists()) {
        return redirect()->route('check-student', ['rollno' => $id]);
    }

    // 2) If it’s a teacher, send them to profile/teacher/{userId}
    if (Teacher::where('userId', $id)->exists()) {
        return redirect()->route('profile.showByTeacher', ['userId' => $id]);
    }

    // 3) Otherwise, back with an error
    return back()->withErrors(['student_id' => 'No student or teacher found with that ID.']);
}




    

    

}
