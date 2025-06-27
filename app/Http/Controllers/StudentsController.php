<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Http\Requests\StoreStudentsRequest;
use App\Http\Requests\UpdateStudentsRequest;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentsRequest  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentsRequest $request, Students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $students)
    {
        //
    }
    public function rejectedProjects()
{
    $user = Auth::user();

    // Get the student record
    $student = $user->student;

    // Get all project groups the student belongs to
    $projectGroups = $student->projectGroups()->with('projects.evaluations')->get();

    // Flatten and filter only rejected evaluations
    $rejectedProjects = collect();

    foreach ($projectGroups as $group) {
        foreach ($group->projects as $project) {
            foreach ($project->evaluations as $evaluation) {
                if ($evaluation->status === 'rejected') {
                    $rejectedProjects->push([
                        'title' => $project->title,
                        'phase' => $evaluation->phase,
                        'feedback' => $evaluation->feedback,
                        'rejected_at' => $evaluation->created_at,
                    ]);
                }
            }
        }
    }

    return view('student.rejected_projects', compact('rejectedProjects'));
}
}
