<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HelpdeskAdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/HelpdeskAdmin');
    }

    public function getConversations()
    {
        // Get list of users who have sent messages
        $users = User::whereHas('messages')->get();

        $conversations = $users->map(function ($user) {
            $latestMessage = $user->messages()->latest()->first();
            $isUnanswered = $latestMessage && $latestMessage->is_from_user;
            $lastAnsweredAt = $user->messages()
                ->where('is_from_user', false)
                ->latest()
                ->first()?->created_at;

            return [
                'user_uuid' => $user->uuid,
                'user_name' => $user->name,
                'latest_message' => $latestMessage ? $latestMessage->content : '',
                'is_unanswered' => $isUnanswered,
                'last_answered_at' => $lastAnsweredAt,
            ];
        });

        // Sort by unanswered first, then by last message time
        $sorted = $conversations->sortBy([
            ['is_unanswered', 'desc'],
            ['last_answered_at', 'asc'],
        ])->values();

        return response()->json($sorted);
    }

    public function getMessages(Request $request)
    {
        $user_uuid = $request->query('user_uuid');

        $messages = Message::where('user_uuid', $user_uuid)
            ->orderBy('created_at')
            ->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $user_uuid = $request->input('user_uuid');
        $content = $request->input('content');

        $message = Message::create([
            'user_uuid' => $user_uuid,
            'content' => $content,
            'is_from_user' => false, // False since the admin is sending the message
        ]);

        return response()->json($message);
    }
}
