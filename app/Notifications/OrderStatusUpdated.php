<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your order status has been updated.')
            ->line('Order ID: ' . $this->order->order_increment_id)
            ->line('Status: ' . ucwords(str_replace('_', ' ', $this->order->status)))
            ->action('View Order', url('/orders/' . $this->order->id))
            ->line('Thank you for shopping with us!');
    }
}
