<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $token;
    protected $chatId;

    public function __construct()
    {
        
        
        
        $this->token = 'ĐIỀN_TOKEN_CUA_BRO_VAO_DAY'; 
        $this->chatId = 'ĐIỀN_CHAT_ID_CUA_BRO_VAO_DAY';
    }

    public static function sendMessage($message)
    {
        $instance = new self();
        
        if (empty($instance->token) || empty($instance->chatId)) {
            Log::warning('Telegram chưa được cấu hình!');
            return;
        }

        $url = "https://api.telegram.org/bot{$instance->token}/sendMessage";

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