<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PedidoConfirmado extends Notification
{
    use Queueable;

    public $pedido;
    public $carrito;

    public function __construct($pedido, $carrito)
    {
        $this->pedido = $pedido;
        $this->carrito = $carrito;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
                    ->subject('Confirmación de tu pedido #' . $this->pedido->id . ' en Bonsai Do')
                    ->greeting('¡Gracias por tu compra, ' . $notifiable->name . '!')
                    ->line('Hemos recibido tu pedido correctamente y ya estamos preparándolo. Aquí tienes los detalles:')
                    ->line('📍 Dirección de envío: ' . $this->pedido->direccion_envio)
                    ->line('---')
                    ->line('📦 RESUMEN DE TU COMPRA:');

        foreach ($this->carrito as $item) {
            $mail->line('🌱 ' . $item['cantidad'] . 'x ' . $item['nombre'] . ' ...... ' . ($item['precio'] * $item['cantidad']) . '€');
        }

        $mail->line('---')
             ->line('💰 TOTAL PAGADO: ' . $this->pedido->total . '€')
             ->action('Ver estado de mis pedidos', route('mis-pedidos'))
             ->salutation('El equipo de Bonsai Do');

        return $mail;
    }
}