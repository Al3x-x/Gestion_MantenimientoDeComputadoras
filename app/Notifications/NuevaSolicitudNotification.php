<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use MoonShine\Notifications\MoonShineNotification;
use Illuminate\Support\Facades\URL;

class NuevaSolicitudNotification extends Notification
{
    use Queueable;

    private $solicitud;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($solicitud)
    {
        $this->solicitud = $solicitud;
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
        return (new MailMessage)
                    ->line('Se ha creado una nueva solicitud.')
                    ->action('Ver Solicitud', url('/admin/resource/solicitud-resource/detail-page?resourceItem=' . $this->solicitud->id))
                    ->line('Gracias por usar nuestra aplicación!');
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
            'solicitud_id' => $this->solicitud->id,
            'solicitante' => $this->solicitud->Solicitante,
        ];
    }
}
