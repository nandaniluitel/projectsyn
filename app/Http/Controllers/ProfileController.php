<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Student;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        // Check if user is a teacher or a student
        $isTeacher = Teacher::where('userId', $user->id)->exists();
        $isStudent = Student::where('userId', $user->id)->exists();

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
            $photoName = time().'.'.$request->Photo->extension();
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
}
