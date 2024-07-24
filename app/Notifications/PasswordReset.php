<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;

    public function __construct(protected $token, protected $setPassword = false)
    {

    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        $url = route('auth.reset', [$this->token]);

        if ($this->setPassword) {
            return (new MailMessage)
                ->subject(config('app.name') . ' - Konto utworzone: link do ustawienia hasła')
                ->markdown('emails.set_password', [
                    'url' => $url
                ]);
        }

        return (new MailMessage)
            ->subject(config('app.name') . ' - Link do zresetowania hasła')
            ->markdown('emails.forgot_password', [
                'url' => $url
            ]);

    }


    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
