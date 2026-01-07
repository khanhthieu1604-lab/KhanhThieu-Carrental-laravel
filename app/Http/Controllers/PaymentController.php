<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    
    public function create($bookingId)
    {
        
        $booking = Booking::with('vehicle')->findOrFail($bookingId);

        
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền truy cập đơn hàng này.');
        }

        
        if ($booking->status !== 'pending') {
            return redirect()
                ->route('bookings.history')
                ->with('info', 'Đơn hàng này đã được xử lý.');
        }

        return view('payment.create', compact('booking'));
    }

    
    public function confirm(Request $request, $bookingId)
    {
        
        $booking = Booking::with(['vehicle', 'user'])->findOrFail($bookingId);

        
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Hành động không được phép.');
        }

        
        $booking->update([
            'status' => 'confirmed'
        ]);

        
        $booking->vehicle->update([
            'status' => 'rented'
        ]);

        
        $adminEmail = 'luongthieu.161004@gmail.com';

        try {
            
            $data = [
                'name'    => $booking->user->name,
                'email'   => $booking->user->email,
                'vehicle' => $booking->vehicle->name,
                'price'   => number_format($booking->total_price),
                'date'    => \Carbon\Carbon::parse($booking->start_date)
                                ->format('d/m/Y H:i'),
                'id'      => $booking->id,
                'phone'   => $booking->user->phone ?? 'Chưa cập nhật'
            ];

            
            Mail::send([], [], function ($message) use ($adminEmail, $data) {
                $message->to($adminEmail)
                    ->subject('💰 [Thiuu Rental] Ting ting! Đơn hàng mới #' . $data['id'])
                    ->html("
                        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e5e7eb; border-radius: 10px; background-color: #ffffff;'>
                            <div style='text-align: center; margin-bottom: 20px;'>
                                <h2 style='color: #2563eb; margin: 0;'>🔔 CÓ ĐƠN HÀNG MỚI!</h2>
                                <p style='color: #6b7280; font-size: 14px;'>Khách hàng vừa xác nhận chuyển khoản</p>
                            </div>

                            <div style='background-color: #f3f4f6; padding: 15px; border-radius: 8px; margin-bottom: 20px;'>
                                <table style='width: 100%;'>
                                    <tr>
                                        <td style='padding: 5px 0; color: #4b5563;'>Khách hàng:</td>
                                        <td style='padding: 5px 0; font-weight: bold; text-align: right;'>{$data['name']}</td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 5px 0; color: #4b5563;'>Số điện thoại:</td>
                                        <td style='padding: 5px 0; font-weight: bold; text-align: right;'>{$data['phone']}</td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 5px 0; color: #4b5563;'>Xe thuê:</td>
                                        <td style='padding: 5px 0; font-weight: bold; text-align: right;'>{$data['vehicle']}</td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 5px 0; color: #4b5563;'>Ngày nhận:</td>
                                        <td style='padding: 5px 0; font-weight: bold; text-align: right;'>{$data['date']}</td>
                                    </tr>
                                </table>
                            </div>

                            <div style='text-align: center; border-top: 2px dashed #e5e7eb; padding-top: 20px;'>
                                <p style='margin-bottom: 5px; color: #6b7280;'>Tổng thanh toán</p>
                                <h1 style='color: #dc2626; margin: 0; font-size: 32px;'>{$data['price']} đ</h1>
                            </div>

                            <div style='text-align: center; margin-top: 30px;'>
                                <a href='mailto:{$data['email']}'
                                   style='background-color: #2563eb; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;'>
                                   Liên hệ khách ngay
                                </a>
                            </div>
                        </div>
                    ");
            });

        } catch (\Exception $e) {
            
            Log::error(
                'Lỗi gửi mail: ' . $e->getMessage()
            );
        }

        
        return redirect()
            ->route('bookings.history')
            ->with(
                'success',
                'Xác nhận thành công! Admin đã nhận được thông báo qua Email.'
            );
    }
}
