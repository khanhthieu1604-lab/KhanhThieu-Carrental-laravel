<?php

namespace App\Http\Controllers;

use App\Services\AIChatService;
use Illuminate\Http\Request;

class AIChatController extends Controller
{
    protected AIChatService $aiService;

    public function __construct(AIChatService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Handle chat message
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $context = [
            'user_name' => auth()->user()->name ?? 'Khách',
            'conversation_history' => session('chat_history', []),
        ];

        $response = $this->aiService->chat($request->message, $context);

        // Store in session
        if ($response['success']) {
            $history = session('chat_history', []);
            $history[] = "User: {$request->message}";
            $history[] = "AI: {$response['message']}";

            // Keep last 10 messages
            if (count($history) > 20) {
                $history = array_slice($history, -20);
            }

            session(['chat_history' => $history]);
        }

        return response()->json($response);
    }

    /**
     * Get vehicle recommendations
     */
    public function recommend(Request $request)
    {
        $request->validate([
            'occasion' => 'nullable|string',
            'budget' => 'nullable|string',
            'passengers' => 'nullable|integer',
            'days' => 'nullable|integer',
        ]);

        $response = $this->aiService->recommendVehicle($request->all());

        return response()->json($response);
    }

    /**
     * Clear chat history
     */
    public function clearHistory()
    {
        session()->forget('chat_history');

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa lịch sử chat',
        ]);
    }
}
