<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class SendDefaultPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
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
        // Jika sudah verified, tak perlu link aktivasi — arahkan ke login
        $actionUrl   = url('/login');
        $actionLabel = 'Login Sekarang';

        // Jika BELUM terverifikasi & user implement MustVerifyEmail, buat signed URL
        if (method_exists($notifiable, 'hasVerifiedEmail') && ! $notifiable->hasVerifiedEmail()) {
            $actionLabel = 'Aktifkan Akun';
            $actionUrl = URL::temporarySignedRoute(
                'verification.verify',                              // pastikan route ini ada
                Carbon::now()->addMinutes(60),                      // masa berlaku link
                [
                    'id'   => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
        }

        return (new MailMessage)
                    ->subject('Akun Anda Telah Dibuat')
                    ->greeting('Halo ' . $notifiable->name . ',')
                    ->line('Akun Anda telah berhasil dibuat. Berikut informasi login:')
                    ->line('Email: ' . $notifiable->email)
                    ->line('Password: ' . $notifiable->plain_password)
                    ->line('Silakan login dan segera ubah password Anda untuk alasan keamanan.')
                    ->action($actionLabel, $actionUrl)
                    ->line('Terima kasih.');
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
            //
        ];
    }
}
