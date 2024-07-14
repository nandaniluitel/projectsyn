<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\ProjectGroup;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\Project;

class SupervisorController extends Controller
{
    public function create()
    {
        $groups = ProjectGroup::select('id' , 'title')->get();
        
        $supervisors = Teacher::join('users', 'teachers.userId', '=', 'users.id')
                               ->select('teachers.id as teacherId', 'users.name as supervisorName')
                               ->get();
        return view('assignsupervisor.create', compact('groups', 'supervisors'));
    }

    public function assign(Request $request)
    {
        $request->validate([
            'groupId' => 'required|exists:project_groups,id',
            'supervisorId' => 'required|exists:teachers,id',
        ]);

    // Check if supervisor is already assigned to this group
    $existingAssignment = Supervisor::where('groupId', $request->groupId)->exists();

if ($existingAssignment) {
return redirect()->back()->with('error', 'Supervisor is already assigned to this group.');
}


        $supervisor = new Supervisor();
        $supervisor->teacherId = $request->supervisorId;
        $supervisor->groupId = $request->groupId;
        $supervisor->save();

        // Retrieve the assigned supervisor's details
        
        $assignedSupervisor = Teacher::join('users', 'teachers.userId', '=', 'users.id')
        ->select('users.name as supervisorName')
        ->where('teachers.id', $request->supervisorId)
        ->first();

        return redirect()->back()->with('success', 'Supervisor assigned successfully.')
        ->with('assignedSupervisor', $assignedSupervisor);
    }

    public function showAssignedGroups()
{
    $assignedGroups = Supervisor::with('teacher.user')->get();
    return view('assignsupervisor.index', compact('assignedGroups'));
}

public function removeSupervisor($groupId)
{
    // Find the supervisor assignment by group ID
    $assignment = Supervisor::where('groupId', $groupId)->first();

    if ($assignment) {
        $assignment->delete(); // Remove the supervisor assignment
        return redirect()->route('assignsupervisor.index')->with('success', 'Supervisor removed successfully.');
    } else {
        return redirect()->route('assignsupervisor.index')->with('error', 'Supervisor not found.');
    }
}
public function viewAssignedGroups()
{
    // Get the currently authenticated supervisor
    $supervisor = Auth::user();
    $teacherId = $supervisor->id;
    // Join the projects and project_groups tables to get the groups assigned to this supervisor
    $assignedGroups = ProjectGroup::whereHas('supervisors', function ($query) use ($teacherId) {
        $query->where('teacherId', $teacherId);
    })->get();

    return view('Supervisor.assignedgroups', compact('assignedGroups'));
}

public function viewGroupReports($groupId)
{
    $group = ProjectGroup::where('id', $groupId)->first();
    if (!$group) {
        return redirect()->route('Supervisor.assignedgroups')->with('error', 'Group not found.');
    }

    $reports = Project::where('groupId', $groupId)->get();

    return view('Supervisor.reports', compact('group', 'reports'));
}
public function viewAllGroupsWithReports()
{
    $supervisor = Auth::user();
    $teacherId = $supervisor->id;

    // Join the projects and project_groups tables to get the groups assigned to this supervisor
    $assignedGroups = ProjectGroup::whereHas('supervisors', function ($query) use ($teacherId) {
        $query->where('teacherId', $teacherId);
    })->with('projects')->get();

    return view('Supervisor.allGroupsWithReports', compact('assignedGroups'));
}


}
