<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmed extends Notification implements ShouldQueue
{
    use Queueable;

    protected Booking $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
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
        return (new MailMessage)
            ->subject('✅ Đơn đặt xe #' . $this->booking->id . ' đã được xác nhận!')
            ->greeting('Xin chào ' . $notifiable->name . '!')
            ->line('Đơn đặt xe của bạn đã được xác nhận thành công.')
            ->line('**Xe:** ' . $this->booking->vehicle->name)
            ->line('**Thời gian nhận:** ' . $this->booking->start_date->format('d/m/Y H:i'))
            ->line('**Thời gian trả:** ' . $this->booking->end_date->format('d/m/Y H:i'))
            ->line('**Tổng tiền:** ' . number_format($this->booking->total_price) . 'đ')
            ->action('Xem chi tiết đơn hàng', route('bookings.show', $this->booking->id))
            ->line('Cảm ơn bạn đã sử dụng dịch vụ Thiuu Rental!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'vehicle_name' => $this->booking->vehicle->name,
            'total_price' => $this->booking->total_price,
            'message' => 'Đơn đặt xe #' . $this->booking->id . ' đã được xác nhận',
        ];
    }
}
