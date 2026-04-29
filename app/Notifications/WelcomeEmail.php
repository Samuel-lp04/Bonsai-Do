<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
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
                    ->subject('¡Bienvenido a Bonsai Do!')
                    ->greeting('¡Hola, ' . $notifiable->name . '!')
                    ->line('Gracias por registrarte en nuestra tienda. Estamos encantados de tenerte con nosotros.')
                    ->line('Ya puedes empezar a explorar nuestro catálogo de bonsáis y accesorios.')
                    ->action('Ver Catálogo', url('/home'))
                    ->line('¡Que disfrutes de la experiencia!')
                    ->salutation('El equipo de Bonsai Do');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
