<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\ProjectGroup;
use App\Models\Supervisor;

class SupervisorController extends Controller
{
    public function create()
    {
        $groups = ProjectGroup::select('id' , 'title')->get();
        $supervisors = Teacher::all();
        return view('assignsupervisor.create', compact('groups', 'supervisors'));
    }

    public function assign(Request $request)
    {
        $request->validate([
            'groupId' => 'required|exists:project_groups,id',
            'supervisorId' => 'required|exists:teachers,id',
        ]);

        $supervisor = new Supervisor();
        $supervisor->teacherId = $request->supervisorId;
        $supervisor->groupId = $request->groupId;
        $supervisor->save();

        // Retrieve the assigned supervisor's details
        $assignedSupervisor = Teacher::find($request->supervisorId);

        return redirect()->route('assignsupervisor.create')->with('success', 'Supervisor assigned successfully.')
        ->with('assignedSupervisor', $assignedSupervisor);
    }
}
