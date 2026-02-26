@component('mail::message')
# 🎉 Xác Nhận Đặt Xe Thành Công!

Xin chào **{{ $user->name }}**,

Cảm ơn quý khách đã tin tưởng và lựa chọn **Thiuu Rental Elite**! Đơn đặt xe của quý khách đã được xác nhận thành công.

## 📋 Thông Tin Đặt Xe

**Mã đơn:** #{{ $booking->id }}
**Trạng thái:** {{ $booking->status === 'pending' ? '⏳ Chờ xác nhận' : '✅ Đã xác nhận' }}

---

## 🚗 Chi Tiết Xe

**Xe:** {{ $vehicle->brand->name ?? '' }} {{ $vehicle->name }}
**Loại:** {{ $vehicle->type }}
**Giá thuê:** {{ number_format($vehicle->price, 0, ',', '.') }}đ/ngày

---

## 📅 Thời Gian Thuê

**Nhận xe:** {{ $booking->start_date->format('d/m/Y H:i') }}
**Trả xe:** {{ $booking->end_date->format('d/m/Y H:i') }}
**Số ngày:** {{ $booking->start_date->diffInDays($booking->end_date) }} ngày

---

## 💰 Chi Phí

**Tổng thanh toán:** **{{ number_format($booking->total_price, 0, ',', '.') }}đ**

@if($booking->note)
---

## 📝 Ghi Chú Của Quý Khách

{{ $booking->note }}
@endif

---

@component('mail::button', ['url' => route('bookings.show', $booking->id)])
Xem Chi Tiết Đặt Xe
@endcomponent

### 📞 Liên Hệ Hỗ Trợ

Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ:
📧 Email: support@thiuurental.com
📱 Hotline: 1900 xxxx

---

Trân trọng,
**{{ config('app.name') }}**
@endcomponent