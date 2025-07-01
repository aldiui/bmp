<?php
namespace App\Filament\Resources\KelasResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class JadwalPelajaranRelationManager extends RelationManager
{
    protected static string $relationship = 'jadwalPelajaran';

    protected static ?string $title = 'Jadwal Pelajaran';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('hari')
                    ->options([
                        'Senin'  => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu'   => 'Rabu',
                        'Kamis'  => 'Kamis',
                        'Jumat'  => 'Jumat',
                        'Sabtu'  => 'Sabtu',
                        'Minggu' => 'Minggu',
                    ])
                    ->required()    ,
                Forms\Components\Select::make('mata_pelajaran_id')
                    ->label('Mata Pelajaran')
                    ->relationship('mataPelajaran', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('pengajar_id')
                    ->label('Pengajar')
                    ->relationship('pengajar', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Radio::make('libur')
                    ->boolean()
                    ->required()
                    ->inline()
                    ->inlineLabel(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('hari')
            ->columns([
                Tables\Columns\TextColumn::make('hari')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mataPelajaran.nama')
                    ->label('Mata Pelajaran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pengajar.name')
                    ->label('Pengajar')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('libur')
                    ->label('Libur')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }
}
