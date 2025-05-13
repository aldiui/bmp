<?php

namespace App\Filament\Resources\CpmiResource\Pages;

use App\Filament\Resources\CpmiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCpmis extends ListRecords
{
    protected static string $resource = CpmiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat')
                ->icon('heroicon-o-plus')
                ->createAnother(false),
        ];
    }
}
