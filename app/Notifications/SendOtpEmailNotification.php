<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOtpEmailNotification extends Notification
{
    use Queueable;

    public $otp;
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

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
            ->subject('Your verification code')
            ->line('Your verification code is:' . $this->otp)
            ->line('This code is valid for 5 minutes.');

    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
