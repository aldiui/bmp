<?php

namespace App\Filament\Resources\CpmiResource\Pages;

use App\Filament\Resources\CpmiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCpmi extends CreateRecord
{
    protected static string $resource = CpmiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
