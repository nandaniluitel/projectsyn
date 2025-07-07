<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $recent = $now->copy()->subDays(3);

        $notifications = Notification::where(function ($query) use ($now, $recent) {
            $query->where(function ($q) use ($now) {
                $q->where('is_important', true)
                    ->where(function ($sub) use ($now) {
                        $sub->whereNull('expires_at')
                            ->orWhere('expires_at', '>', $now);
                    });
            })->orWhere(function ($q) use ($recent) {
                $q->where('is_important', false)
                    ->where('created_at', '>=', $recent);
            });
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('notification.index', compact('notifications'));
    }
    


    
    public function create()
    {
        // Fetch distinct batch prefixes (first 2 chars of student id)
        $years = Student::select(DB::raw('SUBSTRING(id, 1, 2) as batch_prefix'))
                        ->distinct()
                        ->orderBy('batch_prefix', 'asc')
                        ->pluck('batch_prefix')
                        ->toArray();
    
        return view('notification.create', compact('years'));
    }
    
    


    public function store(Request $request)
    {
        // Define valid batch prefixes from students table
        $validYears = Student::select(DB::raw('SUBSTRING(id, 1, 2) as batch_prefix'))
                             ->distinct()
                             ->pluck('batch_prefix')
                             ->toArray();
    
        $request->validate([
            'message' => 'required|string',
            'file' => 'nullable|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx,txt',
            'target_audience' => 'required|in:students,teachers,both',
            'student_year' => ['nullable', 'string', 'in:' . implode(',', $validYears)],
            'expires_at' => 'nullable|date|after:now',
        ]);
    
        $notification = new Notification();
        $notification->user_id = null;
        $notification->message = $request->message;
        $notification->target_audience = $request->target_audience;
        $notification->student_year = in_array($request->target_audience, ['students', 'both']) ? $request->student_year : null;
        $notification->is_important = $request->has('is_important');
        $notification->expires_at = $notification->is_important ? $request->expires_at : null;
    
        if ($request->hasFile('file')) {
            $notification->file = $request->file('file')->store('notifications', 'public');
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
