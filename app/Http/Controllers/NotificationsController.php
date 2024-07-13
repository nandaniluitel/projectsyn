<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->get();
        return view('notification.index', compact('notifications'));
    }

    public function create()
    {
        return view('notification.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'file' => 'nullable|file|max:10240', // Example validation for file upload (10MB limit)
        ]);

        $fileName = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/notifications', $fileName); // Store file in storage/app/public/notifications directory

        Notification::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'file' => $fileName, // Save file name to database
        ]);

        return redirect()->back()->with('success', 'Notification published successfully.');
    }
}
    public function edit(Notification $notification)
    {
        return view('notification.edit', compact('notification'));
    }

    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $notification->update([
            'message' => $request->message,
        ]);

        return redirect()->route('notification.index')
                        ->with('success', 'Notification updated successfully.');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notification.index')
                        ->with('success', 'Notification deleted successfully.');
    }
}
