<?php

namespace App\Http\Controllers;

use App\Models\ProjectGroup;
use App\Models\ProjectGroupStudent;
use App\Models\Student;
use App\Models\ChatRoom;          // ← NEW
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = ProjectGroup::with('students');

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Sort by latest updated first
        $project_groups = $query->orderBy('updated_at', 'desc')->get();

        $years     = ProjectGroup::select('year')->distinct()->pluck('year');
        $levels    = ProjectGroup::select('level')->distinct()->pluck('level');
        $view_mode = $request->input('view_mode', 'accordion');

        return view('projects.index', compact('project_groups', 'years', 'levels', 'view_mode'));
    }

    public function create()
    {
        $studentUserId = auth()->id();
        $student       = Student::where('userId', $studentUserId)->first();

        if (! $student) {
            abort(403, 'Student record not found.');
        }

        $batchPrefix = substr($student->id, 0, 2);
        $students    = Student::where('id', 'like', "$batchPrefix%")->get();

        return view('projects.create', compact('students'));
    }

    public function store(Request $request)
    {
        // 1) Validate
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'level'       => 'required|string|max:255',
            'crns'        => 'required|array|max:3',
            'crns.*'      => 'exists:students,id',
        ]);

        // 2) Derive year from first CRN
        $firstCrn = $request->crns[0];
        $year     = substr($firstCrn, 0, 2);

        // 3) Check duplicates per level
        $errors = [];
        foreach ($request->crns as $crn) {
            $exists = ProjectGroup::whereHas('students', function($q) use ($crn) {
                    $q->where('student_id', $crn);
                })
                ->where('level', $request->level)
                ->exists();
            if ($exists) {
                $errors['crns'][] = "CRN $crn is already in a group at this level.";
            }
        }
        if (! empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        // 4) Create the ProjectGroup
        $projectGroup = ProjectGroup::create([
            'title'       => $request->title,
            'description' => $request->description,
            'level'       => $request->level,
            'year'        => $year,
        ]);

        // 5) Attach students
        $studentUserIds = [];
        foreach ($request->crns as $crn) {
            $stud = Student::find($crn);
            ProjectGroupStudent::create([
                'project_group_id' => $projectGroup->id,
                'student_id'       => $stud->id,
            ]);
            $studentUserIds[] = $stud->userId;
        }

        // 6) Create a ChatRoom for this group
        $chatRoom = ChatRoom::create([
            'project_group_id' => $projectGroup->id,
        ]);

        // 7) Attach those students to the room
        $chatRoom->users()->attach($studentUserIds);

        return back()->with('success', 'Project registered and chat room created!');
    }

    public function edit($id)
    {
        $project_group = ProjectGroup::findOrFail($id);
        $students      = Student::all();
        return view('projects.edit', compact('project_group', 'students'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'level'       => 'required|string|max:255',
        ]);

        $pg = ProjectGroup::findOrFail($id);
        $pg->update($request->only('title', 'description', 'level'));

        return redirect()->route('projects.index')
                         ->with('success', 'Project group updated successfully.');
    }
}

