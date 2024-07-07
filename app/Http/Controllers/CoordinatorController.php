<?php
namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\ProjectGroup;
use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function assignRoles(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'role' => 'required|in:supervisor,evaluator,coordinator',
            'groupId' => 'required_if:role,supervisor|exists:project_groups,id',
        ]);

        $teacher = Teacher::find($request->teacher_id);

        switch ($request->role) {
            case 'coordinator':
                $teacher->coordinators()->syncWithoutDetaching([$teacher->id]);
                break;
            case 'evaluator':
                $teacher->evaluators()->syncWithoutDetaching([$teacher->id]);
                break;
            case 'supervisor':
                $teacher->supervisors()->syncWithoutDetaching([$request->groupId]);
                break;
        }

        return redirect()->route('coordinator.assignRolesForm')->with('success', 'Role assigned successfully.');
    }

    public function showAssignRolesForm()
    {
        $teachers = Teacher::all();
        $projectGroups = ProjectGroup::all();
        return view('coordinator.assign_roles', compact('teachers', 'projectGroups'));
    }
}
