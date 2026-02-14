<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $message = Message::create([
            'from_id' => auth()->id(),
            'to_id'   => $request->to_id,
            'message' => $request->message,
        ]);

        // load sender relation so event payload can include sender name
        $message->load('sender');
        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }

    public function fetch($userId)
    {
                return Message::where(function ($q) use ($userId) {
                        $q->where('from_id', auth()->id())
                            ->where('to_id', $userId);
                })->orWhere(function ($q) use ($userId) {
                        $q->where('from_id', $userId)
                            ->where('to_id', auth()->id());
                })->with('sender')
                ->orderBy('created_at')
                ->get();
    }
}
