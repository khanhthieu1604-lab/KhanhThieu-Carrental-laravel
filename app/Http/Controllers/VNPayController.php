<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VNPayController extends Controller
{
    protected PaymentGatewayService $paymentService;

    public function __construct(PaymentGatewayService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Handle VNPay return callback (user redirected back from VNPay)
     */
    public function return(Request $request)
    {
        // Verify callback signature
        if (!$this->paymentService->verifyPaymentCallback($request)) {
            Log::error('VNPay callback verification failed', $request->all());

            return redirect()
                ->route('home')
                ->with('error', 'Xác thực thanh toán thất bại. Vui lòng liên hệ hỗ trợ.');
        }

        // Get booking from transaction reference
        $txnRef = $request->input('vnp_TxnRef');
        $booking = $this->paymentService->getBookingFromTxnRef($txnRef);

        if (!$booking) {
            Log::error('Booking not found for TxnRef', ['txn_ref' => $txnRef]);

            return redirect()
                ->route('home')
                ->with('error', 'Không tìm thấy đơn đặt xe.');
        }

        // Check payment response code
        $responseCode = $request->input('vnp_ResponseCode');

        if ($responseCode == '00') {
            // Payment successful
            $this->paymentService->handlePaymentSuccess($booking, $request->all());

            return redirect()
                ->route('bookings.show', $booking->id)
                ->with('success', 'Thanh toán thành công! Đơn đặt xe của bạn đã được xác nhận.');
        } else {
            // Payment failed
            $this->paymentService->handlePaymentFailure($booking, 'VNPay response code: ' . $responseCode);

            return redirect()
                ->route('payment.create', $booking->id)
                ->with('error', 'Thanh toán thất bại. Vui lòng thử lại.');
        }
    }

    /**
     * Handle VNPay IPN (Instant Payment Notification)
     */
    public function ipn(Request $request)
    {
        // Verify callback signature
        if (!$this->paymentService->verifyPaymentCallback($request)) {
            return response()->json([
                'RspCode' => '97',
                'Message' => 'Invalid signature'
            ]);
        }

        // Get booking from transaction reference
        $txnRef = $request->input('vnp_TxnRef');
        $booking = $this->paymentService->getBookingFromTxnRef($txnRef);

        if (!$booking) {
            return response()->json([
                'RspCode' => '01',
                'Message' => 'Order not found'
            ]);
        }

        // Check payment response code
        $responseCode = $request->input('vnp_ResponseCode');

        if ($responseCode == '00') {
            // Payment successful
            $this->paymentService->handlePaymentSuccess($booking, $request->all());

            return response()->json([
                'RspCode' => '00',
                'Message' => 'Confirm Success'
            ]);
        } else {
            // Payment failed
            $this->paymentService->handlePaymentFailure($booking, 'VNPay IPN response code: ' . $responseCode);

            return response()->json([
                'RspCode' => '00',
                'Message' => 'Confirm Success (Payment failed)'
            ]);
        }
    }
}
