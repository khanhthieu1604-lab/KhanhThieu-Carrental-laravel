<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIChatService
{
    private string $apiKey;
    private string $model = 'gemini-pro';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
    }

    /**
     * Send message to Gemini AI and get response
     */
    public function chat(string $message, array $context = []): array
    {
        try {
            $systemPrompt = $this->getSystemPrompt();
            $fullPrompt = $this->buildPrompt($systemPrompt, $message, $context);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $fullPrompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 1024,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $aiResponse = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Xin lỗi, tôi không thể trả lời câu hỏi này.';

                return [
                    'success' => true,
                    'message' => $this->formatResponse($aiResponse),
                    'raw' => $aiResponse,
                ];
            }

            Log::error('Gemini API Error', ['response' => $response->body()]);

            return [
                'success' => false,
                'message' => 'Đã có lỗi xảy ra. Vui lòng thử lại sau.',
                'error' => $response->body(),
            ];
        } catch (\Exception $e) {
            Log::error('AI Chat Service Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Hệ thống AI tạm thời gián đoạn. Vui lòng liên hệ hotline 0909.123.456',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get system prompt for vehicle rental assistant
     */
    private function getSystemPrompt(): string
    {
        return <<<PROMPT
Bạn là THIUU AI - trợ lý ảo cao cấp của Thiuu Rental, công ty cho thuê xe hạng sang hàng đầu Việt Nam.

NHIỆM VỤ:
- Tư vấn khách hàng chọn xe phù hợp
- Trả lời câu hỏi về chính sách, thủ tục, giá cả
- Hỗ trợ quy trình đặt xe
- Gợi ý dịch vụ cao cấp

THÔNG TIN CÔNG TY:
- Tên: Thiuu Rental - Elite Car Rental
- Hotline 24/7: 0909.123.456
- Email: vip@thiuurental.com
- Địa chỉ: 123 Đại Lộ Nguyễn Huệ, Quận 1, TP.HCM

DỊCH VỤ:
- Cho thuê xe cao cấp: Mercedes, BMW, Audi, Porsche, Lamborghini
- Giá: 500k - 20 triệu/ngày tùy dòng xe
- Dịch vụ tài xế VIP: +20% giá thuê
- Bảo hiểm 2 chiều: +5% giá thuê

CHÍNH SÁCH:
- Giấy tờ: CCCD gắn chip + GPLX hạng B1+
- Ký quỹ: Xe máy chính chủ HOẶC 15 triệu tiền mặt
- Giới hạn KM: 300km/ngày (phụ phí 5k/km)
- Hủy đặt: Miễn phí nếu trước 24h

PHONG CÁCH:
- Lịch sự, chuyên nghiệp, sang trọng
- Dùng emoji phù hợp (🚗 💎 ⭐)
- Ngắn gọn, dễ hiểu
- Luôn đề xuất gọi hotline cho tư vấn chi tiết

Trả lời ngắn gọn, tập trung vào giải quyết nhu cầu khách hàng.
PROMPT;
    }

    /**
     * Build full prompt with context
     */
    private function buildPrompt(string $system, string $message, array $context): string
    {
        $prompt = $system . "\n\n";

        if (!empty($context['user_name'])) {
            $prompt .= "Tên khách hàng: {$context['user_name']}\n";
        }

        if (!empty($context['conversation_history'])) {
            $prompt .= "Lịch sử chat:\n" . implode("\n", $context['conversation_history']) . "\n\n";
        }

        $prompt .= "Khách hàng hỏi: {$message}\n\nTrả lời:";

        return $prompt;
    }

    /**
     * Format AI response
     */
    private function formatResponse(string $response): string
    {
        // Clean up response
        $response = trim($response);

        // Add signature if not present
        if (!str_contains($response, 'Thiuu AI')) {
            $response .= "\n\n✨ *Thiuu AI - Elite Assistant*";
        }

        return $response;
    }

    /**
     * Get vehicle recommendation
     */
    public function recommendVehicle(array $preferences): array
    {
        $message = $this->buildRecommendationQuery($preferences);
        return $this->chat($message);
    }

    /**
     * Build recommendation query
     */
    private function buildRecommendationQuery(array $preferences): string
    {
        $query = "Tôi cần thuê xe với các yêu cầu:\n";

        if (!empty($preferences['occasion'])) {
            $query .= "- Mục đích: {$preferences['occasion']}\n";
        }

        if (!empty($preferences['budget'])) {
            $query .= "- Ngân sách: {$preferences['budget']}\n";
        }

        if (!empty($preferences['passengers'])) {
            $query .= "- Số người: {$preferences['passengers']}\n";
        }

        if (!empty($preferences['days'])) {
            $query .= "- Số ngày thuê: {$preferences['days']}\n";
        }

        $query .= "\nGợi ý xe phù hợp cho tôi.";

        return $query;
    }
}
