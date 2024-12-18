<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Lưu tin nhắn vào database
        $message = Message::create([
            'username' => $request->username,
            'message' => $request->message,
        ]);

        // Phát sự kiện WebSocket
        broadcast(new ChatMessageSent($message->username, $message->message))->toOthers();

        return response()->json(['status' => 'Message sent!', 'data' => $message]);
    }

    // Lấy danh sách tin nhắn
    public function getMessages()
    {
        $messages = Message::latest()->take(50)->get(); // Lấy 50 tin nhắn gần nhất
        return response()->json($messages);
    }
}