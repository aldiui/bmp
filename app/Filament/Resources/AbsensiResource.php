<?php
namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Absensi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Enums\FiltersLayout;
use App\Filament\Exports\AbsensiExporter;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AbsensiResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Absensi';

    protected static ?string $navigationGroup = 'CPMI';

    protected static ?string $slug = 'absensi';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cpmi_id')
                    ->maxLength(36),
                Forms\Components\DatePicker::make('tanggal'),
                Forms\Components\TextInput::make('latitude_masuk')
                    ->numeric(),
                Forms\Components\TextInput::make('longitude_masuk')
                    ->numeric(),
                Forms\Components\TextInput::make('latitude_keluar')
                    ->numeric(),
                Forms\Components\TextInput::make('longitude_keluar')
                    ->numeric(),
                Forms\Components\TextInput::make('jam_masuk'),
                Forms\Components\TextInput::make('jam_keluar'),
                Forms\Components\TextInput::make('status_masuk')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status_keluar')
                    ->maxLength(255),
                Forms\Components\Textarea::make('alasan_masuk')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('alasan_keluar')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cpmi.nama')
                    ->label('CPMI')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cpmi.lokasi.nama')
                    ->label('Lokasi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d F Y')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_masuk')
                    ->sortable()
                    ->label('Jam Masuk'),
                Tables\Columns\TextColumn::make('jam_keluar')
                    ->sortable()
                    ->label('Jam Keluar'),
                Tables\Columns\TextColumn::make('status_masuk')
                    ->label('Status')
                    ->searchable(),
            ])
            ->headerActions([
                ExportAction::make(AbsensiExporter::class),
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal_dari')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_dari')
                            ->label('Tanggal Absensi Mulai'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['tanggal_dari'], fn($q) => $q->whereDate('tanggal', '>=', $data['tanggal_dari']));
                }),
                Tables\Filters\Filter::make('tanggal_sampai')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_sampai')
                            ->label('Tanggal Absensi Sampai'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['tanggal_sampai'], fn($q) => $q->whereDate('tanggal', '<=', $data['tanggal_sampai']));
                    }),
                Tables\Filters\SelectFilter::make('status_masuk')
                    ->label('Status')
                    ->options([
                        'Hadir'     => 'Hadir',
                        'Terlambat' => 'Terlambat',
                    ]),
                Tables\Filters\TrashedFilter::make(),
            ], layout: FiltersLayout::AboveContent)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()
            ]);
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
            'index' => Pages\ListAbsensis::route('/'),
        ];
    }
}
