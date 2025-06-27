<?php

namespace App\Http\Controllers;

use App\Models\ProjectGroup;
use App\Models\ProjectGroupStudent;
use App\Models\Student;
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
    
        $years = ProjectGroup::select('year')->distinct()->pluck('year');
        $levels = ProjectGroup::select('level')->distinct()->pluck('level');
        $view_mode = $request->input('view_mode', 'accordion'); // Default is accordion
    
        return view('projects.index', compact('project_groups', 'years', 'levels', 'view_mode'));
    }
    


    public function create()
    {
        $studentUserId = auth()->id(); // current logged-in user id
        $student = \App\Models\Student::where('userId', $studentUserId)->first();
    
        if (!$student) {
            abort(403, 'Student record not found.');
        }
    
        $batchPrefix = substr($student->id, 0, 2); // extract '20' from '20319'
    
        // Fetch only students whose ID starts with the same batch prefix
        $students = Student::where('id', 'like', $batchPrefix . '%')->get();
    
        return view('projects.create', compact('students'));
    }
    

  
    public function store(Request $request)
    { 
         // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'required|string|max:255',
            'crns' => 'required|array|max:3',
            'crns.*' => 'exists:students,id', // Ensure each CRN corresponds to a valid student ID
        ]);
            // Extract year from the first student's ID
    $firstCrn = $request->crns[0];
    $year = substr($firstCrn, 0, 2); // e.g., '20' from 20319

            // Initialize an array to collect error messages
    $errors = [];
        // Check if any of the CRNs are already registered for the given level
    foreach ($request->crns as $crn) {
        $student = Student::find($crn);
        if (!$student) {
            $errors['crns'][] = 'CRN ' . $crn . ' does not exist.';
        } else {
            $exists = ProjectGroup::whereHas('students', function($query) use ($crn) {
                $query->where('student_id', $crn);
            })->where('level', $request->level)->exists();

            if ($exists) {
                $errors['crns'][] = 'CRN ' . $crn . ' is already registered for this project level.';
            }
        }
    }
    
    // If there are any errors, redirect back with the errors
    if (!empty($errors)) {
        return redirect()->back()->withErrors($errors)->withInput();
    }
        
        //Create the new project group
        $project_groups = new ProjectGroup();
        $project_groups->title = $request->title;
        $project_groups->description = $request->description;
        $project_groups->level = $request->level;
        $project_groups->year = $year;
        $project_groups->save();
         //Add students to the project group
         foreach ($request->crns as $crn) {
            // Find the student by ID (CRN)
            $student = Student::find($crn);
            if ($student) {
                // Create the project group student relationship
                ProjectGroupStudent::create([
                    'project_group_id' => $project_groups->id,
                    'student_id' => $student->id,
                ]);
            } 
    }
        
    
        return redirect()->back()->with('success', 'Project registered successfully.');
    }
    public function edit($id)
    {
        $project_group = ProjectGroup::findOrFail($id);
        $students = Student::all();
        return view('projects.edit', compact('project_group', 'students'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'required|string|max:255',
        ]);

        $project_group = ProjectGroup::findOrFail($id);
        $project_group->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project group updated successfully.');
    }
}