<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\ProjectGroup;
use App\Models\ProjectGroupStudent;
use App\Models\User;
use App\Models\Project;
use App\Models\Teacher;
use App\Models\Supervisor;
use App\Models\Student;

class FeedbackController extends Controller
{
    public function create($groupId)
    {
        // Fetch all projects supervised by this user
        $group = ProjectGroup::findOrFail($groupId);
        return view('feedback.create', compact('group'));
    }

    public function index()
{
    $user = Auth::user();
    $student = Student::where('userId', $user->id)->first();

     // Debug statements
     if(!$student) {
        return "Student not found for user ID: " . $user->id;
    }

    // Fetch feedbacks associated with the logged-in user
    $feedbacks = Feedback::whereHas('group.Students', function ($query) use ($student) {
        $query->where('student_id', $student->id);
    })->get();

    // Another debug statement
    if($feedbacks->isEmpty()) {
        return "No feedbacks found for student ID: " . $student->id;
    }

    return view('feedback.index', compact('feedbacks'));
}

    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:project_groups,id',
            'feedback_text' => 'required|string',
        ]);
        $userId = auth()->id();
        $supervisorId = $this->getSupervisorIdFromUserId($userId);
        // Create a new Feedback instance
        Feedback::create([
            'supervisor_id' => $supervisorId, // Assuming you have authentication and the supervisor id is available
            'group_id' => $request->group_id,
            'feedback_text' => $request->feedback_text,
        ]);

        return redirect()->route('feedback.create', ['groupId' => $request->group_id])->with('success', 'Feedback submitted successfully.');
    }

    private function getSupervisorIdFromUserId($userId)
    {
        // Example logic to retrieve supervisor_id based on user_id
        // Modify this based on your actual application logic
        $teacher = Teacher::where('userId', $userId)->first();
        if ($teacher) {
            $supervisor = Supervisor::where('teacherId', $teacher->id)->first();
        if ($supervisor) {
            return $supervisor->id;
        }
    }
        // Return default supervisor ID or handle case where no supervisor found
        return null;
    }

}
