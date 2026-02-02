<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Notifications\BookingConfirmed;
use App\Notifications\PaymentReceived;

class PaymentGatewayService
{
    private string $vnpUrl;
    private string $vnpTmnCode;
    private string $vnpHashSecret;
    private string $vnpReturnUrl;

    public function __construct()
    {
        $this->vnpUrl = config('services.vnpay.url');
        $this->vnpTmnCode = config('services.vnpay.tmn_code');
        $this->vnpHashSecret = config('services.vnpay.hash_secret');
        $this->vnpReturnUrl = config('services.vnpay.return_url');
    }

    /**
     * Create VNPay payment URL for booking
     */
    public function createPaymentUrl(Booking $booking): string
    {
        $vnpTxnRef = 'BK' . $booking->id . '_' . time();
        $vnpOrderInfo = 'Thanh toan dat xe: ' . $booking->vehicle->name;
        $vnpOrderType = 'billpayment';
        $vnpAmount = $booking->total_price * 100; // VNPay requires amount in VND * 100
        $vnpLocale = 'vn';
        $vnpIpAddr = request()->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnpTmnCode,
            "vnp_Amount" => $vnpAmount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnpIpAddr,
            "vnp_Locale" => $vnpLocale,
            "vnp_OrderInfo" => $vnpOrderInfo,
            "vnp_OrderType" => $vnpOrderType,
            "vnp_ReturnUrl" => $this->vnpReturnUrl,
            "vnp_TxnRef" => $vnpTxnRef,
        ];

        ksort($inputData);
        $query = "";
        $hashdata = "";
        $i = 0;

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnpUrl = $this->vnpUrl . "?" . $query;

        if (isset($this->vnpHashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $this->vnpHashSecret);
            $vnpUrl .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // Store transaction reference for verification
        $booking->update(['transaction_ref' => $vnpTxnRef]);

        Log::info('VNPay URL created', ['booking_id' => $booking->id, 'txn_ref' => $vnpTxnRef]);

        return $vnpUrl;
    }

    /**
     * Verify VNPay callback signature
     */
    public function verifyPaymentCallback(Request $request): bool
    {
        $vnpSecureHash = $request->input('vnp_SecureHash');
        $inputData = $request->except('vnp_SecureHash', 'vnp_SecureHashType');

        ksort($inputData);
        $hashData = "";
        $i = 0;

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $this->vnpHashSecret);

        return $secureHash === $vnpSecureHash;
    }

    /**
     * Handle successful payment
     */
    public function handlePaymentSuccess(Booking $booking, array $paymentData): void
    {
        // Create payment record
        Payment::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'amount' => $booking->total_price,
            'payment_method' => 'vnpay',
            'transaction_id' => $paymentData['vnp_TransactionNo'] ?? null,
            'status' => 'completed',
            'payment_data' => json_encode($paymentData),
        ]);

        // Update booking status
        $booking->update(['status' => 'confirmed']);

        // Update vehicle status
        $booking->vehicle->update(['status' => 'rented']);

        // Send notifications
        $booking->user->notify(new PaymentReceived($booking, 'vnpay'));
        $booking->user->notify(new BookingConfirmed($booking));

        Log::info('Payment successful', [
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'transaction_id' => $paymentData['vnp_TransactionNo'] ?? null,
        ]);
    }

    /**
     * Handle failed payment
     */
    public function handlePaymentFailure(Booking $booking, string $reason = ''): void
    {
        $booking->update(['status' => 'cancelled']);

        Log::warning('Payment failed', [
            'booking_id' => $booking->id,
            'reason' => $reason,
        ]);
    }

    /**
     * Get booking from VNPay transaction reference
     */
    public function getBookingFromTxnRef(string $txnRef): ?Booking
    {
        return Booking::where('transaction_ref', $txnRef)->first();
    }
}
