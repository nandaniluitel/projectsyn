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
    $teacherId = $supervisor->teacher->id;
    // die("id".$teacherId);
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
    })->with(['projects' => function ($query) {
        $query->orderBy('updated_at', 'desc'); // Sort projects by the latest date
    }])->get();

    return view('Supervisor.allGroupsWithReports', compact('assignedGroups'));
}
public function viewLevelGroupsWithReports(Request $request)
{
    $level = $request->query('level');
    $supervisor = Auth::user();
    $teacherId = $supervisor->id;

    $query = ProjectGroup::query();

    if ($level) {
        $levelString = 'level' . $level;
        $query->where('level', $levelString);
    }

    $assignedGroups = $query->whereHas('supervisors', function ($query) use ($teacherId) {
        $query->where('teacherId', $teacherId);
    })->with(['projects' => function ($query) {
        $query->orderBy('created_at', 'desc');
    }])->get();

    return view('Supervisor.levelGroupsWithReports', compact('assignedGroups', 'level'));
}





public function viewPendingFiles()
    {
        $supervisor = Auth::user();
        $teacherId = $supervisor->id;
    
        // Fetch assigned groups where supervisor is assigned
        $assignedGroups = ProjectGroup::whereHas('supervisors', function ($query) use ($teacherId) {
            $query->where('teacherId', $teacherId);
        })->pluck('id')->toArray();
    
        // Retrieve pending projects for the assigned groups
        $pendingProjects = Project::whereIn('groupId', $assignedGroups)
                                  ->where('status', 'pending')
                                  ->with('projectGroup') // Eager load projectGroup relationship
                                  ->get();
    
        return view('supervisor.pendingFiles', compact('pendingProjects'));
    }

    // Method to accept a project
    public function acceptProject($id)
    {
        $project = Project::findOrFail($id);
        $project->status = 'accepted';
        $project->save();

        return redirect()->back()->with('success', 'Project accepted successfully');
    }

    // Method to reject a project
    public function rejectProject($id)
    {
        $project = Project::findOrFail($id);
        $project->status = 'rejected';
        $project->save();

        return redirect()->back()->with('success', 'Project rejected successfully');
    }

    // Method to view accepted files for the supervisor
    public function viewAcceptedFiles()
    {
        $supervisor = Auth::user();
        $teacherId = $supervisor->id;
    
        $acceptedFiles = Project::whereHas('projectGroup.supervisors', function ($query) use ($teacherId) {
            $query->where('teacherId', $teacherId);
        })->where('status', 'accepted')->with('projectGroup')->get();
    
        return view('supervisor.acceptedFiles', compact('acceptedFiles'));
    }

    public function viewRejectedFiles()
    {
        $supervisor = Auth::user();
    $teacherId = $supervisor->id;

    // Fetch assigned groups where supervisor is assigned
    $assignedGroups = ProjectGroup::whereHas('supervisors', function ($query) use ($teacherId) {
        $query->where('teacherId', $teacherId);
    })->pluck('id')->toArray();

    // Retrieve rejected projects for the assigned groups
    $rejectedProjects = Project::whereIn('groupId', $assignedGroups)
                               ->where('status', 'rejected')
                               ->with('projectGroup') // Eager load projectGroup relationship
                               ->get();

    return view('supervisor.rejectedFiles', compact('rejectedProjects'));
    }
    public function processReject(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        
        // Perform rejection action here, e.g., update status to 'rejected'
        $project->update(['status' => 'rejected']);

        // Redirect to feedback creation page with necessary details
        return redirect()->route('feedback.create', ['groupId' => $project->projectGroup->id])
                         ->with('error', 'Project has been rejected. Please provide necessary feedback.');
    }
}
