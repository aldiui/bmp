<?php
namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Negara;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Enums\FiltersLayout;
use App\Filament\Resources\NegaraResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class NegaraResource extends Resource
{
    protected static ?string $model = Negara::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'Negara';

    protected static ?string $navigationGroup = 'Lowongan Kerja';

    protected static ?string $slug = 'negara';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mata_uang')
                    ->label('Mata Uang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kode_mata_uang')
                    ->label('Kode Mata Uang')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('simbol_mata_uang')
                    ->label('Simbol Mata Uang')
                    ->required()
                    ->maxLength(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mata_uang')
                    ->label('Mata Uang')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode_mata_uang')
                    ->label('Kode Mata Uang')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('simbol_mata_uang')
                    ->label('Simbol Mata Uang')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()
            ])
            ->paginated([25, 50, 100, 'all']);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListNegaras::route('/'),
        ];
    }
}
