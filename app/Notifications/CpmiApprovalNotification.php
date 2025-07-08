<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Cpmi;

class CpmiApprovalNotification extends Notification
{
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
        $mail = (new MailMessage)
            ->subject('Status Akun CPMI Anda: ' . $this->cpmi->status)
            ->greeting('Halo, ' . $this->cpmi->nama)
            ->line('Kami ingin memberitahukan bahwa status akun Anda sebagai Calon Pekerja Migran Indonesia (CPMI) telah diperbarui.')
            ->line('Berikut informasi Anda:')
            ->line('• Email: ' . $this->cpmi->email)
            ->line('• Telepon: ' . $this->cpmi->telepon)
            ->line('• Alamat: ' . $this->cpmi->alamat)
            ->line('• Status Terbaru: ' . $this->cpmi->status);

        switch ($this->cpmi->status) {
            case 'Aktif':
                $mail->line('Selamat! Akun Anda telah disetujui dan sekarang aktif. Silakan login untuk melanjutkan proses.')
                     ->action('Login Sekarang', url('/login'));
                break;

            case 'Tidak Aktif':
                $mail->line('Akun Anda dinonaktifkan. Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.');
                break;

            case 'Sudah Terbang':
                $mail->line('Selamat! Anda telah diberangkatkan ke negara tujuan. Kami mendoakan Anda sukses dan selalu sehat.');
                break;

            default:
                $mail->line('Status akun Anda tidak dikenali. Silakan hubungi administrator untuk klarifikasi.');
        }

        return $mail->line('Terima kasih telah menggunakan layanan kami.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'cpmi_id' => $this->cpmi->id,
            'status' => $this->cpmi->status,
        ];
    }
}
