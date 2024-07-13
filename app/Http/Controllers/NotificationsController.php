<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;

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
            'file' => 'nullable|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx,txt', // Example validation for file upload (10MB limit)
        ]);

       
        $notification = new Notification();
        $notification->user_id = auth()->id();
        $notification->message = $request->message;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('notifications');
            $notification->file = $path;
        }

        $notification->save();

        return redirect()->back()->with('success', 'Notification published successfully.');
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
