<?php

namespace App\Filament\Resources\CpmiResource\Pages;

use App\Filament\Resources\CpmiResource;
use App\Models\Cpmi;
use App\Notifications\CpmiApprovalNotification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\Model;


class EditCpmi extends EditRecord
{
    protected static string $resource = CpmiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }



    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $oldStatus = $record->status;

        $record->update($data);

        // Only send notification if status changed
        if ($oldStatus !== $record->status) {
            Notification::route('mail', $record->email)->notify(new CpmiApprovalNotification($record));
        }

        return $record;
    }
}
