<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Phương thức để hiển thị tin nhắn giữa 2 người
    public function showChat($receiverId = null)
    {
        $currentUser = auth()->user();
        $receivers = \App\Models\User::where('id', '!=', $currentUser->id)->get();

        $messages = collect(); // Khởi tạo mảng rỗng
        $selectedReceiver = null;

        if ($receiverId) {
            // Lấy thông tin người nhận
            $selectedReceiver = \App\Models\User::find($receiverId);

            // Lấy tin nhắn giữa người dùng hiện tại và receiver
            $messages = \App\Models\Message::where(function ($query) use ($currentUser, $receiverId) {
                $query->where('sender_id', $currentUser->id)
                      ->where('receiver_id', $receiverId);
            })->orWhere(function ($query) use ($currentUser, $receiverId) {
                $query->where('sender_id', $receiverId)
                      ->where('receiver_id', $currentUser->id);
            })->orderBy('created_at', 'asc')->get();
        }

        return view('chat', compact('receivers', 'messages', 'selectedReceiver'));
    }

    // Phương thức gửi tin nhắn
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|integer|exists:users,id',
            'content' => 'required|string|max:500',
        ]);

        // Lưu tin nhắn vào cơ sở dữ liệu
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        // Quay lại trang chat với người nhận
        return redirect()->route('chat', ['receiverId' => $request->receiver_id]);
    }
}
