<?php

namespace App\Notifications;

use App\Models\Cpmi;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CpmiRegistrationNotification extends Notification
{
    use Queueable;
    protected $cpmi;

    /**
     * Create a new notification instance.
     */
    public function __construct(Cpmi $cpmi)
    {
        $this->cpmi = $cpmi;
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
            ->subject('Pendaftaran CPMI Berhasil')
            ->greeting('Halo, ' . $this->cpmi->nama)
            ->line('Terima kasih telah melakukan pendaftaran sebagai Calon Pekerja Migran Indonesia (CPMI).')
            ->line('Berikut adalah data pendaftaran Anda:')
            ->line('• Email: ' . $this->cpmi->email)
            ->line('• Telepon: ' . $this->cpmi->telepon)
            ->line('• Alamat: ' . $this->cpmi->alamat)
            ->line('Saat ini akun Anda sedang dalam proses verifikasi.')
            ->line('Silakan tunggu sampai akun Anda aktif sebelum bisa login ke sistem.')
            ->line('Kami akan menghubungi Anda kembali setelah proses aktivasi selesai.')
            ->line('Terima kasih atas kepercayaan Anda.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
