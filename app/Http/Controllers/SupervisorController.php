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
use Illuminate\Database\QueryException;



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
        try {
            // findOrFail so we can catch "not found" too if you like
            $assignment = Supervisor::where('groupId', $groupId)->firstOrFail();

            $assignment->delete();

            // detach the user from the chat room
            if ($room = ChatRoom::where('project_group_id', $groupId)->first()) {
                $teacherUserId = auth()->user()->teacher?->userId;
                $room->users()->detach($teacherUserId);
            }

            return redirect()
                ->route('assignsupervisor.index')
                ->with('success', 'Supervisor removed successfully.');

        } catch (QueryException $ex) {
            // MySQL error code 1451 = FK constraint violation
            if (isset($ex->errorInfo[1]) && $ex->errorInfo[1] == 1451) {
                return redirect()
                    ->back()
                    ->with('error',
                        'You can’t remove a supervisor who’s already been involved in accepting a project report.'
                    );
            }
            // re-throw other DB errors
            throw $ex;
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
    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    $assignedGroups = $query->get();

    // 4️⃣ Fetch dropdown data
    $years  = ProjectGroup::select('year')->distinct()->pluck('year');
    $levels = ProjectGroup::select('level')->distinct()->pluck('level');

    $view_mode = $request->input('view_mode', 'accordion');

    return view('Supervisor.assignedgroups', compact(
        'assignedGroups', 'years', 'levels', 'view_mode'
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

    public function viewAllGroupsWithReports(Request $request)
    {
        $user = Auth::user();
        $teacher = Teacher::where('userId', $user->id)->first();
        if (!$teacher) {
            return redirect()->back()->with('error', 'No teacher profile found for your account.');
        }
        $teacherId = $teacher->id;

        // Base query for groups assigned to the supervisor, eager load all projects
        $assignedGroupsQuery = ProjectGroup::whereHas('supervisors', function ($query) use ($teacherId) {
            $query->where('teacherId', $teacherId);
        })->with('projects');

        // Get all projects from these groups to populate filters
        $allAssignedGroups = (clone $assignedGroupsQuery)->get();
        $allProjects = $allAssignedGroups->pluck('projects')->flatten();

        // Get distinct values for filters from the complete dataset
        $years = $allAssignedGroups->pluck('year')->unique()->sort();
        $levels = $allAssignedGroups->pluck('level')->unique()->sort();
        $report_types = $allProjects->pluck('report_type')->unique()->sort();
        $statuses = $allProjects->pluck('status')->unique()->sort();

        // Start with all groups and apply filters
        $filteredGroups = $allAssignedGroups;

        // Apply filters to the groups collection
        if ($request->filled('year')) {
            $filteredGroups = $filteredGroups->where('year', $request->year);
        }
        if ($request->filled('level')) {
            $filteredGroups = $filteredGroups->where('level', $request->level);
        }

        // Apply filters to the projects within the groups
        if ($request->filled('title') || $request->filled('report_type') || $request->filled('status')) {
            $filteredGroups = $filteredGroups->map(function ($group) use ($request) {
                $filteredProjects = $group->projects;

                if ($request->filled('title')) {
                    $filteredProjects = $filteredProjects->filter(function ($project) use ($request) {
                        return stripos($project->title, $request->title) !== false;
                    });
                }

                if ($request->filled('report_type')) {
                    $filteredProjects = $filteredProjects->where('report_type', $request->report_type);
                }

                if ($request->filled('status')) {
                    $filteredProjects = $filteredProjects->where('status', $request->status);
                }

                $group->setRelation('projects', $filteredProjects);
                return $group;
            })->filter(function ($group) {
                return $group->projects->isNotEmpty(); // Remove groups with no matching projects
            });
        }

        return view('Supervisor.allGroupsWithReports', [
            'assignedGroups' => $filteredGroups,
            'years' => $years,
            'levels' => $levels,
            'report_types' => $report_types,
            'statuses' => $statuses
        ]);
    }

    // Join the projects and project_groups tables to get the groups assigned to this supervisor
    public function viewLevelGroupsWithReports(Request $request)
    {
        $user = Auth::user();
        $teacher = Teacher::where('userId', $user->id)->first();
        if (!$teacher) {
            return redirect()->back()->with('error', 'No teacher profile found for your account.');
        }
        $teacherId = $teacher->id;
        $level = $request->input('level');

        $query = ProjectGroup::query();

        if ($level) {
            $query->where('level', $level);
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
        if (!$teacher) {
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

        return redirect()->route('feedback.create', ['groupId' => $project->projectGroup->id])
            ->with('info', 'Project has been rejected. Please provide necessary feedback.');
    }

    // Method to view accepted files for the supervisor
    public function viewAcceptedFiles()
    {
        $user    = Auth::user();
        $teacher = Teacher::where('userId', $user->id)->first();
        if (!$teacher) {
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
        if (!$teacher) {
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
            ->with('info', 'Project has been rejected. Please provide necessary feedback.');
    }
}
