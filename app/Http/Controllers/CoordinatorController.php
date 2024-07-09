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
            'teacherId' => 'required|exists:teachers,id',
            'role' => 'required|in:supervisor,evaluator,coordinator',
            'groupId' => 'required_if:role,supervisor|exists:project_groups,id',
        ]);

        $teacher = Teacher::find($request->teacherId);

        switch ($request->role) {
            case 'coordinator':
                $teacher->coordinator()->create([]);
                break;
            case 'evaluator':
                $teacher->evaluator()->create([]);
                break;
            case 'supervisor':
                $teacher->supervisors()->create(['groupId' => $request->groupId]);
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
