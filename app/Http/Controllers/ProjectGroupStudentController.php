<?php

namespace App\Http\Controllers;

use App\Models\project_group_student;
use App\Models\Students;
use App\Models\projects;
use App\Http\Requests\Storeproject_group_studentRequest;
use App\Http\Requests\Updateproject_group_studentRequest;

class ProjectGroupStudentController extends Controller
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
     * @param  \App\Http\Requests\Storeproject_group_studentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeproject_group_studentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project_group_student  $project_group_student
     * @return \Illuminate\Http\Response
     */
    public function show(project_group_student $project_group_student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project_group_student  $project_group_student
     * @return \Illuminate\Http\Response
     */
    public function edit(project_group_student $project_group_student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateproject_group_studentRequest  $request
     * @param  \App\Models\project_group_student  $project_group_student
     * @return \Illuminate\Http\Response
     */
    public function update(Updateproject_group_studentRequest $request, project_group_student $project_group_student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project_group_student  $project_group_student
     * @return \Illuminate\Http\Response
     */
    public function destroy(project_group_student $project_group_student)
    {
        //
    }
}
