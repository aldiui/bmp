<?php
namespace App\Notifications;

use App\Models\LamaranKerja;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CpmiLamaranKerjaApprovalNotification extends Notification
{
    use Queueable;

    public LamaranKerja $lamaran;
    public string $oldStatus;
    public string $newStatus;

    public function __construct(LamaranKerja $lamaran, string $oldStatus, string $newStatus)
    {
        $this->lamaran   = $lamaran;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Status Lamaran Kerja Anda Telah Diubah')
            ->greeting('Halo ' . $this->lamaran->cpmi->nama . ',')
            ->line('Status lamaran kerja Anda telah berubah.')
            ->line('📄 Lowongan: ' . $this->lamaran->lowonganKerja->nama)
            ->line('🕐 Status Sebelumnya: ' . $this->oldStatus)
            ->line('✅ Status Sekarang: ' . $this->newStatus)
            ->line('Silakan login ke sistem untuk informasi lebih lanjut.')
            ->salutation('Terima kasih.');
    }
}
