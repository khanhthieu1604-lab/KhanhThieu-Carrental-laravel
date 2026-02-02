<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingReminder extends Notification implements ShouldQueue
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('⏰ Nhắc nhở: Ngày mai bạn sẽ nhận xe!')
            ->greeting('Xin chào ' . $notifiable->name . '!')
            ->line('Đây là thông báo nhắc nhở về đơn đặt xe sắp tới của bạn.')
            ->line('**Xe:** ' . $this->booking->vehicle->name)
            ->line('**Thời gian nhận:** ' . $this->booking->start_date->format('d/m/Y H:i'))
            ->line('**Địa điểm:** ' . ($this->booking->vehicle->location ?? 'Thiuu Rental'))
            ->line('**Tổng tiền:** ' . number_format($this->booking->total_price) . 'đ')
            ->action('Xem chi tiết đơn hàng', route('bookings.show', $this->booking->id))
            ->line('Vui lòng đến đúng giờ. Chúc bạn có chuyến đi vui vẻ!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
