<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Appointment;

class NewAppointmentNotification extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['mail']; // sends email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Appointment Created')
                    ->line('A new appointment has been created by ' . $this->appointment->full_name)
                    ->line('Scheduled at: ' . $this->appointment->scheduled_at)
                    ->line('Reason: ' . $this->appointment->reason)
                    ->action('View Appointment', url('/admin/appointments')); // admin page link
    }
}
