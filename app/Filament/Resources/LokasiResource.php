<?php
namespace App\Filament\Resources;

use App\Filament\Resources\LokasiResource\Pages;
use App\Models\Lokasi;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class LokasiResource extends Resource
{
    protected static ?string $model = Lokasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'Lokasi';

    protected static ?string $navigationGroup = 'CPMI';

    protected static ?string $slug = 'lokasi';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Lokasi')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('kode')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true),
                                        Forms\Components\TextInput::make('nama')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true),
                                        Forms\Components\TextInput::make('latitude')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('longitude')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TimePicker::make('jam_masuk_mulai')
                                            ->label('Jam Masuk Mulai')
                                            ->seconds(false)
                                            ->required(),
                                        Forms\Components\TimePicker::make('jam_masuk_selesai')
                                            ->label('Jam Masuk Selesai')
                                            ->seconds(false)
                                            ->required(),
                                        Forms\Components\TimePicker::make('jam_keluar_mulai')
                                            ->label('Jam Keluar Mulai')
                                            ->seconds(false)
                                            ->required(),
                                        Forms\Components\TimePicker::make('jam_keluar_selesai')
                                            ->label('Jam Keluar Selesai')
                                            ->seconds(false)
                                            ->required(),
                                        Forms\Components\TextInput::make('radius')
                                            ->required()
                                            ->label('Radius')
                                            ->suffix('meter')
                                            ->numeric(),
                                        Forms\Components\Textarea::make('alamat')
                                            ->required()
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('telepon')
                                            ->tel()
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->columnSpan(1),
                                Map::make('location')
                                    ->label('Lokasi')
                                    ->columnSpanFull()
                                    ->default([
                                        'lat' => 40.4168,
                                        'lng' => -3.7038,
                                    ])
                                    ->afterStateHydrated(function ($state, $set, $component) {
                                        $record = $component->getRecord();
                                        if (is_null($state) && $record) {
                                            $set('location', [
                                                'lat' => $record->latitude,
                                                'lng' => $record->longitude,
                                            ]);
                                        }
                                    })
                                    ->extraStyles([
                                        'min-height: 500px',
                                    ])
                                    ->liveLocation()
                                    ->showMarker()
                                    ->markerColor("#22c55eff")
                                    ->showFullscreenControl()
                                    ->showZoomControl()
                                    ->draggable()
                                    ->tilesUrl("https://tile.openstreetmap.de/{z}/{x}/{y}.png")
                                    ->zoom(15)
                                    ->detectRetina()
                                    ->showMyLocationButton()
                                    ->extraTileControl([])
                                    ->extraControl([
                                        'zoomDelta' => 1,
                                        'zoomSnap'  => 2,
                                    ])
                                    ->columnSpan(1),
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->searchable()
                    ->sortable()
                    ->numeric(),
                Tables\Columns\TextColumn::make('longitude')
                    ->searchable()
                    ->sortable()
                    ->numeric(),
                Tables\Columns\TextColumn::make('radius')
                    ->numeric()
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
            'index'  => Pages\ListLokasis::route('/'),
            'create' => Pages\CreateLokasi::route('/create'),
            'edit'   => Pages\EditLokasi::route('/{record}/edit'),
        ];
    }
}
