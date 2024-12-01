<?php
namespace App\Notifications;

use App\Models\Order;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderConfirmed extends Notification
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Xác định các kênh thông báo.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Gửi thông báo qua email.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Đơn hàng của bạn đã được xác nhận')
            ->greeting('Chào ' . $notifiable->name)
            ->line('Đơn hàng của bạn với mã số: ' . $this->order->id . ' đã được xác nhận thành công.')
            ->line('Tổng tiền: ' . number_format($this->order->total_money, 0) . ' VND')
            ->line('Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.')
            ->action('Xem chi tiết đơn hàng', url('/order-history/detail/' . $this->order->id))
            ->line('Nếu bạn không phải là người thực hiện đơn hàng này, vui lòng bỏ qua thông báo này.');
    }

    
    
}
