<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Assuming User model is used for teachers
use App\Models\ProjectGroup;

class SupervisorProfileController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Retrieve the associated student record
        $student = $user->student()->first();

        // If no student record found, redirect with an error message
        if (!$student) {
            return redirect()->route('home')->with('error', 'Student record not found.');
        }

        // Retrieve all project groups associated with the student
        $projectGroups = $student->project_groups()->get();

        // Initialize an empty array to store supervisors
        $supervisors = [];

        // Loop through each project group and retrieve supervisors
        foreach ($projectGroups as $projectGroup) {
            // Retrieve supervisors associated with the project group
            $supervisors[$projectGroup->title] = $projectGroup->supervisors;
        }

        // Pass supervisors data to the view for display
        return view('assignsupervisor.profile', compact('supervisors'));
    }
}
