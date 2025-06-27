<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $isTeacher = Teacher::where('userId', $user->id)->exists();
        $isStudent = Student::where('userId', $user->id)->exists();


        if ($isStudent && !$isTeacher) {
            return $this->showByRollNo($user->id);
        }

        return view('profile.show', [
            'user' => $user,
            'isTeacher' => $isTeacher,
            'isStudent' => $isStudent
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'Phone_number' => 'nullable|string|max:255',
            'semester' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'Photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('Photo')) {
            $photoName = time() . '.' . $request->Photo->extension();
            $request->Photo->move(public_path('images'), $photoName);
            $user->Photo = $photoName;
        }

        $user->name = $request->name;
        $user->Phone_number = $request->Phone_number;
        $user->semester = $request->semester;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    public function showByRollNo($rollno)
    {
        $viewer = Auth::user();
        $isTeacher = \App\Models\Teacher::where('userId', $viewer->id)->exists();
        $isStudent = \App\Models\Student::where('userId', $viewer->id)->exists();

        $user = User::with('student')->where('id', $rollno)->first();
        if (!$user || !$user->student) {
            abort(404, 'Student not found');
        }
        $student = $user->student;
        $projects = collect();

        foreach ($student->projectGroups as $group) {
            foreach ($group->projects as $project) {
                $project->group = $group;
                $project->title = $group->title ?? "Project Group {$group->id}";

                // Extract numeric level
                preg_match('/\d+/', strtolower($group->level ?? '1'), $matches);
                $project->level = $matches ? (int) $matches[0] : 1;

                // Group members
                $project->members = $group->students
                    ->filter(fn($s) => $s->id !== $student->id)
                    ->map(fn($s) => $s->user->name ?? 'N/A');

                $project->supervisorName = $group->supervisors->first()->name ?? 'Not Assigned';

                // Evaluation statuses by phase
               $phases = ['proposal' => null, 'midterm' => null, 'final' => null];
foreach ($project->evaluations as $eval) {
    $phaseKey = strtolower($eval->phase);
    if (!array_key_exists($phaseKey, $phases)) continue;

    // If not set yet, assign it
    if (!$phases[$phaseKey]) {
        $phases[$phaseKey] = $eval;
    }
    // If already set, prefer the one with 'approved' status
    else {
        $currentStatus = $phases[$phaseKey]->status ?? 'pending';
        $newStatus = $eval->status ?? 'pending';

        if ($newStatus === 'approved') {
            $phases[$phaseKey] = $eval;
        } elseif ($currentStatus !== 'approved' && $newStatus === 'rejected') {
            // Only replace pending with rejected if nothing is approved
            $phases[$phaseKey] = $eval;
        }
    }
}


                $project->phases = $phases;
                $projects->push($project);
            }
        }

        // Group by project level
        $groupedProjects = $projects->groupBy('level')->map(function ($projectsAtLevel) {
            $main = $projectsAtLevel->first();
            $phases = ['proposal' => null, 'midterm' => null, 'final' => null];
            $latestReport = null;
            $latestSlides = null;

            foreach ($projectsAtLevel as $proj) {
                foreach ($proj->phases as $key => $eval) {
    if ($eval) {
        // Keep the latest evaluation (any status), overwrite if approved comes later
        if (!$phases[$key] || $eval->created_at > $phases[$key]->created_at || $eval->status === 'approved') {
            $phases[$key] = $eval;
        }
    }
}


                if ($proj->report_file) $latestReport = $proj->report_file;
                if ($proj->slides_file) $latestSlides = $proj->slides_file;
            }

            $main->phases = $phases;
            $main->report_file = $latestReport;
            $main->slides_file = $latestSlides;

            return $main;
        });

        $completedLevels = $groupedProjects->filter(function ($project) {
        return collect($project->phases)->filter(fn($eval) => $eval && $eval->status === 'approved')->count() === 3;
    })->count();

    return view('profile.show', [
        'user' => $user,                 // the profile being viewed
        'isTeacher' => $isTeacher,       // based on logged-in user
        'isStudent' => $isStudent,       // based on logged-in user
        'projects' => $groupedProjects->values(),
        'completedLevels' => $completedLevels,
        'totalLevels' => 3
    ]);
    }
}