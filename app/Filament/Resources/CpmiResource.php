<?php
namespace App\Filament\Resources;

use App\Filament\Resources\CpmiResource\Pages;
use App\Models\Cpmi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class CpmiResource extends Resource
{
    protected static ?string $model = Cpmi::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'CPMI';

    protected static ?string $navigationGroup = 'CPMI';

    protected static ?string $slug = 'cpmi';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('CPMI')
                    ->schema([
                        Forms\Components\Select::make('lokasi_id')
                            ->label('Lokasi')
                            ->relationship('lokasi', 'nama')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live(onBlur: true),
                        Forms\Components\Select::make('kelas_id')
                            ->label('Kelas')
                            ->options(function (callable $get) {
                                $lokasiId = $get('lokasi_id');

                                if (! $lokasiId) {
                                    return [];
                                }

                                return \App\Models\Kelas::where('lokasi_id', $lokasiId)
                                    ->pluck('nama', 'id')
                                    ->toArray();
                            })
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('username')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('telepon')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required(fn($record) => $record === null)
                            ->minLength(8)
                            ->maxLength(20)
                            ->revealable()
                            ->dehydrateStateUsing(function ($state, $record) {
                                if ($record === null) {
                                    return bcrypt($state);
                                } else {
                                    return $state ? bcrypt($state) : $record->password;
                                }
                            }),
                        Forms\Components\Select::make('status')
                            ->options([
                                'Aktif'         => 'Aktif',
                                'Tidak Aktif'   => 'Tidak Aktif',
                                'Sudah Terbang' => 'Sudah Terbang',
                            ])
                            ->required()
                            ->default('Aktif'),
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
                Tables\Columns\TextColumn::make('username')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lokasi.nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kelas.nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->icon(fn(string $state): string => match ($state) {
                        'Aktif'                          => 'heroicon-o-check-circle',
                        'Tidak Aktif'                    => 'heroicon-o-x-circle',
                        'Sudah Terbang'                  => 'heroicon-o-paper-airplane',
                        default                          => '',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'Aktif'                           => 'success',
                        'Tidak Aktif'                     => 'danger',
                        'Sudah Terbang'                   => 'info',
                        default                           => 'secondary',
                    })
                    ->formatStateUsing(function ($state) {
                        return $state;
                    })
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('lokasi_id')
                    ->label('Lokasi')
                    ->relationship('lokasi', 'nama'),
                Tables\Filters\SelectFilter::make('kelas_id')
                    ->label('Kelas')
                    ->relationship('kelas', 'nama'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Aktif'         => 'Aktif',
                        'Tidak Aktif'   => 'Tidak Aktif',
                        'Sudah Terbang' => 'Sudah Terbang',
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
            'index'  => Pages\ListCpmis::route('/'),
            'create' => Pages\CreateCpmi::route('/create'),
            'edit'   => Pages\EditCpmi::route('/{record}/edit'),
        ];
    }
}
