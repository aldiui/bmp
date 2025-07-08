<?php

namespace App\Filament\Resources\CpmiResource\Pages;

use App\Filament\Resources\CpmiResource;
use App\Models\Cpmi;
use App\Notifications\CpmiApprovalNotification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Notification;

class CreateCpmi extends CreateRecord
{
    protected static string $resource = CpmiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): Cpmi
    {
        $cpmi = Cpmi::create($data);

        Notification::route('mail', $cpmi->email)->notify(new CpmiApprovalNotification($cpmi));

        return $cpmi;
    }
}
