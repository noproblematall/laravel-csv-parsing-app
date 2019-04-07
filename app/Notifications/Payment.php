<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Settings;
use App\Pricing;

class Payment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $price = $this->data->package->price;
        $tax_rate = (Settings::first()->tax_rate)/100;
        $tax_id = Settings::first()->tax_id;
        $tax = $price * $tax_rate;
        $total_price = $price + $tax;
        

        return (new MailMessage)
                    ->subject(env('MAIL_SUBJECT_PAYMENT'))
                    ->line(env('MAIL_TEXT_PAYMENT'))
                    ->line('Package Name: '.strtoupper($this->data->package->name))
                    ->line('Price: $'.$this->data->package->price)
                    ->line('TAX #: '.$tax_id)
                    ->line('TAX RATE: '.$tax_rate.'%')
                    ->line('Total Price: $'.round($total_price, 2))
                    ->line('Currency: CAD')
                    ->line('Purchase Date: '.$this->data->created_at)
                    ->line(env('MAIL_FOOTER_PAYMENT'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
