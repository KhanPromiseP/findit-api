<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{


    public function show($userId)
{
    $user = User::find($userId);
    
    if (!$user || $user->id === 0) {
        abort(404, "User not found");
    }

    if ($user->id === auth()->id()) {
        return back()->with('error', "You can't message yourself");
    }

    return view('chat.index', ["receiver" => $user]);
}

   

    public function send(Request $request, User $user)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        Chat::create([
            'sender_id' => auth::id(),
            'receiver_id' => $request->receiver_id,
            'body' => $request->message,
        ]);
    }
    public function fetch(Request $request)
    {
        $receiverId = $request->query('receiver_id');
        $userId = auth::id();

        $messages = Chat::with('sender', 'receiver')
            ->whereIn('sender_id', [$userId, $receiverId])
            ->whereIn('receiver_id', [$userId, $receiverId])
            ->orderBy('created_at')
            ->get();

        return response()->json($messages);
    }
    // public function destroy(Chat $chat) {

    // }
    public function update(Request $request, $messageId) {
    $request->validate([
        'message' => 'required|string|max:500|',
    ]);
    try {
        $message = Chat::where('id', $messageId)->where('sender_id', auth::id())->firstOrFail();
        $message->update([
        'body' => $request->message,]
    );

        return response()->json(['success' => true]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Message not found or you do not have permission to update this message'], 403);
    }
    }

}
