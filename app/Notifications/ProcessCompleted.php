<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProcessCompleted extends Notification
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
        $url = url('/download/'.$this->data->table_name);
        $filename = $this->data->filename;
        $time = $this->data->created_at;
        return (new MailMessage)
                    ->subject(env('MAIL_SUBJECT_COMPLETION'))
                    ->line(env('MAIL_FIRST_TEXT_COMPLETION'))
                    ->line('FileName: '.$filename)
                    ->line('Date: '.$time)
                    ->action(env('MAIL_BUTTON_TEXT_COMPLETION'), url('/login'))
                    ->line(env('MAIL_SECOND_TEXT_COMPLETION'));
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
