<?php
namespace App\Filament\Resources\GajiResource\Pages;

use App\Filament\Resources\GajiResource;
use App\Models\Gaji;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateGaji extends CreateRecord
{
    protected static string $resource = GajiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $checkRedundantGaji = Gaji::where('user_id', $data['user_id'])
            ->where('bulan', $data['bulan'])
            ->where('tahun', $data['tahun'])
            ->first();

        if ($checkRedundantGaji) {
            Notification::make()
                ->title('Gaji karyawan yang anda masukkan sudah ada di sistem')
                ->danger()
                ->send();

            return $this->halt();
        }

        return $data;
    }
}
