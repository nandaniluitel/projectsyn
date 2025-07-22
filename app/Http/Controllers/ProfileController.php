<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ProjectGroup;
use App\Models\Evaluation;

class ProfileController extends Controller
{
    public function show()
    {
        $user      = Auth::user();
        $isTeacher = Teacher::where('userId', $user->id)->exists();
        $isStudent = Student::where('userId', $user->id)->exists();

        // 1) Teacher-only path
        if ($isTeacher) {
            return $this->showTeacher($user);
        }

        // 2) Student-only path
        if ($isStudent) {
            return $this->showByRollNo($user->id);
        }

        // 3) Neither: basic profile, empty teacher arrays
        return view('profile.show', [
            'user'               => $user,
            'isTeacher'          => $isTeacher,
            'isStudent'          => $isStudent,
            'roles'              => [],                // empty
            'supervisorGroups'   => collect(),         // empty
            'evaluatedProjects'  => collect(),         // empty
            'coordinatedGroups'  => collect(),         // empty
        ]);
    }

    protected function showTeacher(User $user)
    {
        $isTeacher = true;
        $isStudent = Student::where('userId', $user->id)->exists();

        $teacher = Teacher::where('userId', $user->id)->first();

        $roles             = [];
        $supervisorGroups  = collect();


        // Supervisor?
        if ($teacher->supervisors()->exists()) {
            $roles[] = 'supervisor';
            $ids = $teacher->supervisors()->pluck('groupId');
            $supervisorGroups = ProjectGroup::whereIn('id', $ids)
                ->get(['id','title','year','level']);
        }

        // Evaluator?
       if ($teacher->evaluator()->exists()) {
        $roles[] = 'evaluator';
    }

        // Coordinator?
           if ($teacher->coordinator()->exists()) {
        $roles[] = 'coordinator';
           }

        return view('profile.show', [
            'user'               => $user,
            'isTeacher'          => $isTeacher,
            'isStudent'          => $isStudent,
            'roles'              => $roles,
            'supervisorGroups'   => $supervisorGroups,
            
        ]);
}

/**
 * Show another teacher’s profile by their user ID.
 */
public function showByTeacherUserId($userId)
{
    $viewer    = Auth::user();
    $isTeacher = Teacher::where('userId', $viewer->id)->exists();
    $isStudent = Student::where('userId', $viewer->id)->exists();

    // Fetch the user we want to view
    $user = User::findOrFail($userId);

    // Make sure they actually are a teacher
    if (! Teacher::where('userId', $userId)->exists()) {
        abort(404, 'Teacher not found');
    }

    // Delegate to your existing showTeacher logic
    return $this->showTeacher($user);
}


    public function showByRollNo($rollno)
    {
        $viewerIsTeacher = Teacher::where('userId', Auth::id())->exists();
        $viewerIsStudent = Student::where('userId', Auth::id())->exists();

        $user = User::with('student')->findOrFail($rollno);
        if (! $user->student) {
            abort(404, 'Student not found');
        }

        $student  = $user->student;
        $projects = collect();

        // build $projects as before…
        foreach ($student->projectGroups as $group) {
            foreach ($group->projects as $project) {
                $project->group         = $group;
                $project->title         = $group->title ?? "Project Group {$group->id}";
                preg_match('/\d+/', strtolower($group->level ?? '1'), $m);
                $project->level         = $m ? (int)$m[0] : 1;
                $project->members       = $group->students
                    ->filter(fn($s) => $s->id !== $student->id)
                    ->map(fn($s) => $s->user->name ?? 'N/A');
                $project->supervisorName = $group->supervisors->first()->name ?? 'Not Assigned';

                $phases = ['proposal'=>null,'midterm'=>null,'final'=>null];
                foreach ($project->evaluations as $eval) {
                    $k = strtolower($eval->phase);
                    if (! array_key_exists($k, $phases)) continue;
                    if (! $phases[$k]) {
                        $phases[$k] = $eval;
                    } else {
                        $curr = $phases[$k]->status ?? 'pending';
                        $new  = $eval->status         ?? 'pending';
                        if ($new === 'approved' || ($curr !== 'approved' && $new === 'rejected')) {
                            $phases[$k] = $eval;
                        }
                    }
                }
                $project->phases = $phases;
                $projects->push($project);
            }
        }

        // group and pick latest report/slides as before…
        $groupedProjects = $projects->groupBy('level')->map(function($lvl){
            $main   = $lvl->first();
            $phases = ['proposal'=>null,'midterm'=>null,'final'=>null];
            $rpts   = null;
            $slides = null;
            foreach ($lvl as $p) {
                foreach ($p->phases as $k=>$e) {
                    if ($e && (
                        ! $phases[$k]
                        || $e->created_at > $phases[$k]->created_at
                        || $e->status === 'approved'
                    )) {
                        $phases[$k] = $e;
                    }
                }
                if ($p->report_file)  $rpts   = $p->report_file;
                if ($p->slides_file)  $slides = $p->slides_file;
            }
            $main->phases      = $phases;
            $main->report_file = $rpts;
            $main->slides_file = $slides;
            return $main;
        });

        $completedLevels = $groupedProjects
            ->filter(fn($p) => collect($p->phases)
                ->filter(fn($e) => $e && $e->status === 'approved')
                ->count() === 3
            )
            ->count();

        return view('profile.show', [
            'user'            => $user,
            'isTeacher'       => $viewerIsTeacher,
            'isStudent'       => $viewerIsStudent,
            'projects'        => $groupedProjects->values(),
            'completedLevels' => $completedLevels,
            'totalLevels'     => 3,
            // pass empty teacher arrays so Blade never errors
            'roles'              => [],
            'supervisorGroups'   => collect(),
            'evaluatedProjects'  => collect(),
            'coordinatedGroups'  => collect(),
        ]);
    }

    public function update(Request $request)
    {
        // your existing update() logic untouched…
    }
}
