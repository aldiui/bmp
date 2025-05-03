<?php
namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'User';

    protected static ?string $navigationGroup = 'Master';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
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
                        Forms\Components\Select::make('lokasi_id')
                            ->label('Lokasi')
                            ->relationship('lokasi', 'nama')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('roles')
                            ->label('Role')
                            ->required()
                            ->relationship('roles', 'name')
                            ->preload()
                            ->searchable(),
                        Forms\Components\Radio::make('karyawan')
                            ->label('Karyawan')
                            ->boolean()
                            ->required()
                            ->live(onBlur: true)
                            ->inline()
                            ->inlineLabel(false),
                        Forms\Components\TextInput::make('nomor_identitas')
                            ->label('NIK/NPWP')
                            ->visible(fn($get) => $get('karyawan') == true )
                            ->required(fn($get) => $get('karyawan') == true )
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('telepon')
                            ->tel()
                            ->visible(fn($get) => $get('karyawan') == true )
                            ->required(fn($get) => $get('karyawan') == true )
                            ->maxLength(255),
                        Forms\Components\Select::make('jabatan_id')
                            ->label('Jabatan')
                            ->relationship('jabatan', 'nama')
                            ->visible(fn($get) => $get('karyawan') == true )
                            ->required(fn($get) => $get('karyawan') == true )
                            ->searchable(),
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat')
                            ->visible(fn($get) => $get('karyawan') == true )
                            ->required(fn($get) => $get('karyawan') == true )
                            ->columnSpanFull(),
                        Forms\Components\Select::make('ptkp_status')
                            ->label('PTKP Status')
                            ->visible(fn($get) => $get('karyawan') == true )
                            ->required(fn($get) => $get('karyawan') == true )
                            ->options([
                                'TK/0' => 'TK/0',
                                'TK/1' => 'TK/1',
                                'TK/2' => 'TK/2',
                                'TK/3' => 'TK/3',
                                'K/0'  => 'K/0',
                                'K/1'  => 'K/1',
                                'K/2'  => 'K/2',
                                'K/3'  => 'K/3',
                            ]),
                    ])
                    
                    ->columns(2),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jabatan.nama')
                    ->searchable()
                    ->sortable()
                    ->default('-'),
                Tables\Columns\TextColumn::make('lokasi.nama')
                    ->searchable()
                    ->sortable()
                    ->default('Global'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('lokasi_id')
                    ->label('Lokasi')
                    ->relationship('lokasi', 'nama'),
                Tables\Filters\SelectFilter::make('jabatan_id')
                    ->label('Jabatan')
                    ->relationship('jabatan', 'nama'),
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
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
