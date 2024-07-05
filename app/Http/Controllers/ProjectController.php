<?php

namespace App\Http\Controllers;

use App\Models\project_groups;
use App\Models\project_group_student;
use App\Models\Students;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $project_groups = project_groups::with('students')->get();
        return view('projects.index', compact('project_groups'));
    }

    public function create()//left to see
    {
        $students = Students::all();
        return view('projects.create', compact('students'));
    }

    public function store(Request $request)
    { 
         // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'required|string|max:255',
            'crns' => 'required|array',
            'crns.*' => 'exists:students,id', // Ensure each CRN corresponds to a valid student ID
        ]);
        
        //Create the new project group
        $project_groups = new project_groups();
        $project_groups->title = $request->title;
        $project_groups->description = $request->description;
        $project_groups->level = $request->level;
        $project_groups->save();
         // Add students to the project group
    //      foreach ($request->crns as $crn) {
    //         // Find the student by ID (CRN)
    //         $student = Students::find($crn);
    //         if ($student) {
    //             // Create the project group student relationship
    //             project_group_student::create([
    //                 'project_group_id' => $project_groups->id,
    //                 'student_id' => $student->id,
    //             ]);
    //         } else {
    //             // Handle the case where a student with the given CRN doesn't exist
    //             return redirect()->back()->withErrors(['crns' => 'Student with CRN ' . $crn . ' not found.']);
    //         }
    //     }
    //     return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    // }
    // public function destroy($id)
    // {
    //     $project_groups = project_groups::findOrFail($id);
    //     $project_groups->delete();

    //     return redirect()->route('projects.index');
}
}
