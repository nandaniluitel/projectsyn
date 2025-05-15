<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ScannerController extends Controller
{
    /**
     * Show the webcam scanner page.
     */
    public function showScanner()
    {
        return view('scanner.capture');
    }

    /**
     * Redirect to profile page using roll number.
     * (Optional: if you want to handle redirect via backend)
     */
    public function redirectToProfile(Request $request)
    {
        $rollNo = $request->input('roll_no');

        // Try to find the user by roll number (assuming 'id' stores roll number)
        $user = User::where('id', $rollNo)->first();

        if ($user) {
            return redirect()->route('profile.show', ['rollno' => $rollNo]);
        } else {
            return redirect()->back()->with('error', 'Student not found');
        }
    }
}
