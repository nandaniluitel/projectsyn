<?php

// app/Http/Controllers/ChatController.php
namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    // 1) List all rooms you belong to
    public function index()
    {
        $chatRooms = ChatRoom::with('projectGroup')
            ->whereHas('users', fn($q)=> $q->where('user_id', Auth::id()))
            ->get();

        return view('chat.index', compact('chatRooms'));
    }

    // 2) Show one room’s chat UI
    public function show($id)
    {
        $room = ChatRoom::with('projectGroup','users')->findOrFail($id);
        abort_unless($room->users->contains(Auth::id()), 403);
        return view('chat.show', compact('room'));
    }

    // 3) Fetch JSON messages for polling
    public function fetchMessages($id)
{
    $room = ChatRoom::findOrFail($id);
    abort_unless($room->users->contains(Auth::id()), 403);

    // map each Message to include a full URL for attachment
    $messages = Message::with('sender')
        ->where('chat_room_id', $id)
        ->orderBy('created_at','asc')
        ->get()
        ->map(fn($msg) => [
            'id'         => $msg->id,
            'sender'     => [
                'id'   => $msg->sender->id,
                'name' => $msg->sender->name,
            ],
            'message'    => $msg->message,
            // turn the stored path into a public URL
            'attachment' => $msg->attachment
                ? asset("storage/{$msg->attachment}")
                : null,
            'created_at' => $msg->created_at->toDateTimeString(),
        ]);

    return response()->json($messages);
}


    // 4) Send a new message
  public function sendMessage(Request $request, $id)
    {
        $data = $request->validate([
            'message'    => 'nullable|string|max:1000',
            'attachment' => 'nullable|file|max:20480|mimes:jpg,jpeg,png,gif,pdf,doc,docx,txt|required_without:message',
        ]);

        $room = ChatRoom::findOrFail($id);
        abort_unless($room->users->contains(Auth::id()), 403);

        $msg = new Message;
        $msg->chat_room_id = $id;
        $msg->sender_id    = Auth::id();
        $msg->message      = $data['message'] ?? null;

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')
                            ->store('chat_attachments', 'public');
            $msg->attachment = $path;
        }

        $msg->save();

        return response()->json([
            'id'         => $msg->id,
            'message'    => $msg->message,
            'attachment' => $msg->attachment
                ? asset("storage/{$msg->attachment}")
                : null,
            'sender'     => [
                'id'   => $msg->sender->id,
                'name' => $msg->sender->name,
            ],
            'created_at' => $msg->created_at->toDateTimeString(),
        ]);
    }

    public function deleteMessage($roomId, $messageId)
    {
        $message = Message::findOrFail($messageId);

        // ensure it belongs to this room and was sent by this user:
        if ($message->chat_room_id !== (int)$roomId || $message->sender_id !== Auth::id()) {
            abort(403);
        }

        $message->delete();

        return response()->json(['status' => 'deleted']);
    }
}
