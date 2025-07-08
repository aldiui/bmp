<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\LamaranKerja;
use Filament\Resources\Resource;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LamaranKerjaResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\LamaranKerjaResource\RelationManagers;

class LamaranKerjaResource extends Resource
{
    protected static ?string $model = LamaranKerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Lamaran Kerja';

    protected static ?string $navigationGroup = 'CPMI';

    protected static ?string $slug = 'lamaran-kerja';

    protected static ?int $navigationSort = 6;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'Pending'   => 'Pending',
                        'Disetujui'   => 'Disetujui',
                        'Ditolak'   => 'Ditolak',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Lamar')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cpmi.nama')
                    ->label('CPMI')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lowonganKerja.nama')
                    ->label('Lowongan Kerja')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal_dari')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_dari')
                            ->label('Tanggal Lamar Mulai'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['tanggal_dari'], fn($q) => $q->whereDate('created_at', '>=', $data['tanggal_dari']));
                    }),
                Tables\Filters\Filter::make('tanggal_sampai')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_sampai')
                            ->label('Tanggal Lamar Sampai'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['tanggal_sampai'], fn($q) => $q->whereDate('created_at', '<=', $data['tanggal_sampai']));
                    }),
                Tables\Filters\SelectFilter::make('lowongan_kerja_id')
                    ->label('Lowongan Kerja')
                    ->relationship('lowonganKerja', 'nama'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Pending'   => 'Pending',
                        'Disetujui'   => 'Disetujui',
                        'Ditolak'   => 'Ditolak',
                    ]),
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
            'index' => Pages\ListLamaranKerjas::route('/'),
        ];
    }
}
