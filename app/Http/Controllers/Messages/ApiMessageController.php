<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;

class ApiMessageController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('uuid', $request->get('user_uuid'))->first();
        $messages = $user->messages()
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'user_uuid' => 'required|string',
        ]);

        $message = Message::create([
            'user_uuid' => $request->get('user_uuid'),
            'content' => $request->content,
            'is_from_user' => true,
            'read_at' => now(),
            'src_url' => $request->header('referer'),
        ]);

        // Here you would typically process the user's message and generate a response
        // For now, we'll just create a simple auto-response
        // $response = Message::create([
        //     'user_uuid' => $request->get('user_uuid'),
        //     // 'content' => 'Thank you for your message. Our team will get back to you soon.',
        //     'content' => 'Thank you for your feedback! Our team will review this as soon as possible.',
        //     'is_from_user' => false,
        // ]);

        return response()->json([$message]);
    }

    public function react(Request $request)
    {
        $request->validate([
            'message_uuid' => 'required|string',
            'reaction' => 'required|string|in:👍,👎,😄,😢,❤️',
        ]);

        $message = Message::where('uuid', $request->get('message_uuid'))->first();

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $currentReactions = $message->reactions ?? [];
        $currentReactions[] = $request->get('reaction');

        $message->update([
            'reactions' => $currentReactions,
        ]);

        return response()->json($message);
    }
}
