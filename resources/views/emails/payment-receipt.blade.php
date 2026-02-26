@component('mail::message')
# 💳 Hoá Đơn Thanh Toán

Xin chào **{{ $user->name }}**,

Cảm ơn quý khách đã hoàn tất thanh toán. Dưới đây là hoá đơn điện tử của quý khách.

## 📋 Thông Tin Thanh Toán

**Mã giao dịch:** #{{ $payment->id }}
**Thời gian:** {{ $payment->created_at->format('d/m/Y H:i:s') }}
**Trạng thái:** {{ $payment->status === 'completed' ? '✅ Thành công' : '⏳ Đang xử lý' }}

---

## 🚗 Thông Tin Đơn Hàng

**Mã đơn:** #{{ $booking->id }}
**Xe thuê:** {{ $booking->vehicle->brand->name ?? '' }} {{ $booking->vehicle->name }}
**Thời gian thuê:** {{ $booking->start_date->format('d/m/Y') }} - {{ $booking->end_date->format('d/m/Y') }}

---

## 💵 Chi Tiết Thanh Toán

**Phương thức:** {{ $payment->method === 'vnpay' ? 'VNPay' : ($payment->method === 'momo' ? 'MoMo' : 'Tiền mặt') }}
**Số tiền:** **{{ number_format($payment->amount, 0, ',', '.') }}đ**

@if($payment->transaction_id)
**Mã giao dịch ngân hàng:** {{ $payment->transaction_id }}
@endif

---

@component('mail::button', ['url' => route('bookings.show', $booking->id)])
Xem Chi Tiết Đơn Hàng
@endcomponent

### 🎁 Ưu Đãi Dành Cho Quý Khách

Sử dụng mã **COMEBACK10** cho chuyến thuê xe tiếp theo để nhận giảm giá 10%!

---

Nếu có bất kỳ thắc mắc nào về hoá đơn, vui lòng liên hệ:
📧 Email: support@thiuurental.com
📱 Hotline: 1900 xxxx

Trân trọng,
**{{ config('app.name') }}**
@endcomponent