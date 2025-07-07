<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\ProjectGroup;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\ChatRoom;
use App\Models\Project;
use App\Models\ProjectGroupStudent;
use App\Models\Notification;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;



class SupervisorController extends Controller
{
    
    public function create(Request $request)
    {
        // Get distinct years and levels for dropdown filters
        $years = ProjectGroup::select('year')->distinct()->pluck('year');
        $levels = ProjectGroup::select('level')->distinct()->pluck('level');
    
        // Start query and filter out groups that already have supervisors
        $query = ProjectGroup::with('supervisors')
            ->whereDoesntHave('supervisors') // only groups with no supervisors assigned
            ->select('id', 'title', 'year', 'level');
    
        // Apply filters if present
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
    
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }
    
        $groups = $query->get();
    
        // Get supervisors (teacher + user name)
        $supervisors = Teacher::join('users', 'teachers.userId', '=', 'users.id')
            ->select('teachers.id as teacherId', 'users.name as supervisorName')
            ->get();
    
        return view('assignsupervisor.create', compact('groups', 'supervisors', 'years', 'levels'));
    }
    
        /**public function store(Request $request)
    {
        $data = $request->validate([
            'groupId'      => 'required|exists:project_groups,id',
            'supervisorId'=> 'required|exists:teachers,id',
        ]);

        // no double‐assign
        if (Supervisor::where('groupId',$data['groupId'])->exists()) {
            return back()->with('error','That group already has a supervisor.');
        }

        Supervisor::create([
            'groupId'   => $data['groupId'],
            'teacherId' => $data['supervisorId'],
        ]);

        // attach the supervisor’s *user* to the chat room
        $room = ChatRoom::firstOrCreate(
            ['project_group_id'=>$data['groupId']],
            ['project_group_id'=>$data['groupId']]
        );

        $teacher = Teacher::find($data['supervisorId']);
        if ($teacher && $teacher->userId) {
            $room->users()->syncWithoutDetaching([$teacher->userId]);
        }

        return back()->with('success','Supervisor assigned and added to chat room.');
    }

    /**
     * List all existing assignments for the coordinator/admin.
     * GET /assignsupervisor
     */

      public function destroy($groupId)
    {
        $deleted = Supervisor::where('groupId',$groupId)->delete();
        if ($deleted) {
            if ($room = ChatRoom::where('project_group_id',$groupId)->first()) {
                // detach that supervisor only
                $teacher = auth()->user()->teacher?->userId;
                $room->users()->detach($teacher);
            }
            return back()->with('success','Supervisor removed.');
        }
        return back()->with('error','Nothing to remove.');
    }

    //
    // — Supervisor’s own dashboard —
    //

    /**
     * Show this logged-in supervisor’s assigned groups.
     * GET /supervisor/assignedgroups
     */

   public function assign(Request $request)
    {
        $data = $request->validate([
            'groupId'      => 'required|exists:project_groups,id',
            'supervisorId'=> 'required|exists:teachers,id',
        ]);

        // 1) prevent double‐assign
        if (Supervisor::where('groupId', $data['groupId'])->exists()) {
            return back()->with('error','That group already has a supervisor.');
        }

        // 2) create the supervisor record
        Supervisor::create([
            'groupId'   => $data['groupId'],
            'teacherId' => $data['supervisorId'],
        ]);

        // 3) ensure the chat room exists and attach supervisor (and students)
        $room = ChatRoom::firstOrCreate(
            ['project_group_id' => $data['groupId']],
            ['project_group_id' => $data['groupId']]
        );

        // attach supervisor’s user
        $teacher = Teacher::find($data['supervisorId']);
        if ($teacher && $teacher->userId) {
            $room->users()->syncWithoutDetaching([$teacher->userId]);
        }

        // (optional) re-attach all students, in case they aren’t already
        $group = ProjectGroup::with('students')->find($data['groupId']);
        foreach ($group->students as $student) {
            if ($student->userId) {
                $room->users()->syncWithoutDetaching([$student->userId]);
            }
        }

        // 4) grab supervisor user details for notifications
        $assignedSupervisor = Teacher::join('users','teachers.userId','=','users.id')
            ->select('users.name as supervisorName','users.id as userId')
            ->where('teachers.id', $data['supervisorId'])
            ->first();

        $supervisorName = $assignedSupervisor->supervisorName ?? 'your supervisor';

        // fetch group title/level for message
        $group = ProjectGroup::find($data['groupId']);

        // 5) notify each student
        $studentIds = ProjectGroupStudent::where('project_group_id', $data['groupId'])
            ->pluck('student_id');

        foreach ($studentIds as $sid) {
            $stu = Student::find($sid);
            if ($stu && $stu->userId) {
                Notification::create([
                    'user_id'         => $stu->userId,
                    'message'         => "You have been assigned supervisor {$supervisorName} for project “{$group->title}”.",
                    'target_audience' => 'students',
                    'student_year'    => substr($stu->id, 0, 2),
                    'is_important'    => true,
                    'expires_at'      => Carbon::now()->addDays(7),
                ]);
            }
        }

        // 6) notify the supervisor
        if ($assignedSupervisor && $assignedSupervisor->userId) {
            Notification::create([
                'user_id'         => $assignedSupervisor->userId,
                'message'         => "You have been assigned as supervisor for project “{$group->title}” (Level {$group->level}).",
                'target_audience' => 'teachers',
                'is_important'    => true,
                'expires_at'      => Carbon::now()->addDays(7),
            ]);
        }

        return back()->with('success','Supervisor assigned, chat room updated, and notifications sent.');
    }

    public function showAssignedGroups(Request $request)
    {
        $query = Supervisor::with(['teacher.user', 'projectGroup']);
    
        // Apply filters if provided
        if ($request->filled('year')) {
            $query->whereHas('projectGroup', function ($q) use ($request) {
                $q->where('year', $request->year);
            });
        }
    
        if ($request->filled('level')) {
            $query->whereHas('projectGroup', function ($q) use ($request) {
                $q->where('level', $request->level);
            });
        }
    
        $assignedGroups = $query->get();
    
        // Get unique years and levels for the filter dropdowns
        $years = \App\Models\ProjectGroup::select('year')->distinct()->pluck('year');
        $levels = \App\Models\ProjectGroup::select('level')->distinct()->pluck('level');
    
        return view('assignsupervisor.index', compact('assignedGroups', 'years', 'levels'));
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
public function viewAssignedGroups(Request $request)
{
    // 1️⃣ Find the Teacher record for the logged-in user
    $user       = Auth::user();
    $teacher    = Teacher::where('userId', $user->id)->first();
    if (! $teacher) {
        return redirect()->back()
                         ->with('error', 'No teacher profile found for your account.');
    }
    $teacherId  = $teacher->id;

    // 2️⃣ Query groups via the supervisors pivot (filtering on teachers.id)
    $query = ProjectGroup::whereHas('supervisors', function ($q) use ($teacherId) {
        $q->where('teacherId', $teacherId);
    });

    // 3️⃣ Apply optional filters
    if ($request->filled('year')) {
        $query->where('year', $request->year);
    }
    if ($request->filled('level')) {
        $query->where('level', $request->level);
    }

    $assignedGroups = $query->get();

    // 4️⃣ Fetch dropdown data
    $years  = ProjectGroup::select('year')->distinct()->pluck('year');
    $levels = ProjectGroup::select('level')->distinct()->pluck('level');

    return view('Supervisor.assignedgroups', compact(
        'assignedGroups', 'years', 'levels'
    ));
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
    $user    = Auth::user();
    $teacher = Teacher::where('userId', $user->id)->first();
    if (! $teacher) {
        return redirect()->back()
                         ->with('error', 'No teacher profile found for your account.');
    }
    $teacherId = $teacher->id;

    $assignedGroups = ProjectGroup::whereHas('supervisors', function ($q) use ($teacherId) {
        $q->where('teacherId', $teacherId);
    })
    ->with(['projects' => fn($q) => $q->orderBy('updated_at','desc')])
    ->get();

    return view('Supervisor.allGroupsWithReports', compact('assignedGroups'));
}

    // Join the projects and project_groups tables to get the groups assigned to this supervisor
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
    $user    = Auth::user();
    $teacher = Teacher::where('userId', $user->id)->first();
    if (! $teacher) {
        return redirect()->back()
                         ->with('error', 'No teacher profile found for your account.');
    }
    $teacherId = $teacher->id;
    
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
        $user    = Auth::user();
        $teacher = Teacher::where('userId', $user->id)->first();
        if (! $teacher) {
            return redirect()->back()
                    ->with('error', 'No teacher profile found for your account.');
    }
    $teacherId = $teacher->id;
    
        $acceptedFiles = Project::whereHas('projectGroup.supervisors', function ($query) use ($teacherId) {
            $query->where('teacherId', $teacherId);
        })->where('status', 'accepted')->with('projectGroup')->get();
    
        return view('supervisor.acceptedFiles', compact('acceptedFiles'));
    }

    public function viewRejectedFiles()
    {
       $user    = Auth::user();
    $teacher = Teacher::where('userId', $user->id)->first();
    if (! $teacher) {
        return redirect()->back()
                         ->with('error', 'No teacher profile found for your account.');
    }
    $teacherId = $teacher->id;
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
