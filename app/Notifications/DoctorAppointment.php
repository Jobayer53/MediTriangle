<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DoctorAppointment extends Notification
{
    use Queueable;
    protected $message;
    protected $isAdmin;
    /**
     * Create a new notification instance.
     */
    public function __construct($message, $isAdmin = false)
    {
        $this->message = $message;
        $this->isAdmin = $isAdmin; // Determine if the recipient is an admin
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
        $mailMessage = (new MailMessage)
                        ->line('Doctor Appointment')
                        ->line($this->message);
                        if ($this->isAdmin) {
                        $mailMessage->action('View', url('/user/data/appointment'));
                        }

        return $mailMessage;
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
