<?php

namespace App\Filament\Resources\CpmiResource\Pages;

use App\Filament\Resources\CpmiResource;
use App\Models\Cpmi;
use App\Notifications\CpmiApprovalNotification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Notification;

class EditCpmi extends EditRecord
{
    protected static string $resource = CpmiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordUpdate(array $data): Cpmi
    {
        $cpmi = $this->record;
        $cpmi->update($data);

        Notification::route('mail', $cpmi->email)->notify(new CpmiApprovalNotification($cpmi));

        return $cpmi;
    }
}
