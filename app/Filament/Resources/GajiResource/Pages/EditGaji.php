<?php
namespace App\Filament\Resources\GajiResource\Pages;

use App\Filament\Resources\GajiResource;
use App\Models\Gaji;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditGaji extends EditRecord
{
    protected static string $resource = GajiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $checkRedundantGaji = Gaji::where('user_id', $data['user_id'])
            ->where('bulan', $data['bulan'])
            ->where('tahun', $data['tahun'])
            ->where('id', '!=', $this->record->id)
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
