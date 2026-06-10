<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Redefinição de Senha')
            ->greeting('Olá!')
            ->line('Recebemos uma solicitação para redefinir sua senha.')
            ->action('Redefinir Senha', url(route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false)))
            ->line('Este link expirará em 60 minutos.')
            ->line('Se você não solicitou isso, ignore este e-mail.')
            ->salutation('Sistema de Séries');
    }
}
