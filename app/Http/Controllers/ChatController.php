<?php

// app/Http/Controllers/ChatController.php
namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $messages = Message::with('sender')
            ->where('chat_room_id', $id)
            ->orderBy('created_at','asc')
            ->get();

        return response()->json($messages);
    }

    // 4) Send a new message
    public function sendMessage(Request $r, $id)
    {
        $r->validate(['message'=>'required|string|max:1000']);
        $room = ChatRoom::findOrFail($id);
        abort_unless($room->users->contains(Auth::id()), 403);

        $msg = Message::create([
            'chat_room_id'=> $id,
            'sender_id'   => Auth::id(),
            'message'     => $r->message,
        ]);

        return response()->json($msg);
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
