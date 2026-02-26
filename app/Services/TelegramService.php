<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $token;
    protected $chatId;
    protected $baseUrl;

    /**
     * Initialize Telegram service from environment
     */
    public function __construct()
    {
        $this->token = env('TELEGRAM_BOT_TOKEN');
        $this->chatId = env('TELEGRAM_CHAT_ID');

        if (empty($this->token) || empty($this->chatId)) {
            \Log::warning('TelegramService: Bot token or chat ID not configured. Set TELEGRAM_BOT_TOKEN and TELEGRAM_CHAT_ID in .env');
        }

        $this->baseUrl = "https://api.telegram.org/bot{$this->token}";
    }

    /**
     * Send notification to configured chat
     */
    public static function notify(string $message): bool
    {
        $instance = new self();

        if (empty($instance->token) || empty($instance->chatId)) {
            return false; // Silent fail if not configured
        }

        $url = "{$instance->baseUrl}/sendMessage";

        try {
            Http::post($url, [
                'chat_id' => $instance->chatId,
                'text' => $message,
                'parse_mode' => 'HTML'
            ]);
        } catch (\Exception $e) {
            Log::error("Lỗi gửi Telegram: " . $e->getMessage());
        }
    }
}
