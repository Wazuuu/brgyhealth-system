<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
// The following lines were removed to force immediate sending and fix the namespace error:
// use Illuminate\Bus\Queueable; 
// use Illuminate\Contracts\Queue\ShouldQueue; 

class VerifyEmailWithCode extends Notification // <-- NOTE: Removed 'implements ShouldQueue'
{
    // NOTE: The 'use Queueable;' line is also gone

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        // 1. Generate a 6-digit code and ensure it is padded with zeros
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // 2. Save the code and its expiration time (e.g., 10 minutes) to the user model
        $notifiable->verification_code = $code;
        $notifiable->verification_code_expires_at = now()->addMinutes(10);
        $notifiable->save();

        // 3. Return the email message
        return (new MailMessage)
            ->subject('Account Verification Code')
            ->line('Thanks for signing up! Use the code below to verify your account:')
            ->line('<h1 style="text-align:center; color:#38c172; font-size:36px;">' . $code . '</h1>')
            ->line('This code will expire in 10 minutes.');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}