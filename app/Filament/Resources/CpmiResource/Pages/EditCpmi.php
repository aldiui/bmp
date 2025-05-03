<?php

namespace App\Filament\Resources\CpmiResource\Pages;

use App\Filament\Resources\CpmiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCpmi extends EditRecord
{
    protected static string $resource = CpmiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
