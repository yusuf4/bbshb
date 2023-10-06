<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShartnomaExpired extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $dujonibaname;
    public $username;
    public function __construct($dujonibaname, $username)
    {
        $this->dujonibaname = $dujonibaname;
        $this->username = $username;
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
        $runtime = Carbon::now()->format('d.m.Y H:i:s');
        return (new MailMessage)
                    ->subject('Барномаи ББШҲ+')
                    ->greeting('Шартнома нобуд карда шуд!')
                    ->line('Номи шартнома: '.$this->dujonibaname)
                    //->action('Notification Action', url('/'))
                    ->line('Истифодабарандаи зерин нобуд гардонид: '.$this->username)
                    ->line('Санаи: '.$runtime);
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
