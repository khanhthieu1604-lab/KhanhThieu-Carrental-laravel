<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentReceived extends Notification implements ShouldQueue
{
    use Queueable;

    protected Booking $booking;
    protected string $paymentMethod;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking, string $paymentMethod = 'vnpay')
    {
        $this->booking = $booking;
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $paymentMethodName = $this->paymentMethod === 'vnpay' ? 'VNPay' : 'Chuyển khoản';

        return (new MailMessage)
            ->subject('💰 Thanh toán thành công cho đơn hàng #' . $this->booking->id)
            ->greeting('Xin chào ' . $notifiable->name . '!')
            ->line('Chúng tôi đã nhận được thanh toán của bạn.')
            ->line('**Phương thức:** ' . $paymentMethodName)
            ->line('**Xe:** ' . $this->booking->vehicle->name)
            ->line('**Số tiền:** ' . number_format($this->booking->total_price) . 'đ')
            ->line('**Trạng thái:** Đã xác nhận')
            ->action('Xem chi tiết', route('bookings.show', $this->booking->id))
            ->line('Hẹn gặp bạn vào ngày ' . $this->booking->start_date->format('d/m/Y') . '!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'amount' => $this->booking->total_price,
            'payment_method' => $this->paymentMethod,
            'message' => 'Thanh toán thành công cho đơn hàng #' . $this->booking->id,
        ];
    }
}
