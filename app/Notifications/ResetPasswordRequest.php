<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordRequest extends Notification
{
    use Queueable;

    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = route('password.reset.form', ['token' => $this->token]);

        return (new MailMessage)
            ->subject('Yeu cau dat lai mat khau')
            ->greeting('Xin chao ' . $notifiable->name . '!')
            ->line('Chung toi nhan duoc yeu cau dat lai mat khau cho tai khoan cua ban.')
            ->action('Dat lai mat khau', $resetUrl)
            ->line('Lien ket nay se het han sau 12 gio.')
            ->line('Neu ban khong yeu cau dat lai mat khau, vui long bo qua email nay.');
    }
}
