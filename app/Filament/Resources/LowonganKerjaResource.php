<?php
namespace App\Filament\Resources;

use App\Filament\Resources\LowonganKerjaResource\Pages;
use App\Models\LowonganKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class LowonganKerjaResource extends Resource
{
    protected static ?string $model = LowonganKerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'Lowongan Kerja';

    protected static ?string $navigationGroup = 'Lowongan Kerja';

    protected static ?string $slug = 'lowongan-kerja';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Lowongan Kerja')
                    ->schema([
                        Forms\Components\Select::make('kategori_id')
                            ->label('Kategori')
                            ->relationship('kategori', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('negara_id')
                            ->label('Negara')
                            ->relationship('negara', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $set('slug', str($state)->slug());
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->readonly()
                            ->dehydrated(),
                        Forms\Components\FileUpload::make('gambar')
                            ->label('Gambar')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])
                            ->maxSize(2048)
                            ->directory('lowongan_kerja'),
                        Forms\Components\RichEditor::make('persyaratan')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Radio::make('tampilkan_gaji')
                            ->label('Tampilkan Gaji')
                            ->boolean()
                            ->required()
                            ->inline()
                            ->live(onBlur: true)
                            ->inlineLabel(false),
                        Forms\Components\TextInput::make('gaji_awal')
                            ->label('Gaji Awal')
                            ->visible(fn($get) => $get('tampilkan_gaji') == true)
                            ->required(fn($get) => $get('tampilkan_gaji') == true)
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->numeric(),
                        Forms\Components\TextInput::make('gaji_akhir')
                            ->label('Gaji Akhir')
                            ->visible(fn($get) => $get('tampilkan_gaji') == true)
                            ->required(fn($get) => $get('tampilkan_gaji') == true)
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->numeric(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'Draft'   => 'Draft',
                                'Publish' => 'Publish',
                                'Arsip'   => 'Arsip',
                            ])
                            ->required(),
                        Forms\Components\Select::make('status_loker')
                            ->label('Status Loker')
                            ->options([
                                'Urgent' => 'Urgent',
                                'Normal' => 'Normal',
                                'Full'   => 'Full',
                            ])
                            ->required(),
                        Forms\Components\Radio::make('status_kuota')
                            ->label('Status Kuota')
                            ->options([
                                'Kuota'     => 'Kuota',
                                'Unlimited' => 'Unlimited',
                            ])
                            ->inline()
                            ->required()
                            ->live(onBlur: true)
                            ->inlineLabel(false),
                        Forms\Components\TextInput::make('kuota')
                            ->visible(fn($get) => $get('status_kuota') == 'Kuota')
                            ->required(fn($get) => $get('status_kuota') == 'Kuota')
                            ->numeric(),
                        Forms\Components\TextInput::make('usia_minimal')
                            ->label('Usia Minimal')
                            ->required()
                            ->numeric()
                            ->minValue(17)
                            ->maxValue(fn($get) => $get('usia_maksimal') ?? 65)
                            ->step(1)
                            ->suffix('Tahun'),
                        Forms\Components\TextInput::make('usia_maksimal')
                            ->label('Usia Maksimal')
                            ->required()
                            ->numeric()
                            ->minValue(fn($get) => $get('usia_minimal') ?? 17)
                            ->maxValue(65)
                            ->step(1)
                            ->suffix('Tahun'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kategori.nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('negara.nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lamaranKerja_count')
                    ->label('Pelamar')
                    ->counts('lamaranKerja')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->icon(fn(string $state): string => match ($state) {
                        'Draft'                          => 'heroicon-o-document',
                        'Publish'                        => 'heroicon-o-check-circle',
                        'Arsip'                          => 'heroicon-o-archive-box',
                        default                          => '',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'Draft'                           => 'warning',
                        'Publish'                         => 'success',
                        'Arsip'                           => 'danger',
                        default                           => 'secondary',
                    })
                    ->formatStateUsing(function ($state) {
                        return $state;
                    })
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama'),
                Tables\Filters\SelectFilter::make('negara_id')
                    ->label('Negara')
                    ->relationship('negara', 'nama'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Draft'   => 'Draft',
                        'Publish' => 'Publish',
                        'Arsip'   => 'Arsip',
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
            'index'  => Pages\ListLowonganKerjas::route('/'),
            'create' => Pages\CreateLowonganKerja::route('/create'),
            'edit'   => Pages\EditLowonganKerja::route('/{record}/edit'),
        ];
    }
}
